@extends('branches.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Member Details</h1>
                <a href="{{ route('member.index', ['branch'=>session('branch_id'), 'member'=>$member->id]) }}" class="btn btn-secondary">Back to Members List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                        <h4>Name</h4>
                        <p>{{ $member->name }}</p>
                    </div>
                    
                    <!-- Phone -->
                    <div class="col-md-6">
                        <h4>Phone</h4>
                        <p>{{ $member->phone }}</p>
                    </div>
                    
                    <!-- Location -->
                    <div class="col-md-6">
                        <h4>Location</h4>
                        <p>{{ $member->location }}</p>
                    </div>

                    <!-- Occupation -->
                    <div class="col-md-6">
                        <h4>Occupation</h4>
                        <p>{{ $member->occupation }}</p>
                    </div>

                    <!-- Religious Affiliation -->
                    <div class="col-md-6">
                        <h4>Religion/Denomination</h4>
                        <p>{{ $member->dini_dhehebu }}</p>
                    </div>

                    <!-- Spiritual Status -->
                    <div class="col-md-6">
                        <h4>Spiritual Status</h4>
                        <p>{{ $member->spiritual_status }}</p>
                    </div>

                    <!-- Age Grroup -->
                    <div class="col-md-6">
                        <h4>Spiritual Status</h4>
                        <p>{{ $member->age_group }}</p>
                    </div>

                    <!-- Age Grroup -->
                    <div class="col-md-6">
                        <h4>Spiritual Status</h4>
                        <p>{{ $member->added_by }}</p>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <h4>Description</h4>
                        <p>{{ $member->description }}</p>
                    </div>
                </div>

                <!-- Actions for Edit and Delete -->
                <div class="mt-4">
                    <a href="{{ route('member.edit', ['branch'=>session('branch_id'), 'member'=>$member->id]) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('member.destroy', ['branch'=>session('branch_id'), 'member'=>$member->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');" >
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
