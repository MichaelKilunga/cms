@extends('church_admin.branches.app')

@section('content')
<div class="container">
    <span class="h3 mt-4 text-primary">Edit Branch</span>
    <form action="{{ route('church_admin.branches.update', $branch->id) }}" method="POST">
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
        
        <div class="modal-body   mb-3">
            <label for="church_id" class="form-label">Church: <span class="text-primary">
                    @isset(Auth::user()->church->first()->name)
                        {{ Auth::user()->church->first()->name }}
                    @endisset
                </span> </label>
            <input type="number" name="church_id"
                value="@isset(Auth::user()->church->first()->name){{ Auth::user()->church->first()->id }}@endisset"
                class="form-control" readonly hidden>
        </div>
        <a href="{{ route('church_admin.branches') }}" class="btn btn-primary">Back to List</a>
        <button type="submit" class="btn btn-success">Update Branch</button>
    </form>
</div>
@endsection
