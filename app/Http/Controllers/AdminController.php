<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\AttendanceReport;
use App\Models\User;

class AdminController extends Controller {
    // View branch dashboard with reports

    public function index( Branch $branch ) {
        $user = auth()->user();

        
        $userCount = User::where( 'branch_id', $user->branch_id )->count();
        // dd($user->branch_id);
        // dd($userCount);

        // Get all reports for the branch
        $reports = AttendanceReport::where( 'branch_id', $user->branch_id )->get();
        $branch->branch_id = $user->branch_id;
        // $branch_id = $user->branch_id;
        // dd($branch);
        // // Filter finance reports for head-of-finance role
        // $financeReports = $reports->where( 'type', 'finance' );

        return view( 'branches.dashboard', compact( 'user',  'branch', 'reports', 'userCount' ) );
    }

    // View all users within a branch

    public function viewUsers( Branch $branch ) {
        // Get all users assigned to the branch
        // dd($branch);
        $users = User::where( 'branch_id', $branch->id )->get();

        return view( 'branches.users.index', compact( 'users', 'branch' ) );
    }

    // Create a new user for a branch

    public function createUser( Request $request, Branch $branch ) {
        // Validate the incoming request data
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ] );

        // Create the new user and associate with the branch
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt( $request->password ),
            'branch_id' => $branch->id, // Assign the user to the branch
        ] );

        // Assign the selected roles to the user
        $user->syncRoles( $request->roles );

        return redirect()->route( 'branches.users.index', $branch->id )
        ->with( 'alert_success', 'User created successfully.' );
    }

    // Edit a branch user

    public function editUser( Request $request, Branch $branch, User $user ) {
        // Validate the incoming request data
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'roles' => 'required|array',
        ] );

        // Update user details
        $user->update( [
            'name' => $request->name,
            'email' => $request->email,
        ] );

        // Update roles for the user
        $user->syncRoles( $request->roles );

        return redirect()->route( 'branches.users.index', $branch->id )
        ->with( 'alert_success', 'User updated successfully.' );
    }

    // Delete a branch user

    public function deleteUser( Branch $branch, User $user ) {
        // Delete the user
        $user->delete();

        return redirect()->route( 'branches.users.index', $branch->id )
        ->with( 'alert_success', 'User deleted successfully.' );
    }

    // View all reports for a branch

    public function viewReports( Branch $branch ) {
        // Get all reports for the branch
        $reports = AttendanceReport::where( 'branch_id', $branch->id )->get();

        return view( 'branches.attendance.index', compact( 'reports', 'branch' ) );
    }

    
    public function showReport(  $branch, $id ) {
        // dd($id);
        $report = AttendanceReport::findOrFail( $id );
        // dd($report);
        $branch_id = $branch;
        return view( 'branches.attendance.show', compact( 'report','branch_id' ) );
    }

    // Create a new report for a branch

    public function createReportView(Branch $branch){
        // dd($branch);
        return view('branches.attendance.create', compact('branch'));
    }
    public function createReport( Request $request, Branch $branch ) {
        // Validate the request
        $request->validate( [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
        ] );

        // Create the report
        AttendanceReport::create( [
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'branch_id' => $branch->id,
        ] );

        return redirect()->route( 'branch.reports', $branch->id )
        ->with( 'alert_success', 'Report created successfully.' );
    }

    // Edit a report for a branch
    
    public function reportEditView( $branch , $report) {
        $id= $report;
        $data = AttendanceReport::findOrFail( $id );
        $report = $data;
        $branch_id = $branch;
        // dd($report);
        // dd($branch_id);

        return view( 'branches.attendance.edit', compact( 'report', 'branch_id' ) );
    }

    public function editReport( Request $request, Branch $branch, AttendanceReport $report ) {
        // Validate the request
        $request->validate( [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
        ] );

        // Update the report
        $report->update( [
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
        ] );

        return redirect()->route( 'branches.reports.index', $branch->id )
        ->with( 'alert_success', 'Report updated successfully.' );
    }

    // Delete a report for a branch

    public function deleteReport( Branch $branch, AttendanceReport $report ) {
        // Delete the report
        $report->delete();

        return redirect()->route( 'branches.reports.index', $branch->id )
        ->with( 'alert_success', 'Report deleted successfully.' );
    }
}
