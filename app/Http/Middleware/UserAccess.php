<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userTypes): Response
    {
        if (auth()->check()) {
            // Split the user types into an array
            $typesArray = explode('|', $userTypes);

            // Check if the user's type matches any of the allowed types
            if (in_array(auth()->user()->type, $typesArray)) {
                return $next($request);
            }
        }

        return redirect()->route('login')->withErrors(['access_denied' => 'You do not have permission to access this page.']);
    }
}
