<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;


// Auth routes with email verification
Auth::routes(['verify' => true]);


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [AdminController::class, 'index'])->name('backend.dashboard.layouts.app');


//resource CRUD

Route::resource('employees', EmployeeController::class);

Route::resource('branches', BranchController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('designations', DesignationController::class);



Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


// Group routes for authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])
        ->name('backend.dashboard.layouts.app');

    Route::get('/verify-form', [App\Http\Controllers\VerificationController::class, 'showVerifyForm'])
        ->name('verify.form');

    Route::post('/verify-number', [App\Http\Controllers\VerificationController::class, 'verifyNumber'])
        ->name('verify.number');
});
