@extends('churches.app')

@section('content')
<div class="container">
    <h2>Edit Church</h2>
    <form action="{{ route('churches.update', $church->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Church Name</label>
            <input type="text" name="name" class="form-control" value="{{ $church->name }}" required>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Church Logo</label>
            <input type="file" name="logo" class="form-control">
            @if ($church->logo)
                <img src="{{ asset('storage/' . $church->logo) }}" alt="Logo" width="100" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label for="motto" class="form-label">Church Motto</label>
            <input type="text" name="motto" class="form-control" value="{{ $church->motto }}">
        </div>
        <div class="mb-3">
            <label for="administrator_id" class="form-label">Administrator</label>
            <select name="administrator_id" class="form-select" required>
                <option selected disabled value="">Select Administrator</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $church->administrator_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Church</button>
    </form>
</div>
@endsection
