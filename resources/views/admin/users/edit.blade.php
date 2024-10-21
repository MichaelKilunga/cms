@extends('admin.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">
                <h2>Edit User: {{ $user->name }}</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control"
                            required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control"
                            required>
                    </div>

                    <!-- Roles Selection -->
                    <div class="form-group mb-3">
                        <label for="roles" class="form-label">Assign Role</label>
                        {{-- <select name="roles[]" id="roles" class="form-control" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select> --}}
                        <div class="form-control">
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" id="role_{{ $role->id }}"
                                        value="{{ $role->name }}" class="form-check-input"
                                        {{ $user->roles->pluck('name')->contains($role->name) ? 'checked' : '' }}>
                                    <label for="role_{{ $role->id }}" class="form-check-label">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i> Update User
                        </button>

                        <a href="{{ route('users') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Back to Users
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
