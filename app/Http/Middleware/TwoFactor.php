<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (auth()->check() && $user->two_factor_code) {
            if ($user->two_factor_expires_at < now()) {
                app('user-helper')->resetTwoFactorCode($user);
                // auth()->logout();

                return redirect()->route('admin.login')
                    ->withMessage('The two factor code has expired. Please login again.');
            }

            if (!$request->is('admin/otp=verify*')) {
                return redirect()->route('admin.otp.verify');
            }
        }

        // if (auth()->check() && $user->two_factor_code) {
        //     if ($user->two_factor_expires_at < now()) {
        //         app('user-helper')->resetTwoFactorCode($user);
        //         auth()->logout();

        //         return redirect()->route('login')
        //             ->withMessage('The two factor code has expired. Please login again.');
        //     }

        //     $url = parse_url(url()->previous());

        //     if (str_contains($url['path'], 'wireframe')) {
        //         return redirect()->route('wireframe.verify.index');
        //     } else {
        //         if (!$request->is('verify*')) {
        //             return redirect()->route('verify.index');
        //         }
        //     }
        // }

        return $next($request);
    }
}
