@extends('churches.app')

@section('content')
<div class="container">
    <h2>Church Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Name:</strong> {{ $church->name }}</h4>
            <p><strong>Motto:</strong> {{ $church->moto }}</p>
            <p><strong>Administrator:</strong> {{ $church->administrator->name }}</p>
            <p><strong>Logo:</strong></p>
            <img src="{{ asset('storage/' . $church->logo) }}" alt="Church Logo" class="img-thumbnail" style="max-width: 200px;">
        </div>
    </div>
    <a href="{{ route('churches') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
