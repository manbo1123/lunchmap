<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
//use Illuminate\Support\Str;                   // URLを使う場合
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin/*')) {
            //if ( Route::is('admin.*') ) {   // ルーティングを使う場合
            //$uri = $request->path();        // URLを使う場合
            //if (Str::startsWith($uri, ['admin/'])) {
                return route('admin.login');
            }
            return route('login');
        }
    }
}
