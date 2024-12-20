<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:Church Board'])->group(function () {
    Route::get('/church-board', [ChurchBoardController::class, 'index'])->name('church-board.index');
});

Route::middleware(['auth', 'role:Branch Admin'])->group(function () {
    Route::get('/branch-admin', [BranchAdminController::class, 'index'])->name('branch-admin.index');
});
