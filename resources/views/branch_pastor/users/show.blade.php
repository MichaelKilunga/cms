@extends('users.app')

@section('content')
<div class="container">
    <h2>User Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Name:</strong> {{ $user->name }}</h4>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Roles:</strong></p>
            <ul>
                @foreach ($user->roles as $role)
                    <li>{{ ucfirst($role->name) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('users') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
