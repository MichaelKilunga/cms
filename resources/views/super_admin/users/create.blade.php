@extends('roles.app')

@section('content')
<div class="container">
    <h2>Create New Role</h2>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select name="permissions[]" class="form-select" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Role</button>
    </form>
</div>
@endsection
