@extends('service_categories.app')

@section('content')
    <div class="container">
        <h2>Edit Service Category</h2>
        <form action="{{ route('church_admin.service_categories.update', $serviceCategory->id) }}" method="POST">
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
                    <option value="inactive" {{ $serviceCategory->status == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 row">
                    <div class="col-md-2">
                        <label for="branch_id" class="form-label">Branch</label>
                    </div>
                    <div class="col-md-10">
                        <select name="branch_id" class="form-select chosen" required>
                            <option value="">Select Branch</option>
                            @isset(Auth::user()->church->first()->name)
                                @foreach (Auth::user()->church->first()->branches as $branch)
                                    <option {{$branch->id == $serviceCategory->branch->id ? 'selected' : '' }} value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="modal-body   mb-3  col-md-3">
                    <label for="church_id" class="form-label">Church: <span class="text-primary">
                            @isset(Auth::user()->church->first()->name)
                                {{ Auth::user()->church->first()->name }}
                            @endisset
                        </span> </label>
                    <input type="number" name="church_id"
                        value="@isset(Auth::user()->church->first()->name){{ Auth::user()->church->first()->id }}@endisset"
                        class="form-control" readonly hidden>
                </div>
                <div class="modal-body mb-3 col-md-3">
                    <label for="user_id" class="form-label">Admin: {{ Auth::user()->name }}
                        <span class="text-primary italic">(You!)</span></label>
                    <input type="number" name="user_id" value="{{ Auth::user()->id }}" class="form-control" hidden
                        readonly>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('church_admin.service_categories') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update Category</button>
            </div>
        </form>
    </div>
@endsection
