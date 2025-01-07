@extends('messages.app')

@section('content')
<div class="container">
    <h2>Edit Message</h2>
    <form action="{{ route('messages.update', $message->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="sender_id" class="form-label">Sender</label>
            <select name="sender_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $message->sender_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="receiver_id" class="form-label">Receiver</label>
            <select name="receiver_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $message->receiver_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="in-app" {{ $message->type == 'in-app' ? 'selected' : '' }}>In-App</option>
                <option value="push" {{ $message->type == 'push' ? 'selected' : '' }}>Push Notification</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input type="textarea" value="{{ $message->body}}" class="form-input form-control" name="body" placeholder="message body...">
        </div>

        <div class="mb-3">
            <label for="church_id" class="form-label">Church</label>
            <select name="church_id" class="form-select" required>
                @foreach ($churches as $church)
                    <option value="{{ $church->id }}" {{ $message->church_id == $church->id ? 'selected' : '' }}>
                        {{ $church->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select name="branch_id" class="form-select">
                <option value="" {{ is_null($message->branch_id) ? 'selected' : '' }}>None</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $message->branch_id == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="sent" {{ $message->status == 'sent' ? 'selected' : '' }}>Sent</option>
                <option value="delivered" {{ $message->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Message</button>
    </form>
</div>
@endsection
