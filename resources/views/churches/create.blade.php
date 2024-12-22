@extends('churches.app')

@section('content')
<div class="container">
    <h2>Create Church</h2>
    <form action="{{ route('churches.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Church Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Church Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <div class="mb-3">
            <label for="motto" class="form-label">Church Motto</label>
            <input type="text" name="motto" class="form-control">
        </div>
        <div class="mb-3">
            <label for="administrator_id" class="form-label">Administrator</label>
            <select name="administrator_id" class="form-select" required>
                <option selected disabled value="">Select Administrator</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Church</button>
    </form>
</div>
@endsection
