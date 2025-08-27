<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionListRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $table = app('option-helper')->renderHtmlTable($request);
        $status = app('option-helper')->masterOptionDropdown('STATUS');
        return view('admin.option_list.list', compact('status'));
    }
    public function getOption(Request $request)
    {
        $data = app('option-helper')->getTableData($request);
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
            $data['view'] = view('admin.option_list.offcanvas')->render();
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
    public function store(OptionListRequest $request)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $params['list_type'] = $request->list_type;
            $params['option_value'] = strtoupper($request->option_value);
            $params['option_title'] = ucfirst($request->option_title);
            $params['sort_id'] = $request->sort_id;
            $option_exists = resolve('option-repo')->optionExists($params);
            if (!$option_exists) {
                $master_option_list = resolve('option-repo')->create($params);
                if (!empty($master_option_list)) {
                    $data['error'] = false;
                    $data['message'] = 'Option create successfully.';
                    $data['records'] = app('option-helper')->getTableData([]);
                    DB::commit();
                    return response()->json($data);
                }
                $data['error'] = true;
                $data['message'] = 'Option not created successfully..!';
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Option already exists!';
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
    public function edit($id)
    {
        $data = [];
        try {
            $option = resolve('option-repo')->findByID($id);
            $data['error'] = false;
            $data['view'] = view('admin.option_list.offcanvas', compact('option'))->render();
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
    public function update(Request $request, $id)
    {
        $data = $params = [];
        DB::beginTransaction();
        try {
            $params['id'] = $id;
            $params['list_type'] = $request->list_type;
            $params['option_value'] = strtoupper($request->option_value);
            $params['option_title'] = ucfirst($request->option_title);
            $params['sort_id'] = $request->sort_id;
            $option_exists = resolve('option-repo')->optionExists($params);
            if (!$option_exists) {
                $master_option_list = resolve('option-repo')->update($params, $id);
                if (!empty($master_option_list)) {
                    $data['error'] = false;
                    $data['message'] = 'Option updated successfully.';
                    DB::commit();
                    return response()->json($data);
                }
                $data['error'] = true;
                $data['message'] = 'Option not updated successfully..!';
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'Option already exists!';
            return response()->json($data);
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
            $user = resolve('option-repo')->findById($id);
            if ($user) {
                $user->delete();
                $data['error'] = false;
                $data['message'] = 'Option deleted successfully..!';
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
            $user = app('option-helper')->changeStatus($id);
            if ($user) {
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
