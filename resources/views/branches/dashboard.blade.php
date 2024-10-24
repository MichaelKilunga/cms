@extends('branches.app')

@section('content')
<div class="container mt-0">
    <h1 class="text-center">{{ $branch->name }} Dashboard</h1>

    <div class="alert alert-info text-center">Welcome, {{ $user->name }} ({{ $user->getRoleNames()->first() }})</div>

    <!-- Dashboard Overview Section -->
    <div class="row mt-4">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $userCount }}</p> <!-- Assuming $branch has users relationship -->
                </div>
            </div>
        </div>

        <!-- Attendance Reports -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Attendance Reports</h5>
                    <p class="card-text display-4">{{ $reports->count() }}</p> <!-- Total attendance reports -->
                </div>
            </div>
        </div>

        <!-- Financial Reports -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Financial Reports</h5>
                    <p class="card-text display-4">{{ $reports->count() }}</p> <!-- Total financial reports -->
                </div>
            </div>
        </div>
    </div>

    <!-- Role-Specific Panels -->
    @if($user->hasRole('admin'))
        <div class="card mb-4">
            <div class="card-header">Admin Panel</div>
            <div class="card-body">
                <a href="{{ route('branch.users', $branch->branch_id) }}" class="btn btn-primary btn-block">Manage Users</a>
                <a href="{{ route('branch.edit', $branch->branch_id) }}" class="btn btn-secondary btn-block">Edit Branch Information</a>
            </div>
        </div>
    @endif

    @if($user->hasRole('pastor'))
        <div class="card mb-4">
            <div class="card-header">Pastor Panel</div>
            <div class="card-body">
                <h4>Branch Attendance Reports</h4>
                @if($reports->isNotEmpty())
                    <ul class="list-group">
                        @foreach($reports as $report)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('reports.show', $report->id) }}">{{ $report->title }}</a>
                                <span class="text-muted">{{ $report->created_at->format('M d, Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No attendance reports available.</p>
                @endif
            </div>
        </div>
    @endif

    @if($user->hasRole('hof'))
        <div class="card mb-4">
            <div class="card-header">Finance Panel</div>
            <div class="card-body">
                <h4>Financial Reports</h4>
                @if($financeReports->isNotEmpty())
                    <ul class="list-group">
                        @foreach($financeReports as $report)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('reports.show', $report->id) }}">{{ $report->title }}</a>
                                <span class="text-muted">{{ $report->created_at->format('M d, Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No financial reports available.</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
