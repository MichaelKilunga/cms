@extends('service')

@section('content')
<div class="container align-left flex justify-between">
        <h1 class="align-left">ALL SESRVICES REPORT</h1>
        <a class="btn btn-light mb-1 align-right" href="{{ route('attendance.create') }}">Add New</a>
    </div>
    <hr>
    <div class="container text-light">
        <table class="table text-light">
            <thead>
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
                        <a class="btn btn-success" href="{{ route('attendance.show', $report['id']) }}">View</a>
                        <a class="btn btn-light" href="{{ route('attendance.edit', $report['id']) }}">Edit</a>
                        <form action="{{ route('attendance.destroy', $report['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
