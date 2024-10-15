<?php

namespace App\Http\Controllers;

use App\Models\AttendanceReport;
use Illuminate\Http\Request;

class AttendanceReportController extends Controller
{
    public function index() {
        $reports = AttendanceReport::all();
        return view('attendance.index', compact('reports'));
    }
    
    public function create() {
        return view('attendance.create');
    }
    
    public function store(Request $request) {
        AttendanceReport::create($request->all());
        return redirect()->route('attendance.index');
    }
    
    public function show($id) {
        $report = AttendanceReport::findOrFail($id);
        return view('attendance.show', compact('report'));
    }
    
    public function edit($id) {
        $report = AttendanceReport::findOrFail($id);
        return view('attendance.edit', compact('report'));
    }
    
    public function update(Request $request, $id) {
        $report = AttendanceReport::findOrFail($id);
        $report->update($request->all());
        return redirect()->route('attendance.index');
    }
    
    public function destroy($id) {
        AttendanceReport::destroy($id);
        return redirect()->route('attendance.index');
    }
    
}
