@extends('branches.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Manage Members</h1>
                <a href="{{ route('member.create', ['branch'=>session('branch_id')]) }}" class="btn btn-primary">Add New Member</a>
            </div>
            <div class="card-body  table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Age Group</th>
                            {{-- <th>Occupation</th>
                            <th>Dini/Dhehebu</th>
                            <th>Spiritual Status</th>
                            <th>Description</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->location }}</td>
                                <td>{{ $member->age_group }}</td>
                                {{--<td>{{ $member->Occupation }}</td>
                                <td>{{ $member->dini_dhehebu }}</td>
                                <td>{{ $member->spiritual_status }}</td>
                                <td>{{ $member->description }}</td>--}}
                                {{-- <td>{{ $member->roles->pluck('name')->join(', ') }}</td> --}}
                                <td>
                                    <a href="{{ route('member.edit', ['branch'=>session('branch_id'),'member'=>$member->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('member.show', ['branch'=>session('branch_id'), 'member'=>$member->id]) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('member.destroy', ['branch'=>session('branch_id'), 'member'=>$member->id]) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm   btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this member?');"><i
                                                class="fas fa-trash"></i> Delete</button>
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
