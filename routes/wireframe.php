<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| wireframe Routes
|--------------------------------------------------------------------------
|
| Here is where you can register wireframe routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "wireframe" middleware group. Now create something great!
|
*/


$middleware = ['auth', 'throttle:120,1'];
Route::group(['prefix' => 'wireframe'], function () use ($middleware) {
   // show form route
   Route::any('login', [App\Http\Controllers\Wireframe\Auth\LoginController::class, 'showLoginForm'])->name('wireframe.login');
   Route::any('w-login', [App\Http\Controllers\Wireframe\Auth\LoginController::class, 'login'])->name('w.login');

   Route::any('verify/resend', [\App\Http\Controllers\Wireframe\Auth\TwoFactorController::class, 'resend'])->name('wireframe.verify.resend');
   Route::get('verify', [App\Http\Controllers\Wireframe\Auth\TwoFactorController::class, 'index'])->name('wireframe.verify.index');
   Route::any('store', [App\Http\Controllers\Wireframe\Auth\TwoFactorController::class, 'store'])->name('wireframe.verify.store.index');
   Route::any('logout', [App\Http\Controllers\Wireframe\Auth\LoginController::class, 'logout'])->name('wireframe.logout');

   Route::get('/', [App\Http\Controllers\Wireframe\Admin\DashboardController::class, 'root'])->name('wireframe.root');

   // User Controller Route
   Route::get('usermanagements', [\App\Http\Controllers\Wireframe\Admin\UserController::class, 'index'])->name('wireframe.usermanagements.index');
   Route::get('usermanagements/edit/{id}', [\App\Http\Controllers\Wireframe\Admin\UserController::class, 'edit'])->name('wireframe.usermanagements.edit');
   Route::get('usermanagements/create', [\App\Http\Controllers\Wireframe\Admin\UserController::class, 'create'])->name('wireframe.usermanagements.create');
   Route::any('usermanagements/store', [\App\Http\Controllers\Wireframe\Admin\UserController::class, 'store'])->name('wireframe.usermanagements.store');
   Route::any('usermanagements/update/{id}', [\App\Http\Controllers\Wireframe\Admin\UserController::class, 'update'])->name('wireframe.usermanagements.update');
   Route::get('/usermanagement/status', [App\Http\Controllers\Wireframe\Admin\UserController::class, 'changeStatus'])->name('wireframe.usermanagements.status');

   // User Profile Controller
   Route::any('/profile', [\App\Http\Controllers\Wireframe\Admin\UserProfileController::class, 'index'])->name('wireframe.profile.index');
   Route::post('/change/password', [\App\Http\Controllers\Wireframe\Admin\UserProfileController::class, 'changePassword'])->name('wireframe.change.password');

});
