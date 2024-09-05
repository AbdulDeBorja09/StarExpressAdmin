<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackLoginAttempts
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') && $request->is('login')) {
            $attempts = session()->get('login_attempts', 0);
            session()->put('login_attempts', $attempts + 1);

            if ($attempts >= 1) {
                session()->put('show_reset_password', true);
            } else {
                session()->put('show_reset_password', false);
            }
        }

        return $next($request);
    }
}
