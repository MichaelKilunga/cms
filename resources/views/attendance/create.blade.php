@extends('service')

@section('content')
    <div class="container mt-0">
        <h1 class="text-center mb-4">CREATE ATTENDANCE REPORT</h1>

        <form action="{{ route('attendance.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h1 class="text-success" ><strong>ATTENDANCE</strong></h1>
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
                        required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="message" class="form-label text-dark">Message:</label>
                    <input type="text" name="message" class="form-control" placeholder="Message preached..." required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="minister" class="form-label text-dark">Minister:</label>
                    <input type="number" name="minister" class="form-control" placeholder="Minister..."
                        required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="male" class="form-label text-dark">Male:</label>
                    <input type="number" name="male" class="form-control" placeholder="Number of males" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="female" class="form-label text-dark">Female:</label>
                    <input type="number" name="female" class="form-control" placeholder="Number of females" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="children" class="form-label text-dark">Children:</label>
                    <input type="number" name="children" class="form-control" placeholder="Number of children" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="baptism_water" class="form-label text-dark">Baptisms by water:</label>
                    <input type="number" name="baptisms" class="form-control" placeholder="Number of baptisms by water" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="baptism_spirit" class="form-label text-dark">Baptisms by spirit:</label>
                    <input type="number" name="baptism_spirit" class="form-control" placeholder="Number of baptism by spirit" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="births" class="form-label text-dark">New Births:</label>
                    <input type="number" name="new_births" class="form-control" placeholder="Number of new births" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="guests" class="form-label text-dark">Number of Guests:</label>
                    <input type="number" name="first_timers" class="form-control" placeholder="Number of guests" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cars" class="form-label text-dark">Number of cars:</label>
                    <input type="number" name="cars" class="form-control" placeholder="Number of cars" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="births" class="form-label text-dark">New Births:</label>
                    <input type="number" name="new_births" class="form-control" placeholder="Number of new births" required>
                </div>
            </div>

            <hr>
            <h1 class="text-success" ><strong>FINANCES</strong></h1>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="guests" class="form-label text-dark">Number of Guests:</label>
                    <input type="number" name="first_timers" class="form-control" placeholder="Number of guests" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cars" class="form-label text-dark">Number of cars:</label>
                    <input type="number" name="cars" class="form-control" placeholder="Number of cars" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="births" class="form-label text-dark">New Births:</label>
                    <input type="number" name="new_births" class="form-control" placeholder="Number of new births" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
