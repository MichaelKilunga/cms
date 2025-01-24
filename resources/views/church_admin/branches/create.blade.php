@extends('branches.app')

@section('content')
    <div class="container">
        <h2>Create Branch</h2>
        <form action="{{ route('church_admin.branch.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Branch Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control">
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
            <button type="submit" class="btn btn-primary">Create Branch</button>
        </form>
    </div>
@endsection
