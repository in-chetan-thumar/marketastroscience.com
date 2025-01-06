<?php

namespace App\Helpers;

use App\Models\MasterDistrict;
use App\Models\MasterDistricts;
use App\Models\MasterState;
use App\Models\MasterStates;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CommonHelper
{
    /* Rendom password  generate */
    public function randomPasswordGenerator()
    {
        $digits = array_flip(range('0', '9'));
        $lowercase = array_flip(range('a', 'z'));
        $uppercase = array_flip(range('A', 'Z'));
        $special = array_flip(str_split('!@#$%^&*()_+=-}{[}]\|;:<>?/'));
        $combined = array_merge($digits, $lowercase, $uppercase, $special);

        $password = str_shuffle(array_rand($digits) .
            array_rand($lowercase) .
            array_rand($uppercase) .
            array_rand($special) .
            implode(array_rand($combined, rand(4, 4))));

        //dd(strlen($password),$password);
        return $password;
    }

    /* Rendom string generate */
    public function randomString($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    /* Generate numeric otp */
    public function numericOTP()
    {
        return rand(111111, 999999);
    }

    /* Email masking */
    function maskEmailAddress($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            list($first, $last) = explode('@', $email);
            $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first) - 3), $first);
            $last = explode('.', $last);
            $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0']) - 1), $last['0']);
            $hideEmailAddress = $first . '@' . $last_domain . '.' . $last['1'];
            return $hideEmailAddress;
        } else {
            return NULL;
        }
    }

    /* Phone number masking */
    function maskPhoneNumber($phone)
    {
        if (!empty($phone)) {
            return config('constants.COUNTRY_CODE') . substr($phone, 0, 2) . str_repeat("*", strlen($phone) - 4) . substr($phone, -2);
        } else {
            return NULL;
        }
    }

    /* Generate date range */
    function generateDateRange($params)
    {
        $data = [];
        $getMonthsList = CarbonPeriod::create($params['start_date'], '1 month', $params['end_date']);
        foreach ($getMonthsList as $dt) {
            $data[$dt->format("M")] = 0;
        }
        return $data;
    }

    /* Financial Yea number */
    function getFinancialYear($inputDate, $format = "Y")
    {
        $date = date_create($inputDate);
        if (date_format($date, "m") >= 4) {
            //On or After April (FY is current year - next year)
            $financial_year = (date_format($date, $format)) . '-' . (date_format($date, $format) + 1);
        } else {
            //On or Before March (FY is previous year - current year)
            $financial_year = (date_format($date, $format) - 1) . '-' . date_format($date, $format);
        }

        return $financial_year;
    }

    /* Generate state list array */
    function stateList()
    {
        return MasterState::orderBy('state', 'ASC')->pluck('state', 'id');
    }

    /* Generate state list array */
    function districtList()
    {
        return MasterDistrict::orderBy('district', 'ASC')->select('id', 'state_id', 'district')->get()->toarray();
    }

    /* Generate district list array by state */
    function districtListByState($id)
    {
        return MasterDistricts::where('master_state_id', $id)->orderBy('district', 'ASC')->pluck('district', 'id');
    }

    /* Generate error message */
    function generateErrorMessage($e)
    {
        if (env('APP_ENV') == 'PRODUCTION') {
            return "Something went wrong.Please contact to administrator";
        } else {
            return "Message:" . $e->getMessage() . " Filename:" . $e->getFile() . " Line:" . $e->getLine();
        }
    }

    public function storeFileInStorageDir($file, $storageDir, $type, $modal, $modalId, $name = null)
    {

        $user = \Auth::user();

        if (!Storage::exists($storageDir)) {
            Storage::makeDirectory($storageDir);
        }

        if (!empty($name)) {
            $fileName = $name;
        } else {
            $fileName = $this->generateFileName($file->getClientOriginalExtension());
            $file->storeAs($storageDir, $fileName);
        }
        $cloud_doc_path = config('cloud-storage.env_folder') . DIRECTORY_SEPARATOR . $storageDir;
        if (config('cloud-storage.using_cloud_storage')) {
            app('cloud-doc-storage')->generate_cloud_doc_upload_schedule($type, $fileName, $storageDir, $cloud_doc_path, $user->id ?? 0, $modal, $modalId);
        }
        return $fileName;
    }

    public function downloadFileFromServer($doc_reference_table, $doc_reference_table_id)
    {

        $clouddocs = CloudDocUploadSchedule::where('doc_reference_table', $doc_reference_table)->where('doc_reference_table_id', $doc_reference_table_id)->get();

        if (!empty($clouddocs) and count($clouddocs) > 0) {
            //dd(count($clouddocs), $clouddocs, 'q');
            foreach ($clouddocs as $clouddoc) {

                $getVirtualConsultationStoragePath = storage_path('app/') . $clouddoc->local_doc_path . $clouddoc->doc_name;

                if (!File::exists($getVirtualConsultationStoragePath)) {
                    $encoded_local_doc_path = base64_encode(str_replace(storage_path("app"), '', $getVirtualConsultationStoragePath));
                    app('cloud-doc-storage')->download_doc_from_cloud_storage($encoded_local_doc_path);
                }
            }
        }
    }


    public function removeFileFromStorage($storageDir, $fileName)
    {
        @unlink(storage_path('app') . "/" . $storageDir . $fileName);
    }

    public function generateFileName($ext)
    {
        $randomeString = $this->randomString(30);
        $randomeString = $randomeString . "." . $ext;
        return $randomeString;
    }

    public function getMasterFinancialYear()
    {
        $currentFinancialYear = MasterFinancialYear::where('start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('is_active', 'Y')->first();
        return $currentFinancialYear;
    }
}
