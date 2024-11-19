<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\AllUserController;
use App\Http\Controllers\SuperAdminReportsController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::middleware(['auth', 'role:admin'])->group(function () {
    
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::prefix('branch/{branch}')->group(function () {
        Route::get('/users', [AdminController::class, 'viewUsers'])->name('branch.users');
        Route::post('/users', [AdminController::class, 'createUser'])->name('branches.users.create');
        Route::put('/users/{user}', [AdminController::class, 'editUser'])->name('branches.users.edit');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('branches.users.delete');
    
        Route::get('/reports', [AdminController::class, 'viewReports'])->name('branch.reports');
        Route::get('/reports/{id}', [AdminController::class,'showReport'])->name('reports.show');
        Route::post('/reports', [AdminController::class, 'createReport'])->name('reports.create');
        Route::get('reports/create', [AdminController::class, 'createReportView'])->name('reports.create');
        Route::get('reports/{report}/edit', [AdminController::class, 'reportEditView'])->name('edit.reports');
        Route::put('reports/{report}', [AdminController::class, 'editReport'])->name('report.update');
        Route::delete('reports/{report}', [AdminController::class, 'deleteReport'])->name('reports.delete');
        
        Route::get('/', [BranchController::class, 'dashboard'])->name('branch.dashboard');
        Route::get('/edit', [BranchController::class, 'edit'])->name('branch.edit');

        Route::get('/member', [MemberController::class, 'index'])->name('member.index');
        Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
        // Route::get('/member/{member}/show', [MemberController::class, 'show'])->name('member.show');
        Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
        Route::get('/member/{member}/edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::put('/member/{member}', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/member/{member}', [MemberController::class, 'destroy'])->name('member.destroy');
        Route::get('/member/{member}', [MemberController::class, 'show'])->name('member.show');
        

    });



    //Routes for attendance
    // Route::get('/service', [AttendanceReportController::class,'index'])->name('service');
    // Route::get('/attendance', [AttendanceReportController::class,'index'])->name('attendance');
    // Route::get('/attendance/create', [AttendanceReportController::class,'create'])->name('attendance.create');
    // Route::post('/attendance', [AttendanceReportController::class,'store'])->name('attendance.store');
    // Route::get('/attendance/{id}', [AttendanceReportController::class,'show'])->name('attendance.show');
    // Route::get('/attendance/{id}/edit', [AttendanceReportController::class,'edit'])->name('attendance.edit');
    // Route::put('/attendance/{id}', [AttendanceReportController::class,'update'])->name('attendance.update');
    // Route::delete('/attendance/{id}', [AttendanceReportController::class,'destroy'])->name('attendance.destroy');

});


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/super', [SuperAdminController::class, 'index'])->name('super');

    Route::get('/users', [AllUserController::class, 'index'])->name('users');
    Route::post('/users', [AllUserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [AllUserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [AllUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AllUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AllUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/branches', [BranchController::class, 'index'])->name('branches');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');


    //Routes for attendance
    Route::get('/service', [SuperAdminReportsController::class,'index'])->name('service');
    // Route::get('/attendance', [SuperAdminReportsController::class,'index'])->name('attendance');
    Route::get('/attendance/create', [SuperAdminReportsController::class,'create'])->name('attendance.create');
    Route::put('/attendance/verify/{id}', [SuperAdminReportsController::class,'update'])->name('attendance.verify');
    Route::put('/attendance/reject/{id}', [SuperAdminReportsController::class,'update'])->name('attendance.reject');
    Route::get('/attendance/{id}', [SuperAdminReportsController::class,'show'])->name('attendance.show');
    // Route::get('/attendance/{id}/edit', [SuperAdminReportsController::class,'edit'])->name('attendance.edit');
    // Route::put('/attendance/{id}', [SuperAdminReportsController::class,'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [SuperAdminReportsController::class,'destroy'])->name('attendance.destroy');
    
});

require __DIR__.'/auth.php';