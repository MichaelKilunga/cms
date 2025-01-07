@extends('messages.app')

@section('content')
<div class="container">
    <h2>Messages</h2>
    <a href="{{ route('messages.create') }}" class="btn btn-primary mb-3">Create New Message</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Type</th>
                <th>Body</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->sender->name }}</td>
                    <td>{{ $message->receiver->name }}</td>
                    <td>{{ ucfirst($message->type) }}</td>
                    <td>{{ ucfirst($message->body) }}</td>
                    <td>{{ $message->date }}</td>
                    <td>{{ ucfirst($message->status) }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
