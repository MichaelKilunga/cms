<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\FinanceReportController;
use App\Http\Controllers\QuarterlyReportController;
use App\Http\Controllers\DisbursementReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth', 'verified')->group(function () {
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

    
    Route::resource('finance', FinanceReportController::class);
    Route::resource('quarterly', QuarterlyReportController::class);
    Route::resource('disbursement', DisbursementReportController::class);

});

require __DIR__.'/auth.php';


// Route::get('/service', function () {
//     return view('attendance.index');
// })->middleware(['auth', 'verified'])->name('service');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/finances', function () {
    return view('finance');
})->middleware(['auth', 'verified'])->name('finance');


Route::get('/members', function () {
    return view('attendance.index');
})->middleware(['auth', 'verified'])->name('member');


Route::get('/departments', function () {
    return view('department');
})->middleware(['auth', 'verified'])->name('department');


Route::get('/messages', function () {
    return view('message');
})->middleware(['auth', 'verified'])->name('message');


Route::get('/reports', function () {
    return view('report');
})->middleware(['auth', 'verified'])->name('report');