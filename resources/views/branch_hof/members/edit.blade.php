@extends('members.app')

@section('content')
    <div class="container pb-5">
        <div class="text-center mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Edit Member</h2>
            <a href="{{ route('branch_admin.members') }}" class="btn btn-primary mb-3">Back to List</a>
        </div>
        <form action="{{ route('branch_admin.members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 hidden">
                <label for="user_id" class="form-label">Member Id</label>
                <input type="text" name="user_id" class="form-control" value="{{ $member->user->id }}" required>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Member Name</label>
                <input type="text" name="name" class="form-control" value="{{ $member->user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $member->user->email }}" required>
            </div>
            <div class="mb-3" hidden>
                <label for="branch_id" class="form-label">Branch</label>
                <input type="number" name="branch_id" class="form-control" value="{{ $member->branch_id }}" required
                    readonly>
            </div>
            <div class="mb-3 hidden">
                <label for="church_id" class="form-label">Church</label>
                <input type="number" name="church_id" class="form-control" value="{{ $member->church_id }}" required
                    readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $member->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ $member->date_of_birth }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $member->phone_number }}">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            {{-- modify roleuae checkboxes --}}
            <div class="mb-3">
                <label for="roles" class="form-label">Roles</label>
                <div class="row">
                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                    @if ($role->name != 'super admin')
                        <div class="col-md-3">
                            <div class="form-check# form-switch# row# d-flex justify-content-start">
                                <div class="col-md-2#"> <input class="form-check form-switch rounded" type="checkbox" name="roles[]"
                                    value="{{ $role->name }}"
                                    {{ $member->user->hasRole($role->name) ? 'checked' : '' }}>
                                </div>
                                <div class="col-md-10#"> <label class="form-check form-switch"
                                    for="flexSwitchCheckDefault">{{ $role->name }}</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update Member</button>
        </form>
    </div>
@endsection
