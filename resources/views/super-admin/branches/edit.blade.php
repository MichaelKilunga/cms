@extends('branches.app')

@section('content')
<div class="container">
    <h1>Edit Branch: {{ $branch->name }}</h1>

    <form action="{{ route('branches.update', $branch) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Branch Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $branch->name }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" value="{{ $branch->location }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
