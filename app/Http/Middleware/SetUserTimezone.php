<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SetUserTimezone
{
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user
        $user = Auth::user();

        if ($user) {
            // Get the country of the user from the authenticated user
            $country = $user->branch->country; // Adjust this based on your relationship
            $timezones = config('timezones');

            // Set the timezone if the country exists in the timezone mapping
            if (array_key_exists($country, $timezones)) {
                date_default_timezone_set($timezones[$country]);
                Log::info("Timezone set to: {$country} for user ID: " . Auth::id());
            }
        }

        return $next($request);
    }
}
