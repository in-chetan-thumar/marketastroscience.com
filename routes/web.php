<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

$middleware = ['auth', 'throttle:120,1', 'app.access.check'];

if (config('constants.MOBILE_OTP_LOGIN') || config('constants.EMAIL_OTP_LOGIN')) {
    array_push($middleware, 'twofactor');
}

Route::get('admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');

Route::get('admin/otp-verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'showOtpVerifyForm'])->name('admin.otp.verify');
Route::post('admin/otp-verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'verifyOtp'])->name('admin.verifyOtp');
// Route::post('admin/verify/resend', [\App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('admin.verify.resend');

Route::get('verify/resend', [\App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('admin.verify.resend');
// Route::resource('verify', \App\Http\Controllers\Auth\TwoFactorController::class)->only(['index', 'store']);

Route::group(['middleware' => $middleware], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'root'])->name('root')->middleware('auth');

    // Role Controller
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);

    // Permission Controller
    Route::resource('permission', \App\Http\Controllers\Admin\PermissionController::class);
    Route::get('get-permission', [\App\Http\Controllers\Admin\PermissionController::class, 'getPermissions'])->name('permission.data');
    Route::delete('/permission/delete/{id}', [\App\Http\Controllers\Admin\PermissionController::class, 'delete'])->name('permission.delete');
    Route::get('/status/{id}', [\App\Http\Controllers\Admin\PermissionController::class, 'changeStatus'])->name('permission.status');

    // User Controller Route
    Route::resource('usermanagements', \App\Http\Controllers\Admin\UserController::class);
    Route::get('get-users', [\App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('usermanagements.data');
    Route::delete('/usermanagement/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('usermanagements.delete');
    Route::get('/usermanagement/status/{id}', [\App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('usermanagements.status');

    // Option list Controller
    Route::resource('option-list', \App\Http\Controllers\Admin\OptionlistController::class);
    Route::get('get-option', [\App\Http\Controllers\Admin\OptionlistController::class, 'getOption'])->name('option.list.data');
    Route::delete('/option-list/delete/{id}', [\App\Http\Controllers\Admin\OptionlistController::class, 'delete'])->name('option.list.delete');
    Route::get('/option-list-status/{id}', [\App\Http\Controllers\Admin\OptionlistController::class, 'changeStatus'])->name('option.list.status');

    // Blog list Controller
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    Route::get('get-blogs', [\App\Http\Controllers\Admin\BlogController::class, 'getBlogs'])->name('blogs.data');
    Route::delete('/blog/delete/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'delete'])->name('blog.delete');
    Route::get('/blog-status/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'changeStatus'])->name('blog.status');

    // Enquiry list Controller
    Route::resource('enquiries', \App\Http\Controllers\Admin\EnquiryController::class);
    Route::get('get-enquiries', [\App\Http\Controllers\Admin\EnquiryController::class, 'getEnquiries'])->name('enquiries.data');
    Route::delete('/enquiry/delete/{id}', [\App\Http\Controllers\Admin\EnquiryController::class, 'delete'])->name('enquiry.delete');
    Route::get('/enquiry-status/{id}', [\App\Http\Controllers\Admin\EnquiryController::class, 'changeStatus'])->name('enquiry.status');

    // User Profile Controller
    Route::resource('profiles', \App\Http\Controllers\Admin\UserProfileController::class);
    Route::get('/profile', [\App\Http\Controllers\Admin\UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/change/password', [\App\Http\Controllers\Admin\UserProfileController::class, 'changePassword'])->name('change.password');

    // Email Template Controller
    Route::get('email-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'emailIndex'])->name('email.templates');
    Route::post('email-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'emailStore'])->name('email.templates.store');
    Route::get('sms-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'SMSIndex'])->name('sms.templates');
    Route::post('sms-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'SMSStore'])->name('sms.templates.store');
    Route::get('whatsapp-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'WhatsAppIndex'])->name('whatsapp.templates');
    Route::post('whatsapp-templates', [App\Http\Controllers\Admin\MessageTemplateController::class, 'WhatsAppStore'])->name('whatsapp.templates.store');

});

Route::get('/form-custom-field', function () {
    return view('custom-form-field');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::post('/enquiry-store', [App\Http\Controllers\Frontend\HomeController::class, 'enquiryStore'])->name('enquiry.store');
Route::get('/view/blogs/{slug?}', [App\Http\Controllers\Frontend\HomeController::class, 'viewBlog'])->name('blog.view');

// Event Registration Routes
Route::get('/event/astro-trading-masterclass', [App\Http\Controllers\Frontend\EventController::class, 'index'])->name('event.landing');
Route::post('/event/register', [App\Http\Controllers\Frontend\EventController::class, 'register'])->name('event.register');
Route::post('/event/verify-otp', [App\Http\Controllers\Frontend\EventController::class, 'verifyOtp'])->name('event.verify.otp');
Route::post('/event/resend-otp', [App\Http\Controllers\Frontend\EventController::class, 'resendOtp'])->name('event.resend.otp');
Route::get('/event/success/{registrationId}', [App\Http\Controllers\Frontend\EventController::class, 'success'])->name('event.success');
Route::post('/event/generate-referral', [App\Http\Controllers\Frontend\EventController::class, 'generateReferral'])->name('event.generate.referral');
Route::get('/event/invite', [App\Http\Controllers\Frontend\EventController::class, 'invitePage'])->name('event.invite');
Route::get('/event/feedback', [App\Http\Controllers\Frontend\EventController::class, 'feedbackPage'])->name('event.feedback');
Route::post('/event/feedback', [App\Http\Controllers\Frontend\EventController::class, 'submitFeedback'])->name('event.feedback.submit');

Route::get('/get-districts', [App\Http\Controllers\Frontend\HomeController::class, 'getDistricts']);


Route::any('/send-sms', [App\Http\Controllers\NotificationController::class, 'sendMessage']);
