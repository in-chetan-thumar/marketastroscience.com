<?php

namespace App\Http\Controllers\Wireframe\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = app('option-helper')->masterOptionDropdown('STATUS');
        $roles = resolve('role-repo')->activeItemDropDown();
        return view('wireframe.admin.user.user_list', compact('roles', 'status'));
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
            $data['view'] = view('wireframe.admin.user.offcanvas', compact('roles'))->render();
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
    public function store(Request $request)
    {
        try {
            $data = $params = [];
            DB::beginTransaction();
            // Create user
            $password = app('common-helper')->randomPasswordGenerator();
            $params['role'] = $request->role;
            $params['name'] = $request->name;
            $params['mobile'] = $request->mobile;
            $params['email'] = $request->email;
            $params['password'] = Hash::make($password);
            $user = $params;
            if (!empty($user)) {
                $data['error'] = false;
                $data['message'] = 'User create successfully.';
                DB::commit();
                return response()->json($data);
            }
            $data['error'] = true;
            $data['message'] = 'User not created successfully..!';
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
            $user = ['name' => 'Admin', 'mobile' => '7777777777', 'email' => 'admin@mailinator.com', 'role' => 2];
            $roles = resolve('role-repo')->activeItemDropDown();

            $data['error'] = false;
            $data['view'] = view('wireframe.admin.user.offcanvas', compact('roles', 'user'))->render();
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
            // Update user
            $params = [];
            $params['role'] = $request->role;
            $params['mobile'] = $request->mobile;
            $params['name'] = $request->name;
            $params['email'] = $request->email;
            $user = $params;
            if (!empty($user)) {
                $data['error'] = false;
                $data['message'] = 'User update successfully.';
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


    public function changeStatus()
    {
        toastr()->success('Status changed successfully..!');
        return redirect()->route('wireframe.usermanagements.index');

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
