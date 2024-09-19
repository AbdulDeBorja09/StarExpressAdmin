<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManagementController;

Route::get('/', [LoginController::class, 'showLoginForm']);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();
        if ($user->type === 'accountant') {
            return redirect()->route('accountant.home');
        } elseif ($user->type === 'admin') {
            return redirect()->route('admin.home');
        }
    });
});

Route::middleware(['auth', 'user-access:accountant'])->group(function () {
    Route::get('/accountant', [AdminController::class, 'accountantHome'])->name('accountant.home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/Management', [ManagementController::class, 'management'])->name('admin.managment');
    Route::get('/Employees', [ManagementController::class, 'allEmployees'])->name('admin.allEmployees');
    Route::get('/Employees/add', [ManagementController::class, 'addEmployees'])->name('admin.addEmployees');
    Route::get('/Services', [ManagementController::class, 'services'])->name('admin.Services');



    Route::post('/Employees/add', [ManagementController::class, 'submitaddEmployees'])->name('submitaddEmployees');
    Route::post('/Management/branch', [ManagementController::class, 'submitaddBranch'])->name('submitaddbranch');
    Route::post('/Management/country', [ManagementController::class, 'submitaddcountry'])->name('submitaddcountry');
    Route::post('/Services', [ManagementController::class, 'submitaddservices'])->name('submitaddservices');
});
