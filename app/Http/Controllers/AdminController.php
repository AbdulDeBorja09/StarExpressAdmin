<?php

namespace App\Http\Controllers;

use App\Models\CargoService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Management;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function adminHome(): View
    {
        return view('dashboard.admin');
    }

    public function accountantHome(): View
    {
        return view('dashboard.accountant');
    }

    public function servicemanagerHome(): View
    {
        return view('dashboard.servicemanager');
    }

    
}
