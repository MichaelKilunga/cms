<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'can:login'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'can:manage church'])->group(function () {
    // Route::resource('churches', ChurchController::class); 
    // ROLES ROUTER
    Route::get('churches', [ChurchController::class, 'index'])->name('churches');
    Route::get('churches/create', [ChurchController::class, 'create'])->name('churches.create');
    Route::post('churches', [ChurchController::class, 'store'])->name('churches.store');
    Route::get('churches/{church}/edit', [ChurchController::class, 'edit'])->name('churches.edit');
    Route::put('churches/{church}', [ChurchController::class, 'update'])->name('churches.update');
    Route::delete('churches/{church}', [ChurchController::class, 'destroy'])->name('churches.destroy');

});

Route::middleware(['auth', 'can:manage finances'])->group(function () {

    // ROLES ROUTER
    Route::get('roles', [RolePermissionController::class, 'index'])->name('roles');
    Route::get('roles/create', [RolePermissionController::class, 'create'])->name('roles.create');
    Route::post('roles', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}/edit', [RolePermissionController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RolePermissionController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RolePermissionController::class, 'destroy'])->name('roles.destroy');

    // USERS ROUTES
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
