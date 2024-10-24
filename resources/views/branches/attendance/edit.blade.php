@extends('branches.attendance.service')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">EDIT ATTENDANCE REPORT</h1>

    <form action="{{ route('report.update', ['branch'=>$branch_id,'report'=>$report->id]) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT') <!-- Use PUT method for update -->

        <h1 class="text-success"><strong>ATTENDANCE</strong></h1>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="service_date" class="form-label text-dark">Date:</label>
                <input type="date" name="service_date" class="form-control" value="{{ $report->service_date }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="service_name" class="form-label text-dark">Service Name:</label>
                <input type="text" name="service_name" class="form-control" value="{{ $report->service_name }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="total_attendance" class="form-label text-dark">Total Attendance:</label>
                <input type="number" name="total_attendance" class="form-control" value="{{ $report->total_attendance }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="message" class="form-label text-dark">Message:</label>
                <input type="text" name="message" class="form-control" value="{{ $report->message }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="minister" class="form-label text-dark">Minister:</label>
                <input type="text" name="minister" class="form-control" value="{{ $report->minister }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="male" class="form-label text-dark">Male:</label>
                <input type="number" name="male" class="form-control" value="{{ $report->male }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="female" class="form-label text-dark">Female:</label>
                <input type="number" name="female" class="form-control" value="{{ $report->female }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="children" class="form-label text-dark">Children:</label>
                <input type="number" name="children" class="form-control" value="{{ $report->children }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="baptism_water" class="form-label text-dark">Baptisms by water:</label>
                <input type="number" name="baptism_water" class="form-control" value="{{ $report->baptism_water }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="baptism_spirit" class="form-label text-dark">Baptisms by spirit:</label>
                <input type="number" name="baptism_spirit" class="form-control" value="{{ $report->baptism_spirit }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="new_births" class="form-label text-dark">New Births:</label>
                <input type="number" name="new_births" class="form-control" value="{{ $report->new_births }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_timers" class="form-label text-dark">Number of Guests:</label>
                <input type="number" name="first_timers" class="form-control" value="{{ $report->first_timers }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="cars" class="form-label text-dark">Number of cars:</label>
                <input type="number" name="cars" class="form-control" value="{{ $report->cars }}" required>
            </div>
        </div>

        <hr><br>
        <h1 class="text-success"><strong>FINANCES</strong></h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="worship_offering" class="form-label text-dark">Worship Offering:</label>
                <input type="number" name="worship_offering" class="form-control" value="{{ $report->worship_offering }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="tithe_offering" class="form-label text-dark">Tithe Offering:</label>
                <input type="number" name="tithe_offering" class="form-control" value="{{ $report->tithe_offering }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="thanksgiving_offering" class="form-label text-dark">Thanksgiving Offering:</label>
                <input type="number" name="thanksgiving_offering" class="form-control" value="{{ $report->thanksgiving_offering }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="project_offering" class="form-label text-dark">Project Offering:</label>
                <input type="number" name="project_offering" class="form-control" value="{{ $report->project_offering }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="special_offering" class="form-label text-dark">Special Offering:</label>
                <input type="number" name="special_offering" class="form-control" value="{{ $report->special_offering }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="firstfruits_offering" class="form-label text-dark">Firstfruits Offering:</label>
                <input type="number" name="firstfruits_offering" class="form-control" value="{{ $report->firstfruits_offering }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="children_offering" class="form-label text-dark">Children Offering:</label>
                <input type="number" name="children_offering" class="form-control" value="{{ $report->children_offering }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="Cds_dvd_tapes" class="form-label text-dark">Cds, Dvd, Tapes:</label>
                <input type="number" name="Cds_dvd_tapes" class="form-control" value="{{ $report->Cds_dvd_tapes }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="books_and_stickers" class="form-label text-dark">Books or Stickers:</label>
                <input type="number" name="books_and_stickers" class="form-control" value="{{ $report->books_and_stickers }}" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Update Report</button>
            <a href="{{ route('branch.reports', ['branch'=>$branch_id,'report'=>$report->id]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
