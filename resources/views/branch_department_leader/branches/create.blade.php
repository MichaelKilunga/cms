@extends('branches.app')

@section('content')
<div class="container">
    <h2>Create Branch</h2>
    <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Branch Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control">
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
        <button type="submit" class="btn btn-primary">Create Branch</button>
    </form>
</div>
@endsection
