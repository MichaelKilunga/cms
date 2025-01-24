@extends('members.app')

@section('content')
<div class="container">
    <h2>Member Details</h2>
    <div class="card">
        <div class="card-body">
            <h4><strong>Name:</strong> {{ $member->user->name }}</h4>
            <p><strong>Email:</strong> {{ $member->user->email }}</p>
            <p><strong>Phone Number:</strong> {{ $member->phone_number }}</p>
            <p><strong>Date of Birth:</strong> {{ $member->date_of_birth }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($member->gender) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($member->status) }}</p>
            <p><strong>Description:</strong> {{ $member->description }}</p>
            <p><strong>Branch:</strong> {{ $member->branch->name }}</p>
            <p><strong>Church:</strong> {{ $member->church->name }}</p>
            {{-- Tell all Roles of this member --}}
            <p><strong>Roles:</strong>
                @foreach ($member->user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                @endforeach
            </p>
        </div>
    </div>
    <a href="{{ route('church_admin.members') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
