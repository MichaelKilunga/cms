@extends('roles.app')

@section('content')
<div class="container">
    <h2>Edit Role</h2>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select name="permissions[]" class="form-select" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" 
                        {{ in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
