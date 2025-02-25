<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function toggle(Request $request)
    {
        $status = DB::table('maintenance')->value('is_enabled');

        DB::table('maintenance')->update([
            'is_enabled' => !$status,
            'reason' => $request->input('reason', null),
            'date' => $request->input('estimated_up_time', null),
        ]);

        return back()->with('success', 'Maintenance mode updated!');
    }
}
