@extends('services.app')

@section('content')
<div class="container">
    <h2>Service Reports</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add New Service Report</a>
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
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-success btn-sm">show</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
