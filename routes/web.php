<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\church_admin\ChurchAdminController;
use App\Http\Controllers\church_admin\ChurchAdminBranchController;
use App\Http\Controllers\church_admin\ChurchAdminMemberController;
use App\Http\Controllers\church_admin\ChurchAdminServiceController;
use App\Http\Controllers\church_admin\ChurchAdminFinanceController;
use App\Http\Controllers\church_admin\ChurchAdminRolePermissionController;
use App\Http\Controllers\church_admin\ChurchAdminServiceCategoryController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'can:manage system'])->group(function () {
    // CHURCHES ROUTES
    Route::get('churches', [ChurchController::class, 'index'])->name('churches');
    Route::get('churches/create', [ChurchController::class, 'create'])->name('churches.create');
    Route::post('churches', [ChurchController::class, 'store'])->name('churches.store');
    Route::get('churches/{church}', [ChurchController::class, 'show'])->name('churches.show');
    Route::get('churches/{church}/edit', [ChurchController::class, 'edit'])->name('churches.edit');
    Route::put('churches/{church}', [ChurchController::class, 'update'])->name('churches.update');
    Route::delete('churches/{church}', [ChurchController::class, 'destroy'])->name('churches.destroy');

    // ROLES ROUTES
    Route::get('roles', [RolePermissionController::class, 'index'])->name('roles');
    Route::get('roles/create', [RolePermissionController::class, 'create'])->name('roles.create');
    Route::post('roles', [RolePermissionController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}', [RolePermissionController::class, 'show'])->name('roles.show');
    Route::get('roles/{role}/edit', [RolePermissionController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RolePermissionController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RolePermissionController::class, 'destroy'])->name('roles.destroy');

    // USERS ROUTES
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // BRANCHES ROUTES
    Route::get('branches', [BranchController::class, 'index'])->name('branches');
    Route::get('branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
    Route::get('branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');

    // MEMBERS ROUTES
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::get('members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('members', [MemberController::class, 'store'])->name('members.store');
    Route::get('members/{member}', [MemberController::class, 'show'])->name('members.show');
    Route::get('members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

    // SERVICES ROUTES
    Route::get('services', [ServiceController::class, 'index'])->name('services');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // FINANCES ROUTES
    Route::get('finances', [FinanceController::class, 'index'])->name('finances');
    Route::get('finances/create', [FinanceController::class, 'create'])->name('finances.create');
    Route::post('finances', [FinanceController::class, 'store'])->name('finances.store');
    Route::get('finances/{finance}/edit', [FinanceController::class, 'edit'])->name('finances.edit');
    Route::get('finances/{finance}', [FinanceController::class, 'show'])->name('finances.show');
    Route::put('finances/{finance}', [FinanceController::class, 'update'])->name('finances.update');
    Route::delete('finances/{finance}', [FinanceController::class, 'destroy'])->name('finances.destroy');

    // MESSAGES ROUTES
    Route::get('messages', [MessageController::class, 'index'])->name('messages');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // MESSAGES ROUTES
    Route::get('service_categories', [ServiceCategoryController::class, 'index'])->name('service_categories');
    Route::get('service_categories/create', [ServiceCategoryController::class, 'create'])->name('service_categories.create');
    Route::post('service_categories', [ServiceCategoryController::class, 'store'])->name('service_categories.store');
    Route::get('service_categories/{service_category}/edit', [ServiceCategoryController::class, 'edit'])->name('service_categories.edit');
    Route::get('service_categories/{service_category}', [ServiceCategoryController::class, 'show'])->name('service_categories.show');
    Route::put('service_categories/{service_category}', [ServiceCategoryController::class, 'update'])->name('service_categories.update');
    Route::delete('service_categories/{service_category}', [ServiceCategoryController::class, 'destroy'])->name('service_categories.destroy');

});


Route::middleware(['auth', 'can:manage church'])->group(function () {
    // CHURCHES ROUTES
    Route::get('church_admin/church', [ChurchAdminController::class, 'index'])->name('church_admin.church');
    Route::get('church_admin/church/create', [ChurchAdminController::class, 'create'])->name('church_admin.church.create');
    Route::post('church_admin/church', [ChurchAdminController::class, 'store'])->name('church_admin.church.store');
    Route::get('church_admin/church/{church}', [ChurchAdminController::class, 'show'])->name('church_admin.church.show');
    Route::get('church_admin/church/{church}/edit', [ChurchAdminController::class, 'edit'])->name('church_admin.church.edit');
    Route::put('church_admin/church/{church}', [ChurchAdminController::class, 'update'])->name('church_admin.church.update');
    Route::delete('church_admin/church/{church}', [ChurchAdminController::class, 'destroy'])->name('church_admin.church.destroy');

    // // BRANCHES ROUTES
    Route::get('church_admin/branches', [ChurchAdminBranchController::class, 'index'])->name('church_admin.branches');
    Route::get('church_admin/branches/create', [ChurchAdminBranchController::class, 'create'])->name('church_admin.branches.create');
    Route::post('church_admin/branches', [ChurchAdminBranchController::class, 'store'])->name('church_admin.branch.store');
    Route::get('church_admin/branches/{branch}', [ChurchAdminBranchController::class, 'show'])->name('church_admin.branches.show');
    Route::get('church_admin/branches/{branch}/edit', [ChurchAdminBranchController::class, 'edit'])->name('church_admin.branches.edit');
    Route::put('church_admin/branches/{branch}', [ChurchAdminBranchController::class, 'update'])->name('church_admin.branches.update');
    Route::delete('church_admin/branches/{branch}', [ChurchAdminBranchController::class, 'destroy'])->name('church_admin.branches.destroy');

    // // MEMBERS ROUTES
    Route::get('church_admin/members', [ChurchAdminMemberController::class, 'index'])->name('church_admin.members');
    Route::get('church_admin/members/create', [ChurchAdminMemberController::class, 'create'])->name('church_admin.members.create');
    Route::post('church_admin/members', [ChurchAdminMemberController::class, 'store'])->name('church_admin.member.store');
    Route::get('church_admin/members/{member}', [ChurchAdminMemberController::class, 'show'])->name('church_admin.members.show');
    Route::get('church_admin/members/{member}/edit', [ChurchAdminMemberController::class, 'edit'])->name('church_admin.members.edit');
    Route::put('church_admin/members/{member}', [ChurchAdminMemberController::class, 'update'])->name('church_admin.members.update');
    Route::delete('church_admin/members/{member}', [ChurchAdminMemberController::class, 'destroy'])->name('church_admin.members.destroy');
    Route::post('church_admin/members/assign_role', [ChurchAdminMemberController::class, 'assignRole'])->name('church_admin.members.assign_role'); //church_admin.members.assign_role

    // // SERVICES ROUTES
    Route::get('church_admin/services', [ChurchAdminServiceController::class, 'index'])->name('church_admin.services');
    Route::get('church_admin/services/create', [ChurchAdminServiceController::class, 'create'])->name('church_admin.services.create');
    Route::post('church_admin/church_admin/services', [ChurchAdminServiceController::class, 'store'])->name('church_admin.services.store');
    Route::get('church_admin/services/{service}', [ChurchAdminServiceController::class, 'show'])->name('church_admin.services.show');
    Route::get('church_admin/services/{service}/edit', [ChurchAdminServiceController::class, 'edit'])->name('church_admin.services.edit');
    Route::put('church_admin/services/{service}', [ChurchAdminServiceController::class, 'update'])->name('church_admin.services.update');
    Route::delete('church_admin/services/{service}', [ChurchAdminServiceController::class, 'destroy'])->name('church_admin.services.destroy');

    // // FINANCES ROUTES
    Route::get('church_admin/finances', [ChurchAdminFinanceController::class, 'index'])->name('church_admin.finances');
    Route::get('church_admin/finances/create', [ChurchAdminFinanceController::class, 'create'])->name('church_admin.finances.create');
    Route::post('church_admin/finances', [ChurchAdminFinanceController::class, 'store'])->name('church_admin.finances.store');
    Route::get('church_admin/finances/{finance}/edit', [ChurchAdminFinanceController::class, 'edit'])->name('church_admin.finances.edit');
    Route::get('church_admin/finances/{finance}', [ChurchAdminFinanceController::class, 'show'])->name('church_admin.finances.show');
    Route::put('church_admin/finances/{finance}', [ChurchAdminFinanceController::class, 'update'])->name('church_admin.finances.update');
    Route::delete('church_admin/finances/{finance}', [ChurchAdminFinanceController::class, 'destroy'])->name('church_admin.finances.destroy');

    // // MESSAGES ROUTES
    // Route::get('messages', [MessageController::class, 'index'])->name('messages');
    // Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    // Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    // Route::get('messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    // Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    // Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    // Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // // SERVICE CATEGORIES ROUTES
    Route::get('church_admin/service_categories', [ChurchAdminServiceCategoryController::class, 'index'])->name('church_admin.service_categories');
    Route::get('church_admin/service_categories/create', [ChurchAdminServiceCategoryController::class, 'create'])->name('church_admin.service_categories.create');
    Route::post('church_admin/service_categories', [ChurchAdminServiceCategoryController::class, 'store'])->name('church_admin.service_categories.store');
    Route::get('church_admin/service_categories/{service_category}/edit', [ChurchAdminServiceCategoryController::class, 'edit'])->name('church_admin.service_categories.edit');
    Route::get('church_admin/service_categories/{service_category}', [ChurchAdminServiceCategoryController::class, 'show'])->name('church_admin.service_categories.show');
    Route::put('church_admin/service_categories/{service_category}', [ChurchAdminServiceCategoryController::class, 'update'])->name('church_admin.service_categories.update');
    Route::delete('church_admin/service_categories/{service_category}', [ChurchAdminServiceCategoryController::class, 'destroy'])->name('church_admin.service_categories.destroy');

});