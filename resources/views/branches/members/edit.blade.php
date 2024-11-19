@extends('branches.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Edit Member Details</h1>
                <a href="{{ route('member.index', ['branch' => session('branch_id'), 'member' => $member->id]) }}"
                    class="btn btn-secondary">Back to Members List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('member.update', ['branch' => session('branch_id'), 'member' => $member->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $member->name) }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $member->phone) }}" required>
                    </div>

                    <!-- Location -->
                    <div class="form-group mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ old('location', $member->location) }}">
                    </div>

                    <!-- Occupation -->
                    <div class="form-group mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" name="occupation" id="occupation" class="form-control"
                            value="{{ old('occupation', $member->occupation) }}">
                    </div>

                    <!-- Religion/Denomination -->
                    <div class="form-group mb-3">
                        <label for="dini_dhehebu" class="form-label">Religion/Denomination</label>
                        <input type="text" name="dini_dhehebu" id="dini_dhehebu" class="form-control"
                            value="{{ old('dini_dhehebu', $member->dini_dhehebu) }}">
                    </div>

                    <!-- Spiritual Status -->
                    <div class="form-group mb-3">
                        <label for="spiritual_status" class="form-label">Spiritual Status</label>
                        <select name="spiritual_status" id="spiritual_status" class="form-control">
                            <option value="new believer"
                                {{ old('spiritual_status', $member->spiritual_status) == 'new believer' ? 'selected' : '' }}>
                                New Believer</option>
                            <option value="believer and baptized"
                                {{ old('spiritual_status', $member->spiritual_status) == 'believer and baptized' ? 'selected' : '' }}>
                                Believer and is Baptized</option>
                            <option value="believer but not baptized"
                                {{ old('spiritual_status', $member->spiritual_status) == 'believer but not baptized' ? 'selected' : '' }}>
                                Believer but not Baptized</option>
                            <option value="not believer and is sick"
                                {{ old('spiritual_status', $member->spiritual_status) == 'not believer and is sick' ? 'selected' : '' }}>
                                Not Believer and is sick</option>
                            <option value="believer and is sick"
                                {{ old('spiritual_status', $member->spiritual_status) == 'believer and is sick' ? 'selected' : '' }}>
                                Believer and is sick</option>
                            <option value="Non Believer"
                                {{ old('spiritual_status', $member->spiritual_status) == 'Non Believer' ? 'selected' : '' }}>
                                Non Believer</option>
                            <option value="Protest"
                                {{ old('spiritual_status', $member->spiritual_status) == 'Protest' ? 'selected' : '' }}>
                                Protest</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="age_group">Age Group</label>
                        <select name="age_group" id="age_group" class="form-control">
                            <option value="child" {{ $member->age_group == 'child' ? 'selected' : '' }}>Child</option>
                            <option value="young" {{ $member->age_group == 'young' ? 'selected' : '' }}>Young</option>
                            <option value="adult" {{ $member->age_group == 'adult' ? 'selected' : '' }}>Adult</option>
                            <option value="elder" {{ $member->age_group == 'elder' ? 'selected' : '' }}>Elder</option>
                        </select>
                    </div>                    

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $member->description) }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <a href="{{ route('member.index', ['branch' => session('branch_id'), 'member' => $member->id]) }}"
                            class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
