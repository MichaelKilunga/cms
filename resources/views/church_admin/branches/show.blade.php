@extends('branches.app')

@section('content')
<div class="container">
    <h2>Branch Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Name:</strong> {{ $branch->name }}</h4>
            <p><strong>Location:</strong> {{ $branch->location }}</p>
            <p><strong>Church:</strong> {{ $branch->church->name }}</p>
        </div>
    </div>
    <a href="{{ route('church_admin.branches') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
