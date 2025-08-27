<?php

namespace App\Http\Controllers\Auth;

use App\Events\SMS;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Notifications\TwoFactorCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class TwoFactorController extends Controller
{
    public function showOtpVerifyForm()
    {
        // Check if user is in session for OTP verification
        $userId = session('2fa:user_id');
        if (!$userId) {
            return redirect()->route('admin.login')->withErrors(['username' => 'Page expired. Please login again.']);
        }
        $user = resolve('user-repo')->findByID($userId);
        return view('admin.auth.otp_verify', compact('user'));
    }

    // public function verifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'otp' => 'required|numeric|digits:6',
    //     ]);

    //     // Check if user is in session for OTP verification
    //     $userId = session('2fa:user_id');
    //     if (!$userId) {
    //         return redirect()->route('admin.login')->withErrors(['username' => 'Page expired. Please login again.']);
    //     }

    //     // Fetch user and verify OTP
    //     $user = resolve('user-repo')->findByID($userId);
    //     if (!$user || !app('user-helper')->verifyTwoFactorCode($user, $request->otp)) {
    //         return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
    //     }

    //     // OTP verified, log the user in
    //     auth()->loginUsingId($userId);
    //     session()->forget('2fa:user_id'); // Remove 2FA session data
    //     $role = Role::where('name', auth()->user()->getRoleNames()->first())->get()->first();
    //     $redirectTo = $role->redirect_to ?? 'root';
    //     return redirect($redirectTo);
    // }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'numeric|required|digits:6',
        ]);
        // Check if user is in session for OTP verification
        $userId = session('2fa:user_id');
        if (!$userId) {
            return redirect()->route('admin.login')->withErrors(['username' => 'Page expired. Please login again.']);
        }

        // Fetch user and verify OTP
        $user = resolve('user-repo')->findByID($userId);
        $two_factor_code = $request->input('two_factor_code', '');

        $verify_user = app('user-helper')->verifyUserAccount($user);
        if (!empty($verify_user['error'])) {
            auth()->logout();
            $errors = new MessageBag(['username' => [$verify_user['error']]]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.
            return redirect()->back()->withErrors($errors); // redirect back to the login page, using ->withErrors($errors) you send the error created above
        }

        $verify_two_factor_code_status = app('user-helper')->verifyTwoFactorCode($user, $two_factor_code);

        if (!empty($verify_two_factor_code_status['error'])) {

            if (auth()->user()->is_account_locked == 'Y') {
                auth()->logout();
                return redirect()->route('login')->withErrors(['username' => $verify_two_factor_code_status['error']]);
            }

            return redirect()->back()->withErrors(['two_factor_code' => $verify_two_factor_code_status['error']]);
        }

        if ($verify_two_factor_code_status['is_otp_valid']) {
            app('user-helper')->resetTwoFactorCode($user);
            app('user-helper')->recordSuccessLoginAttempts($request, $user);
            // OTP verified, log the user in
            auth()->loginUsingId($userId);
            session()->forget('2fa:user_id'); // Remove 2FA session data
            $role = Role::where('name', auth()->user()->getRoleNames()->first())->get()->first();
            $redirectTo = $role->redirect_to ?? 'root';
            return redirect()->route($redirectTo);
        }

        return redirect()->back()
            ->withErrors([
                'two_factor_code' =>
                    'The OTP you have entered does not match'
            ]);
    }

    public function resend()
    {
        $user = auth()->user();

        $verify_user = app('user-helper')->verifyUserAccount($user);
        if (!empty($verify_user['error'])) {
            auth()->logout();
            toastr()->error($verify_user['error']);
            return redirect()->back();
        }

        $resend_two_fector_code = app('user-helper')->resendTwoFectorCode($user);
        if (!empty($resend_two_fector_code['error'])) {
            auth()->logout();
            toastr()->error($resend_two_fector_code['error']);
            return redirect()->back();

        }

        toastr()->success($resend_two_fector_code['message']);
        return redirect()->back();
    }
}
