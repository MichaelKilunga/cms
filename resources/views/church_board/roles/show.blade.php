@extends('roles.app')

@section('content')
<div class="container">
    <h2>Role Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Name:</strong> {{ ucfirst($role->name) }}</h4>
            <p><strong>Permissions:</strong></p>
            <ul>
                @foreach ($role->permissions as $permission)
                    <li>{{ ucfirst($permission->name) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('roles') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
