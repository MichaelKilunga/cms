@extends('service')

@section('content')
<div class="container mt-5 text-dark">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-success text-white">
            <h2>Attendance Report for {{ $report->service_name }} Service</h2>
        </div>

        <div class="card-body">
            <h4 class="text-success"><strong>Service Information</strong></h4>
            <div class="row mb-4">
                <div class="col-md-4">
                    <p><strong>Date:</strong> {{ $report->service_date }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Service Name:</strong> {{ $report->service_name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Minister:</strong> {{ $report->minister }}</p>
                </div>
            </div>

            <h4 class="text-success"><strong>Attendance</strong></h4>
            <div class="row mb-4">
                <div class="col-md-4">
                    <p><strong>Total Attendance:</strong> {{ $report->total_attendance }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Male:</strong> {{ $report->male }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Female:</strong> {{ $report->female }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Children:</strong> {{ $report->children }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Baptism by Water:</strong> {{ $report->baptism_water }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Baptism by Spirit:</strong> {{ $report->baptism_spirit }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>New Births:</strong> {{ $report->new_births }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Guests:</strong> {{ $report->first_timers }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Cars:</strong> {{ $report->cars }}</p>
                </div>
            </div>

            <h4 class="text-success"><strong>Finances</strong></h4>
            <div class="row mb-4">
                <div class="col-md-4">
                    <p><strong>Worship Offering:</strong> {{ $report->worship_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Tithe Offering:</strong> {{ $report->tithe_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Thanksgiving Offering:</strong> {{ $report->thanksgiving_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Project Offering:</strong> {{ $report->project_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Special Offering:</strong> {{ $report->special_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Firstfruits Offering:</strong> {{ $report->firstfruits_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Children Offering:</strong> {{ $report->children_offering }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>CDs, DVDs, Tapes Sales:</strong> {{ $report->Cds_dvd_tapes }} TZS</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Books/Stickers Sales:</strong> {{ $report->books_and_stickers }} TZS</p>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <a href="{{ route('service') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('attendance.edit', $report->id) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-success" onclick="window.print()">Print as PDF</button>
        </div>
    </div>
</div>
@endsection
