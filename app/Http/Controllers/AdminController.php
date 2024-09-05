<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminHome(): View
    {
        return view('admin.home');
    }
    public function allEmployees(): View
    {
        return view('admin.Employee.displayemployee');
    }
    public function addEmployees(): View
    {
        return view('admin.Employee.addemployee');
    }
    public function addDepartment(): View
    {
        return view('admin.Employee.adddepartment');
    }
}
