@extends('members.app')

@section('content')
    <div class="container">
        <h2>Add Member</h2>
        <form action="{{ route('members.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" class="form-select" required>
                    <option selected disabled value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="branch_id" class="form-label">Branch</label>
                <select name="branch_id" class="form-select" required>
                    <option selected disabled value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="church_id" class="form-label">Church</label>
                <select name="church_id" class="form-select" required>
                    <option selected disabled value="">Select Church</option>
                    @foreach ($churches as $church)
                        <option value="{{ $church->id }}">{{ $church->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3"> <label for="date_of_birth" class="form-label">Date of Birth</label> <input type="date"
                    name="date_of_birth" class="form-control"> </div>
            <div class="mb-3"> <label for="phone_number" class="form-label">Phone Number</label> <input type="text"
                    name="phone_number" class="form-control"> </div>
            <div class="mb-3"> <label for="gender" class="form-label">Gender</label> <select name="gender"
                    class="form-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select> </div> <button type="submit" class="btn btn-primary">Add Member</button>
        </form>

    </div>
@endsection
