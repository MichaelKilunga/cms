@extends('members.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2 class="text-primary h3 mt-4" >Add Member</h2>
        </div>
        <form action="{{ route('branch_admin.member.store') }}" method="POST">
            @csrf
            <div class="modal-body mb-3">
                <label for="name" class="form-label">Member Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="modal-body mb-3" hidden>
                <label for="church_id" class="form-label">Church</label>
                <input type="number" name="church_id" value="{{session('church_id')}}" class="form-control">
            </div>
            {{-- <div class="modal-body mb-3">
                <label for="phone" class="form-label">Member Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div> --}}
            <div class="modal-body mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="" class="form-label" required>
                    <option value="" selected>--Select Gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="modal-body mb-3 hidden">
                <label for="branch_id" class="form-label">Branch</label>
                <input type="number" name="branch_id" value="{{session('branch_id')}}" class="form-control">
            </div>
            <div class="d-flex justify-between modal-footer">
                <a  href="{{route('branch_admin.members')}}" type="button" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Member</button>
            </div>
        </form>
    </div>
@endsection
