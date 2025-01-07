@extends('service_categories.app')

@section('content')
<div class="container">
    <h2>Add New Service Category</h2>
    <form action="{{ route('service_categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
        <a href="{{ route('service_categories') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
