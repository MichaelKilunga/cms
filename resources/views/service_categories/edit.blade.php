@extends('service_categories.app')

@section('content')
<div class="container">
    <h2>Edit Service Category</h2>
    <form action="{{ route('service_categories.update', $serviceCategory->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $serviceCategory->name }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="active" {{ $serviceCategory->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $serviceCategory->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Category</button>
        <a href="{{ route('service_categories') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
