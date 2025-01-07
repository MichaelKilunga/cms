@extends('messages.app')

@section('content')
<div class="container">
    <h2>Message Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Sender:</strong> {{ $message->sender->name }}</p>
            <p><strong>Receiver:</strong> {{ $message->receiver->name }}</p>
            <p><strong>Type:</strong> {{ ucfirst($message->type) }}</p>
            <p><strong>Body:</strong> {{ $message->body }}</p>
            <p><strong>Church:</strong> {{ $message->church->name }}</p>
            <p><strong>Branch:</strong> {{ $message->branch?->name ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($message->status) }}</p>
            <p><strong>Date:</strong> {{ $message->date }}</p>
        </div>
    </div>
    <a href="{{ route('messages') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
