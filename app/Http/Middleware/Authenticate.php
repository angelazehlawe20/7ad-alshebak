<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            // إذا كنت تستخدم أكثر من guard
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login.form'); // مسار تسجيل دخول الأدمن
            }
            return null;
        }
    }
}
