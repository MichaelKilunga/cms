@extends('members.app')

@section('content')
<div class="container">
    <h2>Edit Member</h2>
    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $member->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch</label>
            <select name="branch_id" class="form-select" required>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $member->branch_id == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="church_id" class="form-label">Church</label>
            <select name="church_id" class="form-select" required>
                @foreach ($churches as $church)
                    <option value="{{ $church->id }}" {{ $member->church_id == $church->id ? 'selected' : '' }}>
                        {{ $church->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $member->status }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $member->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ $member->date_of_birth }}">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $member->phone_number }}">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-select">
                <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $member->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Member</button>
    </form>
</div>
@endsection
