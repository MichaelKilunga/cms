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
// church admin
use App\Http\Controllers\church_admin\ChurchAdminController;
use App\Http\Controllers\church_admin\ChurchAdminBranchController;
use App\Http\Controllers\church_admin\ChurchAdminMemberController;
use App\Http\Controllers\church_admin\ChurchAdminServiceController;
use App\Http\Controllers\church_admin\ChurchAdminFinanceController;
use App\Http\Controllers\church_admin\ChurchAdminRolePermissionController;
use App\Http\Controllers\church_admin\ChurchAdminServiceCategoryController;
// branch admin
use App\Http\Controllers\branch_admin\BranchAdminController;
use App\Http\Controllers\branch_admin\BranchAdminBranchController;
use App\Http\Controllers\branch_admin\BranchAdminMemberController;
use App\Http\Controllers\branch_admin\BranchAdminServiceController;
use App\Http\Controllers\branch_admin\BranchAdminFinanceController;
use App\Http\Controllers\branch_admin\BranchAdminRolePermissionController;
use App\Http\Controllers\branch_admin\BranchAdminServiceCategoryController;
// branch pastor
use App\Http\Controllers\branch_pastor\BranchPastorController;
use App\Http\Controllers\branch_pastor\BranchPastorBranchController;
use App\Http\Controllers\branch_pastor\BranchPastorMemberController;
use App\Http\Controllers\branch_pastor\BranchPastorServiceController;
use App\Http\Controllers\branch_pastor\BranchPastorFinanceController;
use App\Http\Controllers\branch_pastor\BranchPastorReportController;
use App\Http\Controllers\branch_pastor\BranchPastorRolePermissionController;
use App\Http\Controllers\branch_pastor\BranchPastorServiceCategoryController;


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


Route::middleware(['auth', 'can:manage branch'])->group(function () {
    // // MEMBERS ROUTES
    Route::get('branch_admin/members', [BranchAdminMemberController::class, 'index'])->name('branch_admin.members');
    Route::get('branch_admin/members/create', [BranchAdminMemberController::class, 'create'])->name('branch_admin.members.create');
    Route::post('branch_admin/members', [BranchAdminMemberController::class, 'store'])->name('branch_admin.member.store');
    Route::get('branch_admin/members/{member}', [BranchAdminMemberController::class, 'show'])->name('branch_admin.members.show');
    Route::get('branch_admin/members/{member}/edit', [BranchAdminMemberController::class, 'edit'])->name('branch_admin.members.edit');
    Route::put('branch_admin/members/{member}', [BranchAdminMemberController::class, 'update'])->name('branch_admin.members.update');
    Route::delete('branch_admin/members/{member}', [BranchAdminMemberController::class, 'destroy'])->name('branch_admin.members.destroy');
    Route::post('branch_admin/members/assign_role', [BranchAdminMemberController::class, 'assignRole'])->name('branch_admin.members.assign_role'); //branch_admin.members.assign_role

    // // SERVICES ROUTES
    Route::get('branch_admin/services', [BranchAdminServiceController::class, 'index'])->name('branch_admin.services');
    Route::get('branch_admin/services/create', [BranchAdminServiceController::class, 'create'])->name('branch_admin.services.create');
    Route::post('branch_admin/branch_admin/services', [BranchAdminServiceController::class, 'store'])->name('branch_admin.services.store');
    Route::get('branch_admin/services/{service}', [BranchAdminServiceController::class, 'show'])->name('branch_admin.services.show');
    Route::get('branch_admin/services/{service}/edit', [BranchAdminServiceController::class, 'edit'])->name('branch_admin.services.edit');
    Route::put('branch_admin/services/{service}', [BranchAdminServiceController::class, 'update'])->name('branch_admin.services.update');
    Route::delete('branch_admin/services/{service}', [BranchAdminServiceController::class, 'destroy'])->name('branch_admin.services.destroy');

    // // FINANCES ROUTES
    Route::get('branch_admin/finances', [BranchAdminFinanceController::class, 'index'])->name('branch_admin.finances');
    Route::get('branch_admin/finances/create', [BranchAdminFinanceController::class, 'create'])->name('branch_admin.finances.create');
    Route::post('branch_admin/finances', [BranchAdminFinanceController::class, 'store'])->name('branch_admin.finances.store');
    Route::get('branch_admin/finances/{finance}/edit', [BranchAdminFinanceController::class, 'edit'])->name('branch_admin.finances.edit');
    Route::get('branch_admin/finances/{finance}', [BranchAdminFinanceController::class, 'show'])->name('branch_admin.finances.show');
    Route::put('branch_admin/finances/{finance}', [BranchAdminFinanceController::class, 'update'])->name('branch_admin.finances.update');
    Route::delete('branch_admin/finances/{finance}', [BranchAdminFinanceController::class, 'destroy'])->name('branch_admin.finances.destroy');

    // // MESSAGES ROUTES
    // Route::get('messages', [MessageController::class, 'index'])->name('messages');
    // Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    // Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    // Route::get('messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    // Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    // Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    // Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::middleware(['auth', 'can:pastor branch'])->group(function () {
    // // MEMBERS ROUTES
    Route::get('branch_pastor/members', [BranchPastorMemberController::class, 'index'])->name('branch_pastor.members');
    Route::get('branch_pastor/members/create', [BranchPastorMemberController::class, 'create'])->name('branch_pastor.members.create');
    Route::post('branch_pastor/members', [BranchPastorMemberController::class, 'store'])->name('branch_pastor.member.store');
    Route::get('branch_pastor/members/{member}', [BranchPastorMemberController::class, 'show'])->name('branch_pastor.members.show');
    Route::get('branch_pastor/members/{member}/edit', [BranchPastorMemberController::class, 'edit'])->name('branch_pastor.members.edit');
    Route::put('branch_pastor/members/{member}', [BranchPastorMemberController::class, 'update'])->name('branch_pastor.members.update');
    Route::delete('branch_pastor/members/{member}', [BranchPastorMemberController::class, 'destroy'])->name('branch_pastor.members.destroy');
    Route::post('branch_pastor/members/assign_role', [BranchPastorMemberController::class, 'assignRole'])->name('branch_pastor.members.assign_role'); //branch_pastor.members.assign_role

    // // SERVICES ROUTES
    Route::get('branch_pastor/services', [BranchPastorServiceController::class, 'index'])->name('branch_pastor.services');
    Route::get('branch_pastor/services/create', [BranchPastorServiceController::class, 'create'])->name('branch_pastor.services.create');
    Route::post('branch_pastor/branch_pastor/services', [BranchPastorServiceController::class, 'store'])->name('branch_pastor.services.store');
    Route::get('branch_pastor/services/{service}', [BranchPastorServiceController::class, 'show'])->name('branch_pastor.services.show');
    Route::get('branch_pastor/services/{service}/edit', [BranchPastorServiceController::class, 'edit'])->name('branch_pastor.services.edit');
    Route::put('branch_pastor/services/{service}', [BranchPastorServiceController::class, 'update'])->name('branch_pastor.services.update');
    Route::delete('branch_pastor/services/{service}', [BranchPastorServiceController::class, 'destroy'])->name('branch_pastor.services.destroy');

    Route::get('branch_pastor/services/approve/{id}', [BranchPastorServiceController::class, 'approveServiceReport'])->name('branch_pastor.services.approve');

    // // FINANCES ROUTES
    Route::get('branch_pastor/finances', [BranchPastorFinanceController::class, 'index'])->name('branch_pastor.finances');
    Route::get('branch_pastor/finances/create', [BranchPastorFinanceController::class, 'create'])->name('branch_pastor.finances.create');
    Route::post('branch_pastor/finances', [BranchPastorFinanceController::class, 'store'])->name('branch_pastor.finances.store');
    Route::get('branch_pastor/finances/{finance}/edit', [BranchPastorFinanceController::class, 'edit'])->name('branch_pastor.finances.edit');
    Route::get('branch_pastor/finances/{finance}', [BranchPastorFinanceController::class, 'show'])->name('branch_pastor.finances.show');
    Route::put('branch_pastor/finances/{finance}', [BranchPastorFinanceController::class, 'update'])->name('branch_pastor.finances.update');
    Route::delete('branch_pastor/finances/{finance}', [BranchPastorFinanceController::class, 'destroy'])->name('branch_pastor.finances.destroy');

    Route::get('branch_pastor/finances/approve/{id}', [BranchPastorFinanceController::class, 'approveFinanceReport'])->name('branch_pastor.finances.approve');

    // // MESSAGES ROUTES
    // Route::get('messages', [MessageController::class, 'index'])->name('messages');
    // Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    // Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    // Route::get('messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    // Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    // Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    // Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // // REPORTS ROUTES
    Route::get('branch_pastor/reports', [BranchPastorReportController::class, 'index'])->name('branch_pastor.reports');
    Route::get('branch_pastor/reports/filter', [BranchPastorReportController::class, 'filter'])->name('branch_pastor.reports.filter');

    Route::get('branch_pastor/reports/create', [BranchPastorReportController::class, 'create'])->name('branch_pastor.reports.create');
    Route::get('branch_pastor/reports/{report}/edit', [BranchPastorReportController::class, 'edit'])->name('branch_pastor.reports.edit');
    Route::get('branch_pastor/reports/{report}', [BranchPastorReportController::class, 'show'])->name('branch_pastor.reports.show');
    Route::put('branch_pastor/reports/{report}', [BranchPastorReportController::class, 'update'])->name('branch_pastor.reports.update');
    Route::delete('branch_pastor/reports/{report}', [BranchPastorReportController::class, 'destroy'])->name('branch_pastor.reports.destroy');
});