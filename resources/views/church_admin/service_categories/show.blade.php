@extends('service_categories.app')

@section('content')
<div class="container">
    <h2>Service Category Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $serviceCategory->name }}</p>
            <p><strong>Status:</strong> {{ ucfirst($serviceCategory->status) }}</p>
            <p><strong>Description:</strong> {{ $serviceCategory->description }}</p>
            <p><strong>Branch:</strong> {{ $serviceCategory->branch->name }}</p>
            <p><strong>Church:</strong> {{ $serviceCategory->church->name }}</p>
            <p><strong>Admin:</strong> {{ $serviceCategory->user->name }}</p>
        </div>
    </div>
    <a href="{{ route('church_admin.service_categories') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
