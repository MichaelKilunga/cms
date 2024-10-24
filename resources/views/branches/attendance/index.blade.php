@extends('branches.attendance.service')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="align-left">ALL SESRVICES REPORT</h2>
                <a class="btn btn-primary mb-1 align-right" href="{{ route('reports.create', $branch->id) }}"><i class="fas fa-plus"></i> New Report</a>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Service Name</th>
                            <th>Total Attendance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report['service_date'] }}</td>
                                <td>{{ $report['service_name'] }}</td>
                                <td>{{ $report['total_attendance'] }}</td>
                                <td class="flex justify-between">
                                    <a href="{{ route('reports.show', ['branch'=>$branch->id,'id'=>$report['id']]) }}" class="btn btn-sm  btn-success"><i class="fas fa-eye"></i> View</a>
                                    <a href="{{ route('edit.reports', ['branch'=>$branch->id,'report'=>$report['id']]) }}" class="btn btn-sm  btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('attendance.destroy', ['id'=>$branch->id,'report'=>$report['id']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm   btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this report?');"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


{{-- container align-left flex justify-between --}}