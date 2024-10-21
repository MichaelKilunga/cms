<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\FinanceReportController;
use App\Http\Controllers\QuarterlyReportController;
use App\Http\Controllers\DisbursementReportController;
use App\Http\Controllers\UserController;
use Laravel\Jetstream\Role;
use App\Http\Controllers\BranchController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth', 'verified','role:super-admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes for attendance
    Route::get('/service', [AttendanceReportController::class,'index'])->name('service');
    Route::get('/attendance', [AttendanceReportController::class,'index'])->name('attendance');
    Route::get('/attendance/create', [AttendanceReportController::class,'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceReportController::class,'store'])->name('attendance.store');
    Route::get('/attendance/{id}', [AttendanceReportController::class,'show'])->name('attendance.show');
    Route::get('/attendance/{id}/edit', [AttendanceReportController::class,'edit'])->name('attendance.edit');
    Route::put('/attendance/{id}', [AttendanceReportController::class,'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [AttendanceReportController::class,'destroy'])->name('attendance.destroy');

});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:super-admin'])->name('dashboard');

Route::middleware(['auth','role:super-admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/branches', [BranchController::class, 'index'])->name('branches');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');

});

