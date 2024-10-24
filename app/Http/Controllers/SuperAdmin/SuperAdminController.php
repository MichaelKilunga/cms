<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Models\AttendanceReport;

class SuperAdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $branchCount = Branch::count();
        $reportCount = AttendanceReport::count();

        return view('super-admin.dashboard', compact('userCount', 'branchCount', 'reportCount'));
    }
}
