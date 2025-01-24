@extends('members.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Members</h2>
            <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Add New Member</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Church</th>
                    <th>Status</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->user->name }}</td>
                        <td>{{ $member->branch->name }}</td>
                        <td>{{ $member->church->name }}</td>
                        <td>{{ $member->status }}</td>
                        <td>{{ $member->phone_number }}</td>
                        <td>
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST"
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
