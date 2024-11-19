@extends('branches.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header">
                <h2>Add New Member</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('member.store', ['branch' => session('branch_id')]) }}" method="POST">
                    @csrf
                    <input type="text" name="branch_id" id="branch_id" value="{{ $branch->id }}" hidden
                        class="form-control" reqired>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="text" name="occupation" id="occupation" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="dini_dhehebu">Dini/Dhehebu (Religion/Denomination)</label>
                        <input type="text" name="dini_dhehebu" id="dini_dhehebu" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="spiritual_status">Spiritual Status</label>
                        <select name="spiritual_status" id="spiritual_status" class="form-control">
                            <option value="new believer">New Believer</option>
                            <option value="believer and baptized">Believer and is Baptized</option>
                            <option value="believer but not baptized">Believer but not Baptized</option>
                            <option value="not believer and is sick">Not Believer and is sick</option>
                            <option value="believer and is sick">Believer and is sick</option>
                            <option value="Non Believer">Non Believer</option>
                            <option value="Protest">Protest</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="age_group">Age Group</label>
                        <select name="age_group" id="age_group" class="form-control">
                            <option value="child">Child</option>
                            <option value="young">Young</option>
                            <option value="adult">Adult</option>
                            <option value="elder">Elder</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Add Member</button>
                    <a href="{{ route('member.index', ['branch' => $branch->id]) }}"
                        class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
