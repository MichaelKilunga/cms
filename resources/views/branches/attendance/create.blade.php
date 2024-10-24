@extends('branches.service')

@section('content')
    <div class="container mt-0">
        <h1 class="text-center mb-4">CREATE ATTENDANCE REPORT</h1>

        <form action="{{ route('reports.create', $branch->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h1 class="text-success"><strong>ATTENDANCE</strong></h1>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="service_date" class="form-label text-dark">Date:</label>
                    <input type="date" name="service_date" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="service_name" class="form-label text-dark">Service Name:</label>
                    <input type="text" name="service_name" class="form-control" placeholder="Enter service name"
                        required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_attendance" class="form-label text-dark">Total Attendance:</label>
                    <input type="number" name="total_attendance" class="form-control" placeholder="Enter total attendance"
                        >
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="message" class="form-label text-dark">Message:</label>
                    <input type="text" name="message" class="form-control" placeholder="Message preached..." required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="minister" class="form-label text-dark">Minister:</label>
                    <input type="ttext" name="minister" class="form-control" placeholder="Minister..." required >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="male" class="form-label text-dark">Male:</label>
                    <input type="number" name="male" class="form-control" placeholder="Number of males" >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="female" class="form-label text-dark">Female:</label>
                    <input type="number" name="female" class="form-control" placeholder="Number of females" >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="children" class="form-label text-dark">Children:</label>
                    <input type="number" name="children" class="form-control" placeholder="Number of children" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="baptism_water" class="form-label text-dark">Baptisms by water:</label>
                    <input type="number" name="baptism_water" class="form-control"
                        placeholder="Number of baptisms by water" >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="baptism_spirit" class="form-label text-dark">Baptisms by spirit:</label>
                    <input type="number" name="baptism_spirit" class="form-control"
                        placeholder="Number of baptism by spirit" >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="births" class="form-label text-dark">New Births:</label>
                    <input type="number" name="new_births" class="form-control" placeholder="Number of new births"
                        >
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="guests" class="form-label text-dark">Number of Guests:</label>
                    <input type="number" name="first_timers" class="form-control" placeholder="Number of guests" >
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cars" class="form-label text-dark">Number of cars:</label>
                    <input type="number" name="cars" class="form-control" placeholder="Number of cars" >
                </div>

                {{-- <div class="col-md-4 mb-3">
                    <label for="births" class="form-label text-dark">New Births:</label>
                    <input type="number" name="new_births" class="form-control" placeholder="Number of new births"
                        >
                </div> --}}
            </div>

            <hr><br>
            <h1 class="text-success"><strong>FINANCES</strong></h1>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="worship_offering" class="form-label text-dark">Worship Offering:</label>
                    <input type="number" name="worship_offering" class="form-control" placeholder="Worship offering..."
                        >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cars" class="form-label text-dark">Tithe Offering:</label>
                    <input type="number" name="tithe_offering" class="form-control" placeholder="Tithe offering..."
                        >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="thanksgiving_offering" class="form-label text-dark">Thanksgiving Offering:</label>
                    <input type="number" name="thanksgiving_offering" class="form-control"
                        placeholder="Thanksgiving Offering:" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="project_offering" class="form-label text-dark">Project Offering:</label>
                    <input type="number" name="project_offering" class="form-control" placeholder="Project Offering..."
                        >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="special_offering" class="form-label text-dark">Special Offering:</label>
                    <input type="number" name="special_offering" class="form-control" placeholder="Special Offering..."
                        >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="firstfruits_offering" class="form-label text-dark">Firstfruits Offering:</label>
                    <input type="number" name="firstfruits_offering" class="form-control"
                        placeholder="Firstfruits Offering:" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="children_offering" class="form-label text-dark">Children Offering:</label>
                    <input type="number" name="children_offering" class="form-control"
                        placeholder="Children Offering..." >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="Cds,dvd,tapes" class="form-label text-dark">Cds,dvd,tapes:</label>
                    <input type="number" name="Cds_dvd_tapes" class="form-control" placeholder="Cds,dvd,tapes Sales..."
                        >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="books_and_stickers" class="form-label text-dark">Books or Stickers:</label>
                    <input type="number" name="books_and_stickers" class="form-control"
                        placeholder="Books/stickers Sales..." >
                </div>
            </div>

            <div class="flex justify-between text-center">
                <div class="align-left"></div>
                <div class="align-right">
                    <button type="submit" class="align-right btn btn-primary">Save</button>
                    <a type="" href="{{route('branch.reports', $branch->id)}}" class="align-right btn btn-primary">cancel</a>
                    <a type="" href="#" class="align-right btn btn-primary">reset</a>
                </div>
            </div>
        </form>
    </div>
@endsection
