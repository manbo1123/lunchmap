<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    //public function handle(Request $request, Closure $next, ...$guards)
    public function handle(Request $request, Closure $next, $guard=null)
    {
        // $guards = empty($guards) ? [null] : $guards;

        //foreach ($guards as $guard) {
            //if (Auth::guard($guard)->check() && $guard == 'admin') {
            if (Auth::guard('admin')->check()) {
                return redirect(RouteServiceProvider::ADMIN_HOME)
                        ->with('flash_message', '⚠️ 管理者としてログイン中です。ログアウトが必要です。');
            } elseif (Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME)
                        ->with('flash_message', '⚠️ ログイン中です。ログアウトが必要です。');
            }
        //}

        return $next($request);
    }
}
