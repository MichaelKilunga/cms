@extends('branches.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Branches</h2>
            <a href="{{ route('church_admin.branches.create') }}" class="btn btn-primary mb-3">Add New Branch</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Church</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->location }}</td>
                        <td>{{ $branch->church->name }}</td>
                        <td>
                            <a href="{{ route('church_admin.branches.edit', $branch->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('church_admin.branches.show', $branch->id) }}"
                                class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('church_admin.branches.destroy', $branch->id) }}" method="POST"
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
