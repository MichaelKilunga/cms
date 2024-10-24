<?php

namespace App\Http\Controllers;

use App\Models\AttendanceReport;
use Illuminate\Http\Request;

class AttendanceReportController extends Controller {
    public function index() {
        $reports = AttendanceReport::all();
        return view( 'super-admin.attendance.index', compact( 'reports' ) );
    }

    public function create() {
        return view( 'attendance.create' );
    }

    public function store( Request $request ) {
        // Validate the input fields
        $validated = $request->validate( [
            'service_date' => 'required|date',
            'service_name' => 'required|string',
            'total_attendance'=>'required|integer',
            'message'=>'required|string',
            'minister'=>'required|string',
            'male'=>'required|integer',
            'children'=>'required|integer',
            'female'=>'required|integer',
            'baptism_water' => 'nullable|integer',
            'baptism_spirit' => 'nullable|integer',
            'new_births' => 'nullable|integer',
            'first_timers' => 'nullable|integer',
            'cars' => 'nullable|integer',
            'worship_offering' => 'nullable|integer',
            'tithe_offering' => 'nullable|integer',
            'thanksgiving_offering' => 'nullable|integer',
            'project_offering' => 'nullable|integer',
            'special_offering' => 'nullable|integer',
            'firstfruits_offering' => 'nullable|integer',
            'children_offering' => 'nullable|integer',
            'Cds_dvd_tapes' => 'nullable|integer',
            'books_and_stickers' => 'nullable|integer',
        ] );

        // Set default values for fields that are nullable but should default to 0
        $data = array_merge( $validated, [
            'baptism_water' => $validated[ 'baptism_water' ] ?? 0,
            'baptism_spirit' => $validated[ 'baptism_spirit' ] ?? 0,
            'new_births' => $validated[ 'new_births' ] ?? 0,
            'first_timers' => $validated[ 'first_timers' ] ?? 0,
            'cars' => $validated[ 'cars' ] ?? 0,
            'worship_offering' => $validated[ 'worship_offering' ] ?? 0,
            'tithe_offering' => $validated[ 'tithe_offering' ] ?? 0,
            'thanksgiving_offering' => $validated[ 'thanksgiving_offering' ] ?? 0,
            'project_offering' => $validated[ 'project_offering' ] ?? 0,
            'special_offering' => $validated[ 'special_offering' ] ?? 0,
            'firstfruits_offering' => $validated[ 'firstfruits_offering' ] ?? 0,
            'children_offering' => $validated[ 'children_offering' ] ?? 0,
            'Cds_dvd_tapes' => $validated[ 'Cds_dvd_tapes' ] ?? 0,
            'books_and_stickers' => $validated[ 'books_and_stickers' ] ?? 0,
        ] );

        try {
            if ( AttendanceReport::create( $data ) ) {
                return redirect()->route( 'service' )->with( 'alert_success', 'Report Added Successfully.' );
            } else {
                return redirect()->route( 'service' )->with( 'alert_failure', 'Report Failed to Add.' );
            }
        } catch ( \Exception $e ) {
            // Capture the exception message and include it in the failure alert
            return redirect()->route( 'service' )->with( 'alert_failure', 'Report Failed to Update. Error: ' . $e->getMessage() );
        }
    }

    public function show( $id ) {
        $report = AttendanceReport::findOrFail( $id );
        return view( 'attendance.show', compact( 'report' ) );
    }

    public function edit( $id ) {
        $report = AttendanceReport::findOrFail( $id );
        return view( 'attendance.edit', compact( 'report' ) );
    }

    public function update( Request $request, $id ) {
        $report = AttendanceReport::findOrFail($id);
        $validated = $request->validate( [
            'service_date' => 'required|date',
            'service_name' => 'required|string',
            'total_attendance' => 'required|integer',
            'male' => 'required|integer',
            'female' => 'required|integer',
            'children' => 'required|integer',
            'baptism_water' => 'required|integer',
            'baptism_spirit' => 'required|integer',
            'new_births' => 'required|integer',
            'first_timers' => 'required|integer',
            'cars' => 'required|integer',
            'worship_offering' => 'required|integer',
            'tithe_offering' => 'required|integer',
            'thanksgiving_offering' => 'required|integer',
            'project_offering' => 'required|integer',
            'special_offering' => 'required|integer',
            'firstfruits_offering' => 'required|integer',
            'children_offering' => 'required|integer',
            'Cds_dvd_tapes' => 'required|integer',
            'books_and_stickers' => 'required|integer',
        ] );
        try {
            if ( $report->update( $validated ) ) {
                return redirect()->route( 'service' )->with( 'alert_success', 'Report updated successfully.' );
            } else {
                return redirect()->route( 'service' )->with( 'alert_failure', 'Report failed to update.' );
            }
        } catch ( \Exception $e ) {
            return redirect()->route( 'service' )->with( 'alert_failure', 'Report failed to update. Error: ' . $e->getMessage() );
        }
    }

    public function destroy( $id ) {
        try {
            if ( AttendanceReport::destroy( $id ) ) {
                return redirect()->route( 'service' )->with( 'alert_success', 'Deleted successfully.' );
            } else {
                return redirect()->route( 'service' )->with( 'alert_failure', 'Report Failed to Delete.' );
            }
        } catch ( \Exception $e ) {
            // Capture the exception message and include it in the failure alert
            return redirect()->route( 'service' )->with( 'alert_failure', 'Report failed to delete. Error: ' . $e->getMessage() );
        }
    }

}
