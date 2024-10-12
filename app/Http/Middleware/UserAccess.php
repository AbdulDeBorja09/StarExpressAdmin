<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userTypes): Response
    {
        if (Auth::check()) { // Use Auth::check() instead
            $typesArray = explode('|', $userTypes);
            if (in_array(Auth::user()->type, $typesArray)) {
                return $next($request);
            }
        }

        return redirect()->route('login')->withErrors(['access_denied' => 'You do not have permission to access this page.']);
    }
}
