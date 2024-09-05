<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/admin', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/Employees', [AdminController::class, 'allEmployees'])->name('admin.allEmployees');
    Route::get('/admin/Employees/add', [AdminController::class, 'addEmployees'])->name('admin.addEmployees');
    Route::get('/admin/Department/add', [AdminController::class, 'addDepartment'])->name('admin.addDepartment');
    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
});
