@extends('messages.app')

@section('content')
<div class="container">
    <h2>Create Message</h2>
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="sender_id" class="form-label">Sender</label>
            <select name="sender_id" class="form-select" required>
                <option value="" disabled selected>Select Sender</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="receiver_id" class="form-label">Receiver</label>
            <select name="receiver_id" class="form-select" required>
                <option value="" disabled selected>Select Receiver</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="in-app">In-App</option>
                <option value="push">Push Notification</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input type="textarea" class="form-input form-control" name="body" placeholder="message body...">
        </div>

        <div class="mb-3">
            <label for="church_id" class="form-label">Church</label>
            <select name="church_id" class="form-select" required>
                <option value="" disabled selected>Select Church</option>
                @foreach ($churches as $church)
                    <option value="{{ $church->id }}">{{ $church->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select name="branch_id" class="form-select">
                <option value="" selected>None</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="sent">Sent</option>
                <option value="delivered">Delivered</option>
                <option value="read">Read</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
@endsection
