<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class UserHelper
{
    public function getTableData($request)
    {
        try {
            $data = $params = [];
            $params['query_str'] = $request->query_str ?? '';
            $params['role'] = $request->role ?? '';
            $params['is_active'] = $request->is_active ?? '';

            // Determine if pagination parameters are present
            $paginate = isset($request->start) && isset($request->length);
            if ($paginate) {
                $page = $request->start / $request->length + 1;
                $length = $request->length;
                $start = ($page - 1) * $length;
            }

            // Retrieve the users with filtering
            $usersQuery = resolve('user-repo')->filter($params);

            // Get the total count of records before filtering
            $totalRecords = User::count();

            // Get the filtered count of records
            $filteredRecords = $usersQuery->count();

            // Apply ordering
            if (isset($request->order) && isset($request->columns)) {
                $order = $request->order[0];
                $columnIndex = $order['column'];
                $columnName = $request->columns[$columnIndex]['data'];
                $direction = $order['dir'];

                if (in_array($columnName, ['name', 'email', 'created_at'])) {
                    $usersQuery = $usersQuery->orderBy($columnName, $direction);
                }
            }

            // Apply pagination if parameters are present
            if ($paginate) {
                $usersQuery = $usersQuery->skip($start)->take($length);
            }

            // Get the filtered and paginated results
            $users = $usersQuery->get();

            foreach ($users as $user) {
                $statusColumn = '<div class="form-check form-switch">';
                if ($user->is_active == 'Y') {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked title="Change Status" data-url="' . route('usermanagements.status', $user->id) . '" onclick="popupMassage(event)">';
                } else {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" title="Change Status" data-url="' . route('usermanagements.status', $user->id) . '" onclick="popupMassage(event)">';
                }
                $statusColumn .= '</div>';

                $data[] = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles()->first()->name,
                    'status' => $statusColumn,
                    'created_at' => Carbon::parse($user->created_at)->format('d-m-Y h:m:i'),
                    'action' => '<div class="btn-group" role="group">
    <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
    <div class="dropdown-menu">
    ' . (auth()->user()->can('usermanagements.edit') ?
                        '<a class="dropdown-item" onclick="showEditModel(event)" href="' . route('usermanagements.edit', $user->id) . '">Edit</a>' :
                        '') . '
    ' . (auth()->user()->can('usermanagements.delete') ?
                        '<a class="dropdown-item" data-url="' . route('usermanagements.delete', $user->id) . '" onclick="deletePopupMassage(event)">Delete</a>' :
                        '') . '
    </div>
</div>',
                    'id' => $user->id,
                ];
            }

            return [
                'draw' => $request->draw ?? 0,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
            ];
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => resolve('common-helper')->generateErrorMessage($e),
            ]);
        }
    }
    public function changeStatus($id)
    {
        $user = resolve('user-repo')->findByID($id);
        if ($user->is_active == 'Y') {
            $user->is_active = 'N';
        } else {
            $user->is_active = 'Y';
        }
        return $user->save();
    }
    public function activeItemDropDown($params = [])
    {
        $params['is_active'] = 'Y';
        $params['order_by'] = ['name' => 'ASC'];

        return resolve('user-repo')->filter($params)->pluck('name', 'id');
    }
    public function changePassword($params, $id)
    {
        $user = resolve('user-repo')->findByID($id)->update($params);
        return $user;
    }
    public function verifyUserAccount($user)
    {
        $response['error'] = [];

        if (empty($user)) {
            $response['error'] = 'We can\'t find a user with these credentials.';
        }

        if ($user->is_active == 'N') {
            $response['error'] = 'You account is inactive, Please contact to administrator.';
        }

        if ($user->is_account_locked == 'Y' and $user->account_release_time_formatted > Carbon::now()->format('Y-m-d H:i:s')) {
            $response['error'] = 'Your account has been locked. Please try after sometimes.';
        }

        return $response;
    }

    public function recordLoginAttempts($user)
    {
        $response['error'] = '';

        if ($user->login_attempt < 5) {
            $user->increment('login_attempt');
        } else {
            if ($user->is_account_locked == 'Y' and $user->account_release_time_formatted < Carbon::now()->format('Y-m-d H:i:s')) {
                $user->update([
                    'login_attempt' => 0,
                    'is_account_locked' => 'N',
                    'account_locked_at' => null,
                ]);
                return null;
            } else {

                if (empty($user->account_locked_at)) {
                    $user->update([
                        'is_account_locked' => 'Y',
                        'account_locked_at' => Carbon::now()->toDateTimeString(),
                    ]);
                }

                $response['error'] = 'Your account has been locked. Please try after sometimes.';
                return $response;
            }
        }
    }

    public function recordSuccessLoginAttempts($request, $user)
    {
        $user->update([
            'logins' => $user->logins + 1,
            'last_login_ip' => $request->getClientIp(),
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'mobile_login_attempt' => 0,
            'is_account_locked' => 'N',
            'login_attempt' => 0,
            'account_locked_at' => null,
            'two_factor_code_resend_attempt' => 0
        ]);
        $user->save();
    }

    public function generateTwoFactorCode($user)
    {
        $user->timestamps = false;
        $user->two_factor_code = rand(100000, 999999);
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->two_factor_code_resend_attempt = 0;
        $user->save();
    }


    public function resetTwoFactorCode($user)
    {
        $user->timestamps = false;
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->login_attempt = 0;
        $user->save();
    }

    public function verifyTwoFactorCode($user, $two_factor_code)
    {
        $response['error'] = '';
        $login_attempt = $this->recordLoginAttempts($user);

        if (!empty($login_attempt['error'])) {
            return $login_attempt;
        }

        $is_otp_valid = FALSE;
        if ($two_factor_code == $user->two_factor_code) {
            $this->resetTwoFactorCode($user);
            $is_otp_valid = TRUE;
            $response['is_otp_valid'] = $is_otp_valid;
        } elseif (env('APP_ENV') != 'Production' and $two_factor_code == '111111') {
            $this->resetTwoFactorCode($user);
            $is_otp_valid = TRUE;
            $response['is_otp_valid'] = $is_otp_valid;
        } else {
            $response['error'] = 'Entered OTP is invalid';
            $response['is_otp_valid'] = $is_otp_valid;
        }

        return $response;
    }

    public function resendTwoFectorCode($user)
    {
        $response['error'] = '';
        $response['message'] = '';

        if ($user->two_factor_code_resend_attempt >= 5) {

            $user->is_account_locked = 'Y';
            $user->account_locked_at = Carbon::now()->toDateTimeString();
            $user->save();
            $response['error'] = 'Your can not use resend password funcality more then 5 times.';

        } else {
            // Send OTP to users again
            $user->increment('two_factor_code_resend_attempt');
            $response['message'] = "OTP sent successfully, Now only " . (5 - $user->two_factor_code_resend_attempt) . " attempt left";
        }
        return $response;
    }

}
