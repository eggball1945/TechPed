<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {

            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            }

            if ($request->routeIs('petugas.*')) {
                return route('petugas.auth.index');
            }

            return route('user.login');
        }
    }
}