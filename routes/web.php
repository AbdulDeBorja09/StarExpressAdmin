<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagementController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth', 'user-access:employee'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/Employees', [AdminController::class, 'allEmployees'])->name('admin.allEmployees');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/Management', [AdminController::class, 'management'])->name('admin.managment');
    Route::get('/Employees', [AdminController::class, 'allEmployees'])->name('admin.allEmployees');
    Route::get('/Employees/add', [AdminController::class, 'addEmployees'])->name('admin.addEmployees');

    Route::post('/Employees/add', [ManagementController::class, 'submitaddEmployees'])->name('submitaddEmployees');
    Route::post('/Management/branch', [ManagementController::class, 'submitaddBranch'])->name('submitaddbranch');
    Route::post('/Management/country', [ManagementController::class, 'submitaddcountry'])->name('submitaddcountry');
    Route::get('/get-positions/{branch}', [AdminController::class, 'getPositions']);
});
