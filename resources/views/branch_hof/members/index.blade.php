@extends('members.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Members</h2>
            {{-- button to activate assign role modal --}}
            <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#assignRoleModal">Assign Role</button>
            <a href="{{ route('branch_admin.members.create') }}" class="btn btn-primary mb-3">Add New Member</a>
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
                            <a href="{{ route('branch_admin.members.edit', $member->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('branch_admin.members.show', $member->id) }}"
                                class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('branch_admin.members.destroy', $member->id) }}" method="POST"
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

    {{-- MODEL TO ASSIGN NEW ROLE TO MEMBERS --}}
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('branch_admin.members.assign_role') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignRoleModalLabel">Assign Role to Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="member_id" id="member_id">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group  mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control chosen">
                                    <option value="">Select Role</option>
                                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                        @if ($role->name != 'super admin' && $role->name != 'church admin' && $role->name != 'church bishop' && $role->name != 'church hof')
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- user to assign role to --}}
                            <div class="form-group mb-3">
                                <label for="user">User</label>
                                <select name="member_id" id="member" class="form-control chosen">
                                    <option value="">Select User</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Assign Role</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
