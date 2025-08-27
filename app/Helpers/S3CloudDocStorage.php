<?php

namespace App\Helpers;

use Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;

class S3CloudDocStorage
{

    //AWS image upload
    // public function storeFileInStorageDir($file, $storageDir, $type, $modal, $modalId, $name = null)
    // {
    //     $fileName = $name ?? app('common-helper')->generateFileName($file->getClientOriginalExtension());
    //     $cloud_doc_path = $storageDir . '/' . $fileName;

    //     try {
    //         if (config('cloud-storage.OP_OPTIMIZE_ENABLED') === true && in_array($file->getClientOriginalExtension(), config('cloud-storage.OP_IMAGES_EXTENSIONS'))) {
    //             $fileName = $this->optimizeImage($file, $cloud_doc_path);
    //         } else {
    //             $file->storeAs($storageDir, $fileName);
    //         }

    //         // Check if the file exists in Laravel supported cloud storage
    //         if ($this->check_doc_exist_in_laravel_supported_cloud_storage($cloud_doc_path)) {
    //             return $fileName;
    //         }

    //         // Ensure directory exists
    //         if (!\Illuminate\Support\Facades\Storage::exists($storageDir)) {
    //             Storage::makeDirectory($storageDir);
    //         }

    //         // Upload schedule for cloud storage
    //         $user = \Auth::user();
    //         if (config('cloud-storage.using_cloud_storage')) {
    //             $this->generate_cloud_doc_upload_schedule($type, $fileName, $storageDir, $cloud_doc_path, $user->id ?? 0, $modal, $modalId);
    //         }

    //         return $fileName;
    //     } catch (\Exception $e) {
    //         // Handle exceptions, log error, and return appropriate response
    //         \Log::error('Error storing file: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    public function storeFileInStorageDir($file, $storageDir, $type, $modal, $modalId, $name = null)
    {
        $cloud_doc_path = $storageDir;
        if (config('cloud-storage.OP_OPTIMIZE_ENABLED') === true && in_array($file->getClientOriginalExtension(), config('cloud-storage.OP_IMAGES_EXTENSIONS'))) {   // if optimize enabled
            $fileName = $this->optimizeImage($file, $cloud_doc_path);   // returns filename
            $doc_content = Storage::get($cloud_doc_path . $fileName);
            Storage::disk(config('cloud-storage.filesystem_driver'))->put($cloud_doc_path . '/' . $fileName, $doc_content);
        } else {
            $fileName = basename($file->store($cloud_doc_path, 's3'));
        }
        if ($this->check_doc_exist_in_laravel_supported_cloud_storage($storageDir . DIRECTORY_SEPARATOR . $fileName)) {
            return $fileName;
        }

        $user = \Auth::user();

        if (!\Illuminate\Support\Facades\Storage::exists($storageDir)) {
            Storage::makeDirectory($storageDir);
        }

        if (empty($fileName)) {
            $fileName = app('common')->generateFileName($file->getClientOriginalExtension());
        }
        $file->storeAs($storageDir, $fileName);

        if (config('cloud-storage.using_cloud_storage')) {
            $this->generate_cloud_doc_upload_schedule($type, $fileName, $storageDir, $cloud_doc_path, $user->id ?? 0, $modal, $modalId);
        }
        return $fileName;
    }


    /**
     * Add document to cloud_doc_upload_schedule table
     * @param $action
     * @param $doc_name
     * @param $local_doc_path
     * @param $cloud_doc_path
     * @param $created_by
     * @param $doc_reference_table
     * @param $doc_reference_table_id
     */

    public function generate_cloud_doc_upload_schedule($action, $doc_name, $local_doc_path, $cloud_doc_path, $created_by = null, $doc_reference_table = null, $doc_reference_table_id = null)
    {
        $doc_upload_schedule = new \App\Models\CloudDocUploadSchedule();
        $doc_upload_schedule->action = $action;
        $doc_upload_schedule->doc_name = $doc_name;
        $doc_upload_schedule->local_doc_path = $local_doc_path;
        $doc_upload_schedule->cloud_doc_path = $cloud_doc_path;
        $doc_upload_schedule->doc_reference_table = $doc_reference_table;
        $doc_upload_schedule->doc_reference_table_id = $doc_reference_table_id;
        $doc_upload_schedule->created_by = $created_by;
        $doc_upload_schedule->save();
    }

    /**
     * Upload queued document to cloud storage (used in cron)
     */

    public function upload_doc_to_cloud_storage()
    {

        /* Generate cron logs */
        if (config('constants.cron_log')) {
            $cron_log_id = app('common')->generat_cron_logs(['title' => 'Upload document to cloud storage', 'signature' => 'cloud:doc_upload']);
        }

        /* Set unlimited execution time and memory limit */
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", "-1");

        /* Release locked docs */
        \App\Models\CloudDocUploadSchedule::where('status', 'LOCKED')
            //        ->where('updated_at','<=',\Carbon\Carbon::now()->subHours(config('cloud-storage.upload_doc_unlock_hours'))->toDateTimeString())
            ->update(['status' => 'IN_QUEUE']);

        /* Fetch in queue docs for upload in cloud */
        $docs_in_queue = \App\Models\CloudDocUploadSchedule::where('status', 'IN_QUEUE')
            ->limit(config('cloud-storage.upload_doc_limit'))
            ->get();

        /* Change status of fetched in queue docs to locked */
        \App\Models\CloudDocUploadSchedule::where('status', 'IN_QUEUE')
            ->limit(config('cloud-storage.upload_doc_limit'))
            ->update(['status' => 'LOCKED']);

        /* Upload doc to cloud */
        $error_counter = 1;
        foreach ($docs_in_queue as $doc_instance) {

            // $path = storage_path('app/').$doc_instance->local_doc_path.$doc_instance->doc_name;
            $path = $doc_instance->local_doc_path . $doc_instance->doc_name;

            /* Update status if document not exists in local disk */
            if (!Storage::exists($path)) {
                $doc_instance->status = 'FAILED';
                $doc_instance->status_code = 404;
                $doc_instance->message = 'Document not found in local disk: ' . $path;
                $doc_instance->status_date = \Carbon\Carbon::now();
                $doc_instance->save();

                continue;
            }

            if (in_array(config('cloud-storage.filesystem_driver'), config('cloud-storage.laravel_supported_drivers'))) {

                /* For laravel supported cloud storage */
                $result = $this->upload_doc_to_laravel_supported_cloud_storage($doc_instance);

            } else {

                /* For other cloud storage */
                continue;
            }

            if ($result['status_code'] != 200) {

                /* Terminate upload if error counter greater than "N" number */
                if ($error_counter > config('cloud-storage.upload_error_mail_count')) {
                    break;
                }

                /*Send error mail*/
                //  \Mail::send(new \App\Mail\CLoudDocUploadError($result['message']));

            }

            /* Update status */
            $doc_instance->status = $result['status'];
            $doc_instance->status_code = $result['status_code'];
            $doc_instance->message = $result['message'];
            $doc_instance->status_date = \Carbon\Carbon::now();
            $doc_instance->save();

            $error_counter++;
        }

        /* Update cron logs */
        if (config('constants.cron_log')) {
            app('common')->save_cron_logs_response($cron_log_id, ['status' => 'success', 'response' => 'Cron executed successfully.']);
        }
    }


    /**
     * Delete document from cloud storage
     * @param $doc_name
     * @param $local_doc_path
     * @param $cloud_doc_path
     * @param $keep_in_trash
     */

    public function delete_doc_from_cloud_storage($doc_name, $local_doc_path, $cloud_doc_path, $keep_in_trash = false)
    {
        try {
            /* Remove record from doc scheduler table */
            \App\Models\CloudDocUploadSchedule::where('doc_name', $doc_name)
                ->where('local_doc_path', $local_doc_path)
                ->delete();

            /* Delete document from local storage */
            if (Storage::exists($local_doc_path . '/' . $doc_name)) {
                Storage::delete($local_doc_path . '/' . $doc_name);
            }

            if (in_array(config('cloud-storage.filesystem_driver'), config('cloud-storage.laravel_supported_drivers'))) {

                /* For laravel supported cloud storage */
                $this->delete_doc_from_laravel_supported_cloud_storage($doc_name, $cloud_doc_path, $keep_in_trash);

            } else {

                /* For other cloud storage */
            }

        } catch (\Exception $e) {
            //Continue execution
        }
    }

    /**
     * Clear older document from local storage (used in cron)
     */

    public function clear_doc_from_local_storage()
    {

        /* Generate cron logs */
        if (config('constants.cron_log')) {
            $cron_log_id = app('common')->generat_cron_logs(['title' => 'Clear old document from local storage', 'signature' => 'document:clear']);
        }

        /* Set unlimited execution time and memory limit */
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", "-1");

        try {

            /* List of directories that you want to clear*/
            $directories = config('cloud-storage.list_of_directories_in_use');

            foreach ($directories as $directory) {

                /* Get all documents by directory */
                $documents = Storage::allFiles($directory);

                foreach ($documents as $full_doc_path) {

                    /*Check for cloud document upload log */
                    $doc_already_uploaded = \App\Models\CloudDocUploadSchedule::where('status', 'UPLOADED')
                        ->where(\DB::raw('concat(local_doc_path,"/",doc_name)'), $full_doc_path)
                        ->count();


                    $cloud_doc_path = $full_doc_path;

                    /* Check if document exist in cloud storage */
                    if (in_array(config('cloud-storage.filesystem_driver'), config('cloud-storage.laravel_supported_drivers'))) {
                        /* For laravel supported cloud storage */
                        $exist_in_cloud = $this->check_doc_exist_in_laravel_supported_cloud_storage($cloud_doc_path);
                    } else {

                        /* For other cloud storage */
                        $exist_in_cloud = false;
                    }

                    /* Check if document exist either in log or cloud */
                    echo "\n" . "<br>doc_already_uploaded: " . $doc_already_uploaded . " -- exist_in_cloud: " . $exist_in_cloud . ' -- full_doc_path: ' . $full_doc_path;
                    if ($doc_already_uploaded || $exist_in_cloud) {

                        /* Get days from document */
                        $time = Storage::lastModified($full_doc_path);
                        $doc_created_date = \Carbon\Carbon::createFromTimestamp($time);
                        $current_date = \Carbon\Carbon::now();
                        $diff_in_days = $doc_created_date->diffInDays($current_date);


                        /* Delete document from local that older than N(number of days) days */
                        echo " -- diff_in_days: " . $diff_in_days . " -- local_doc_clear_days: " . config('cloud-storage.local_doc_clear_days');
                        if ($diff_in_days >= config('cloud-storage.local_doc_clear_days')) {
                            Storage::delete($full_doc_path);
                        }
                    }
                }

                /* Delete empty directory from local storage  */
                $this->delete_empty_directory_from_local_storage($directory);
            }

            /* Update cron logs */
            if (config('constants.cron_log')) {
                app('common')->save_cron_logs_response($cron_log_id, ['status' => 'success', 'response' => 'Cron executed successsully.']);
            }

        } catch (\Exception $e) {
            //Continue execution

            /* Update cron logs */
            if (config('constants.cron_log')) {
                app('common')->save_cron_logs_response($cron_log_id, ['status' => 'fail', 'response' => $e->getMessage()]);
            }
        }
    }

    /**
     * Delete empty directory from local storage
     * @param $directory
     */

    public function delete_empty_directory_from_local_storage($directory)
    {
        try {
            /* Get all sub-directories for directory */
            $sub_directories = Storage::directories($directory);
            foreach ($sub_directories as $sub_dir) {

                /* Get count of document by sub directory and delete if empty */
                $documents = Storage::allFiles($sub_dir);
                if (count($documents) == 0) {
                    Storage::deleteDirectory($sub_dir);
                }
            }

        } catch (\Exception $e) {
            //Continue execution
        }
    }


    /* Laravel supported cloud storage functions start */

    /**
     * Upload document to laravel supported cloud storage
     * @param $doc_instance
     * @return array|object
     */

    public function upload_doc_to_laravel_supported_cloud_storage($doc_instance)
    {

        $local_doc_path = $doc_instance->local_doc_path;
        $cloud_doc_path = $doc_instance->cloud_doc_path;
        $doc_name = $doc_instance->doc_name;

        try {
            $doc_content = Storage::get($local_doc_path . $doc_name);

            //            if (!Storage::disk(config('cloud-storage.filesystem_driver'))->exists($cloud_doc_path)) {
//                Storage::disk(config('cloud-storage.filesystem_driver'))->makeDirectory($cloud_doc_path, 0777);
//                dd($cloud_doc_path);
//            }

            /* Copy document from local to cloud */
            $response = Storage::disk(config('cloud-storage.filesystem_driver'))->put($cloud_doc_path . $doc_name, $doc_content);

            if ($response) {
                return ['status' => 'UPLOADED', 'status_code' => 200, 'message' => 'Document successfully- uploaded.'];
            }

        } catch (\Exception $e) {
            return ['status' => 'FAILED', 'status_code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

    /**
     * Check if document exist in laravel supported cloud storage
     * @param $cloud_doc_path
     * @return bool
     */

    public function check_doc_exist_in_laravel_supported_cloud_storage($cloud_doc_path)
    {

        try {
            if (Storage::disk(config('cloud-storage.filesystem_driver'))->exists($cloud_doc_path)) {

                return true;
            } else {

                return false;
            }

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Download document from laravel supported cloud storage
     * @param $local_doc_path
     * @param $cloud_doc_path
     */

    public function download_doc_from_laravel_supported_cloud_storage($local_doc_path, $cloud_doc_path)
    {
        try {
            /* Create folder if not exists*/
            $doc_path_arr = explode('/', $local_doc_path);
            array_pop($doc_path_arr);
            $local_doc_path_dir = implode('/', $doc_path_arr);

            if (!Storage::exists($local_doc_path_dir)) {
                Storage::makeDirectory($local_doc_path_dir, 0777);
            }

            /* Copy document from cloud to local */
            $doc_content = Storage::disk(config('cloud-storage.filesystem_driver'))->get($cloud_doc_path);
            if (!empty($doc_content) && !empty($local_doc_path)) {
                Storage::put($local_doc_path, $doc_content);
            }

        } catch (\Exception $e) {
            //Continue execution
        }
    }

    /**
     * Delete document from laravel supported cloud storage
     * @param $doc_name
     * @param $cloud_doc_path
     * @param $keep_in_trash
     */

    public function delete_doc_from_laravel_supported_cloud_storage($doc_name, $cloud_doc_path, $keep_in_trash)
    {
        try {

            if (Storage::disk(config('cloud-storage.filesystem_driver'))->exists($cloud_doc_path . '/' . $doc_name)) {
                if ($keep_in_trash) {

                    /* Create "trash" folder if not exists*/
                    $cloud_trash_doc_path = 'trash';
                    if (!Storage::disk(config('cloud-storage.filesystem_driver'))->exists($cloud_trash_doc_path)) {
                        Storage::disk(config('cloud-storage.filesystem_driver'))->makeDirectory($cloud_doc_path, 0777);
                    }

                    /* Move document into trash */
                    Storage::disk(config('cloud-storage.filesystem_driver'))->move($cloud_doc_path . '/' . $doc_name, $cloud_trash_doc_path . '/' . $doc_name);

                } else {

                    /* Delete document from cloud */
                    Storage::disk(config('cloud-storage.filesystem_driver'))->delete($cloud_doc_path . '/' . $doc_name);
                }
            }

        } catch (\Exception $e) {
            //Continue execution
        }
    }

    public function get_doc_url_from_cloud_storage($local_doc_path, $cloud_doc_path)
    {
        $cloud_url = null;

        // Check path from cloud if exists then return file
        if ($this->check_doc_exist_in_laravel_supported_cloud_storage($cloud_doc_path)) {
            //            $cloud_url = Storage::disk('s3')->url($cloud_doc_path);
            $cloud_url = Storage::disk(config('cloud-storage.filesystem_driver'))->temporaryUrl(str_replace('\\', '/', $cloud_doc_path), now()->addDay(1));
        } else {
            // Check path from local if exists then return file
            if (File::exists($local_doc_path)) {
                $cloud_url = asset($local_doc_path);
            }
        }
        return $cloud_url;
    }
    public function optimizeImage($image, $destination)
    {
        try {
            // Get the original file extension
            $originalExtension = pathinfo($image, PATHINFO_EXTENSION);

            // Determine the filename based on WebP conversion
            if (config('cloud-storage.OP_WEBP_ENABLED') === true) {
                // If WebP conversion is enabled, use .webp extension
                $filename = Str::random(40) . '.' . 'webp';
            } else {
                // If WebP conversion is not enabled, keep the original extension
                $filename = Str::random(40) . '.' . $originalExtension;
            }
            // Create ImageManager instance
            $manager = new ImageManager(new Driver());

            // Load the image
            $imageObj = $manager->read(file_get_contents($image));

            // Apply watermark if enabled
            if (config('cloud-storage.OP_WATERMARK_ENABLED') === true) {
                $this->applyTextWatermark($imageObj);

            }

            // // Reduce quality if enabled
            // if (config('cloud-storage.OP_REDUCE_QUALITY_ENABLED') === true) {
            //     $imageObj->encode('data-url', config('cloud-storage.OP_QUALITY')); // Use 'data-url' encoder for image optimization
            // }

            // Set resolution if enabled
            if (config('cloud-storage.OP_SET_RESOLUTION_ENABLED') === true) {
                $imageObj->resize(config('cloud-storage.OP_RESOLUTION_X'), config('cloud-storage.OP_RESOLUTION_Y'), function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio if desired
                });

            }

            // Save the optimized image
            $file_path = storage_path('app' . DIRECTORY_SEPARATOR . $destination);
            if (!file_exists($file_path)) {
                mkdir($file_path, 777, true);
            }
            $imageObj->save($file_path . $filename);

            return $filename;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }

    public function applyTextWatermark($image)
    {
        $fontSize = 30;

        // Adjust font size based on image width (consider using more granular logic)
        $width = $image->width();
        if ($width < 800) {
            $fontSize = 20;
        } elseif ($width < 1600) {
            $fontSize = 30;
        } else {
            $fontSize = min(120, floor($width / 10)); // Limit max font size based on width
        }

        $image->text(
            config('cloud-storage.OP_WATERMARK_TEXT'),
            $image->width() / 2,
            $image->height() / 2,
            function ($font) use ($fontSize) {
                $font->file(public_path(config('cloud-storage.OP_FONT_PATH')));
                $font->size($fontSize);
                $font->color(config('cloud-storage.OP_FONT_COLOR'));
                $font->align(config('cloud-storage.OP_WATERMARK_ALIGN'));
                $font->valign(config('cloud-storage.OP_WATERMARK_VALIGN'));
            }
        );
    }
}
