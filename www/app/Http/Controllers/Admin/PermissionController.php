<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Mail\UserCreateNotification;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        return view('admin.permission.list');
    }
    public function getPermissions(Request $request)
    {
        $data = app('permission-helper')->getTableData($request);
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [];
        try {
            $data['error'] = false;
            $data['view'] = view('admin.permission.offcanvas')->render();
            return response()->json($data);
        } catch (\Exception $e) {
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $data = $params = [];
        DB::beginTransaction();
        try {
            $params['title'] = $request->title;
            $params['name'] = $request->name;
            $params['permission_label'] = $request->permission_label;
            $params['guard_name'] = 'web';
            $params['is_redirectable'] = $request->is_redirectable ?? '';
            $permission = resolve('permission-repo')->create($params);
            if (!empty($permission)) {
                $data['error'] = false;
                $data['message'] = 'Permission create successfully.';
                $data['records'] = app('permission-helper')->getTableData([]);
                DB::commit();
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Permission not created successfully..!';
            $data['records'] = app('permission-helper')->getTableData([]);
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
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [];
        try {
            $permission = resolve('permission-repo')->findByID($id);
            $data['error'] = false;
            $data['view'] = view('admin.permission.offcanvas', compact('permission'))->render();
            return response()->json($data);

        } catch (\Exception $e) {
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
        }
        return response()->json($data);
    }

    //Update
    public function update(PermissionRequest $request, $id)
    {
        $data = $params = [];
        DB::beginTransaction();
        try {
            $params = [];
            $params['title'] = $request->title;
            $params['name'] = $request->name;
            $params['permission_label'] = $request->permission_label;
            $params['guard_name'] = 'web';
            $params['is_redirectable'] = $request->is_redirectable ?? '';
            $permission = resolve('permission-repo')->update($params, $id);
            if (!empty($permission)) {
                $data['error'] = false;
                $data['message'] = 'Permission update successfully.';
                $data['records'] = app('permission-helper')->getTableData([]);
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



    //  Delete option
    public function delete($id)
    {
        try {
            $data = [];
            $permission = resolve('permission-repo')->findById($id);
            if ($permission) {
                $permission->delete();
                $data['error'] = false;
                $data['message'] = 'permission deleted successfully..!';
                $data['records'] = app('permission-helper')->getTableData([]);
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
            $permission = app('permission-helper')->changeStatus($id);
            if ($permission) {
                $data['error'] = false;
                $data['message'] = 'Status changed successfully..!';
                $data['records'] = app('permission-helper')->getTableData([]);
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
