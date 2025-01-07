@extends('branches.app')

@section('content')
<div class="container">
    <h2>Edit Branch</h2>
    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Branch Name</label>
            <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $branch->location }}">
        </div>
        <div class="mb-3">
            <label for="church_id" class="form-label">Church</label>
            <select name="church_id" class="form-select" required>
                <option selected disabled value="">Select Church</option>
                @foreach ($churches as $church)
                    <option value="{{ $church->id }}" {{ $branch->church_id == $church->id ? 'selected' : '' }}>
                        {{ $church->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Branch</button>
    </form>
</div>
@endsection
