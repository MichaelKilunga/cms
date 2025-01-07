@extends('services.app')

@section('content')
<div class="container">
    <h2>Service Report Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Service Name:</strong> {{ $service->name }}</h4>
            <p><strong>Service Category:</strong> {{ $service->service_category->name }}</p>
            <p><strong>Date:</strong> {{ $service->date }}</p>
            <p><strong>Message Preached:</strong> {{ $service->message }}</p>
            <p><strong>Minister:</strong> {{ $service->minister }}</p>
            <p><strong>Attendance:</strong></p>
            <ul>
                <li><strong>Women:</strong> {{ $service->women }}</li>
                <li><strong>Men:</strong> {{ $service->men }}</li>
                <li><strong>Children:</strong> {{ $service->children }}</li>
                <li><strong>Cars:</strong> {{ $service->cars }}</li>
            </ul>
            <p><strong>Baptisms:</strong></p>
            <ul>
                <li><strong>By Water:</strong> {{ $service->baptism_water }}</li>
                <li><strong>By Spirit:</strong> {{ $service->baptism_spirit }}</li>
            </ul>
            <p><strong>New Births:</strong> {{ $service->new_birth }}</p>
            <p><strong>First-Time Attendees:</strong> {{ $service->first_timers }}</p>
            <p><strong>Filed By:</strong> {{ $service->user->name }}</p>
        </div>
    </div>
    <a href="{{ route('services') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
