<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = app('option-helper')->masterOptionDropdown('STATUS');
        return view('admin.blog.list', compact('status'));
    }

    public function getBlogs(Request $request)
    {
        $data = app('blog-helper')->getTableData($request);
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        try {
            $data['error'] = false;
            $data['view'] = view('admin.blog.offcanvas')->render();
            return response()->json($data);
        } catch (\Exception $e) {
            $data['error'] = true;
            $data['message'] = app('common-helper')->generateErrorMessage($e);
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $params['title'] = $request->title;
            $params['slug'] = $request->slug;
            $params['description'] = $request->description;
            $params['blog_date'] = $request->blog_date;
            $files = $request->file('file');
            if (!empty($files)) {
                // Get the directory path from the config file
                $documentDir = config('constants.BLOG_FILE_PATH');

                // Check if the directory exists, if not, create it
                if (!Storage::exists($documentDir)) {
                    Storage::makeDirectory($documentDir, 0777, true);  // Set recursive to true to ensure all parent directories are created if needed
                }

                // Store the file and get its basename
                $params['file'] = basename($files->storeAs($documentDir, $files->getClientOriginalName()));
            }
            $slug_exists = resolve('blog-repo')->slugExists($params);
            if (!$slug_exists) {
                $blog_list = resolve('blog-repo')->create($params);
                if (!empty($blog_list)) {
                    $data['error'] = false;
                    $data['message'] = 'Blog created successfully.';
                    DB::commit();
                    return response()->json($data);
                }
                $data['error'] = true;
                $data['message'] = 'Blog not created successfully..!';
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Blog slug already exists!';
            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];
        try {
            $blog = resolve('blog-repo')->findByID($id);
            $data['error'] = false;
            $data['view'] = view('admin.blog.offcanvas', compact('blog'))->render();
            return response()->json($data);
        } catch (\Exception $e) {
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $params['id'] = $id;
            $params['title'] = $request->title;
            $params['slug'] = $request->slug;
            $params['description'] = $request->description;
            $params['blog_date'] = $request->blog_date;
            $files = $request->file('file');
            if (!empty($files)) {
                // Get the directory path from the config file
                $documentDir = config('constants.BLOG_FILE_PATH');

                // Check if the directory exists, if not, create it
                if (!Storage::exists($documentDir)) {
                    Storage::makeDirectory($documentDir, 0777, true);  // Set recursive to true to ensure all parent directories are created if needed
                }

                // Store the file and get its basename
                $params['file'] = basename($files->storeAs($documentDir, $files->getClientOriginalName()));
            }

            $slug_exists = resolve('blog-repo')->slugExists($params);
            if (!$slug_exists) {
                $blog = resolve('blog-repo')->update($params, $id);
                if (!empty($blog)) {
                    $data['error'] = false;
                    $data['message'] = 'Blog updated successfully.';
                    DB::commit();
                    return response()->json($data);
                }
                $data['error'] = true;
                $data['message'] = 'Blog not updated successfully..!';
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Slug already exists!';
            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $data = [];
            $blog = resolve('blog-repo')->findById($id);
            if ($blog) {
                $blog->delete();
                $data['error'] = false;
                $data['message'] = 'Blog deleted successfully..!';
                DB::commit();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }


    public function changeStatus($id)
    {
        try {
            $data = [];
            $blog = app('blog-helper')->changeStatus($id);
            if ($blog) {
                $data['error'] = false;
                $data['message'] = 'Status changed successfully..!';
                DB::commit();
                return response()->json($data);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
            return response()->json($data);
        }
    }
}
