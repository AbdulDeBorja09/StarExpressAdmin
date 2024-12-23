<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function alllogs(Request  $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $logs = Logs::latest()->paginate($perPage);

        return view('admin.logs', compact('perPage', 'currentPage', 'logs'));
    }
    public function editlogs(Request  $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $logs = Logs::where('action', 'Edit')->latest()->paginate($perPage);

        return view('admin.logs', compact('perPage', 'currentPage', 'logs'));
    }
    public function deletelogs(Request  $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $logs = Logs::where('action', 'Delete')->latest()->paginate($perPage);

        return view('admin.logs', compact('perPage', 'currentPage', 'logs'));
    }
}
