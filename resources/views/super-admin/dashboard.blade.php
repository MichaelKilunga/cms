@extends('super-admin.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Welcome, Super Admin</h1>

    <!-- Dashboard Overview Section -->
    <div class="row mt-4">
        <!-- Users Count -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $userCount }}</p> <!-- Assume $userCount is passed from controller -->
                </div>
            </div>
        </div>

        <!-- Branches Count -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Branches</h5>
                    <p class="card-text display-4">{{ $branchCount }}</p> <!-- Assume $branchCount is passed -->
                </div>
            </div>
        </div>

        <!-- Reports Count -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Reports</h5>
                    <p class="card-text display-4">{{ $reportCount }}</p> <!-- Assume $reportCount is passed -->
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="{{ route('users') }}" class="btn btn-primary btn-block">Manage Users</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('branches') }}" class="btn btn-success btn-block">Manage Branches</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('service') }}" class="btn btn-info btn-block">View Reports</a>
        </div>
    </div>
</div>
@endsection
