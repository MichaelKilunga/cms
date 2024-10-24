@extends('admin.app')

@section('content')
<div class="container mx-auto p-6 bg-white border border-gray-200 rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Create New User</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-indigo-200" required>
        </div>

        <div class="mb-4">
            <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
            <div class="form-control">
                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" 
                               name="roles[]" 
                               id="role_{{ $role->id }}" 
                               value="{{ $role->name }}" 
                               class="form-check-input">
                        <label for="role_{{ $role->id }}" class="form-check-label">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 d-flex justify-content-between align-items-center">
            <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <i class="fas fa-save"></i> Create User
            </button>
            <a href="{{ route('users') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>
    </form>
</div>
@endsection
