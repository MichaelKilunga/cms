@extends('service_categories.app')

@section('content')
<div class="container">
    <h2>Service Categories</h2>
    <a href="{{ route('service_categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ ucfirst($category->status) }}</td>
                    <td>
                        <a href="{{ route('service_categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('service_categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('service_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
