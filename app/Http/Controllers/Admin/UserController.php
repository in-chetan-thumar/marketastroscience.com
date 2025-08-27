<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\ColumnHasAccess;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $table = app('user-helper')->renderHtmlTable($request);
        $status = app('option-helper')->masterOptionDropdown('STATUS');
        $roles = resolve('role-repo')->activeItemDropDown();
        // $columns = ColumnHasAccess::orderBy('column_index')->where('table', 'USER')->get();
        return view('admin.user.user_list', compact('roles', 'status'));
    }
    public function getUsers(Request $request)
    {
        $data = app('user-helper')->getTableData($request);
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
            $roles = resolve('role-repo')->activeItemDropDown();
            $data['error'] = false;
            $data['view'] = view('admin.user.offcanvas', compact('roles'))->render();
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
    public function store(UserRequest $request)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $this->validate($request, [
                'mobile' => ['required', Rule::unique('users')],
                'email' => ['required', Rule::unique('users')],
            ]);
            // Create user
            $roleId = (int) $request->role;
            $password = app('common-helper')->randomPasswordGenerator();
            $params['role'] = $roleId;
            $params['name'] = $request->name;
            $params['mobile'] = $request->mobile;
            $params['email'] = $request->email;
            $params['password'] = Hash::make($password);
            $user = resolve('user-repo')->create($params);
            if (!empty($user)) {
                // Send Mail Username and Password
                $params = [];
                $params['user'] = $user->name;
                $params['email'] = $request->email;
                $params['password'] = $password;
                $params['role_name'] = $user->getRoleNames()->first();
                //                Mail::send(new UserCreateNotification($params));
                $data['error'] = false;
                $data['message'] = 'User create successfully.';
                // $data['records'] = app('user-helper')->getTableData($request);
                DB::commit();
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'User not created successfully..!';
            // $data['records'] = app('user-helper')->getTableData($request);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        try {
            $user = resolve('user-repo')->findByID($id);
            $roles = resolve('role-repo')->activeItemDropDown();
            $data['error'] = false;
            $data['view'] = view('admin.user.offcanvas', compact('roles', 'user'))->render();
            return response()->json($data);

        } catch (\Exception $e) {
            $data['error'] = true;
            $data['message'] = resolve('common-helper')->generateErrorMessage($e);
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            $this->validate($request, [
                'mobile' => ['required', Rule::unique('users')->ignore($id, 'id')],
                'email' => ['required', Rule::unique('users')->ignore($id, 'id')],
            ]);
            // Update user
            $params = [];
            $roleId = (int) $request->role;
            $params['role'] = $roleId;
            $params['mobile'] = $request->mobile;
            $params['name'] = $request->name;
            $params['email'] = $request->email;
            $user = resolve('user-repo')->update($params, $id);
            if (!empty($user)) {
                $data['error'] = false;
                $data['message'] = 'User update successfully.';
                // $data['records'] = app('user-helper')->getTableData($request);
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

    //  Delete user
    public function delete($id)
    {
        try {
            $data = [];
            $user = resolve('user-repo')->findById($id);
            if ($user) {
                $user->delete();
                $data['error'] = false;
                $data['message'] = $user->name . ' deleted successfully..!';
                // $data['records'] = app('user-helper')->getTableData([]);
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
            $user = app('user-helper')->changeStatus($id);
            if ($user) {
                $data['error'] = false;
                $data['message'] = 'Status changed successfully..!';
                // $data['records'] = app('user-helper')->getTableData([]);
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

    // Change Password
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $params = [];
            $params['password'] = Hash::make($request->password);
            $user = app('user-helper')->changePassword($params, auth()->user()->id);
            if ($user) {
                toastr()->success('Password changed successfully..!');
            } else {
                toastr()->error('Password not changed successfully..!');
            }
        } catch (\Exception $e) {
            toastr()->error(resolve('common-helper')->generateErrorMessage($e));
        }
        return redirect()->back();
    }

}
