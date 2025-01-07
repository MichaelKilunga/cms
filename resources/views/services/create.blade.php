@extends('services.app')

@section('content')
    <div class="container">
        <h2>Create Service Report</h2>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            {{-- <input type="number" name="user_id" class="form-control" placeholder="Enter service name" hidden required> --}}
            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter service name" required>
            </div>
            <div class="mb-3">
                <label for="service_category_id" class="form-label">Service Category</label>
                <select name="service_category_id" class="form-select" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($serviceCategories as $category)
                        <option value="{{ $category->id }}" 
                            {{ isset($service) && $service->service_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="date" class="form-label">Service Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message Preached</label>
                <textarea name="message" class="form-control" rows="3" placeholder="Enter the message preached" required></textarea>
            </div>
            <div class="mb-3">
                <label for="minister" class="form-label">Minister</label>
                <input type="text" name="minister" class="form-control" placeholder="Enter minister's name" required>
            </div>

            <!-- Attendance Details -->
            <h4>Attendance</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="women" class="form-label">Women</label>
                    <input type="number" name="women" class="form-control" placeholder="Enter number of women"
                        min="0">
                </div>
                <div class="col-md-4">
                    <label for="men" class="form-label">Men</label>
                    <input type="number" name="men" class="form-control" placeholder="Enter number of men"
                        min="0">
                </div>
                <div class="col-md-4">
                    <label for="children" class="form-label">Children</label>
                    <input type="number" name="children" class="form-control" placeholder="Enter number of children"
                        min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="cars" class="form-label">Cars</label>
                    <input type="number" name="cars" class="form-control" placeholder="Enter number of cars"
                        min="0">
                </div>
                <div class="col-md-4">
                    <label for="baptism_water" class="form-label">Baptisms (Water)</label>
                    <input type="number" name="baptism_water" class="form-control"
                        placeholder="Enter number of baptisms by water" min="0">
                </div>
                <div class="col-md-4">
                    <label for="baptism_spirit" class="form-label">Baptisms (Spirit)</label>
                    <input type="number" name="baptism_spirit" class="form-control"
                        placeholder="Enter number of baptisms by spirit" min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="new_birth" class="form-label">New Believers</label>
                    <input type="number" name="new_birth" class="form-control" placeholder="Enter number of new believers"
                        min="0">
                </div>
                <div class="col-md-4">
                    <label for="first_timers" class="form-label">First-Time Attendees</label>
                    <input type="number" name="first_timers" class="form-control"
                        placeholder="Enter number of first-time attendees" min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="branch_id" class="form-label">Branch</label>
                    <select name="branch_id" class="form-select" required>
                        <option selected disabled value="">Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="church_id" class="form-label">Church</label>
                    <select name="church_id" class="form-select" required>
                        <option selected disabled value="">Select Church</option>
                        @foreach ($churches as $church)
                            <option value="{{ $church->id }}">{{ $church->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Report</button>
        </form>
    </div>
@endsection
