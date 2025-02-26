@extends('services.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Service Reports</h2>
            <a href="{{ route('branch_admin.services.create') }}" class="btn btn-primary mb-3">Add New Service Report</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Branch</th>
                    <th>Church</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->date }}</td>
                        <td>{{ $service->branch->name }}</td>
                        <td>{{ $service->church->name }}</td>   
                        <td>
                            <a href="{{ route('branch_admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('branch_admin.services.show', $service->id) }}" class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('branch_admin.services.destroy', $service->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
