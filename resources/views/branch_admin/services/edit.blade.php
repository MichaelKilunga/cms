@extends('services.app')

@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Validation Errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <div class="container pb-4">
        <div class="mt-4 d-flex justify-between">
            <h2 class="h3 text-center text-primary">Edit Service Report</h2>
            <a href="{{ route('church_admin.services') }}" class="btn btn-secondary mb-3">Back</a>
        </div>
        <form action="{{ route('church_admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
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
                <input type="date" name="date" class="form-control" value="{{ $service->date }}" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message Preached</label>
                <textarea name="message" class="form-control" rows="3" required>{{ $service->message }}</textarea>
            </div>
            <div class="mb-3">
                <label for="minister" class="form-label">Minister</label>
                <input type="text" name="minister" class="form-control" value="{{ $service->minister }}" required>
            </div>

            <!-- Attendance Details -->
            <h4>Attendance</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="women" class="form-label">Women</label>
                    <input type="number" name="women" class="form-control" value="{{ $service->women }}">
                </div>
                <div class="col-md-4">
                    <label for="men" class="form-label">Men</label>
                    <input type="number" name="men" class="form-control" value="{{ $service->men }}">
                </div>
                <div class="col-md-4">
                    <label for="children" class="form-label">Children</label>
                    <input type="number" name="children" class="form-control" value="{{ $service->children }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="cars" class="form-label">Cars</label>
                    <input type="number" name="cars" class="form-control" value="{{ $service->cars }}">
                </div>
                <div class="col-md-4">
                    <label for="baptism_water" class="form-label">Baptisms (Water)</label>
                    <input type="number" name="baptism_water" class="form-control" value="{{ $service->baptism_water }}">
                </div>
                <div class="col-md-4">
                    <label for="baptism_spirit" class="form-label">Baptisms (Spirit)</label>
                    <input type="number" name="baptism_spirit" class="form-control"
                        value="{{ $service->baptism_spirit }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="new_birth" class="form-label">New Believers</label>
                    <input type="number" name="new_birth" class="form-control" value="{{ $service->new_birth }}">
                </div>
                <div class="col-md-4">
                    <label for="first_timers" class="form-label">First-Time Attendees</label>
                    <input type="number" name="first_timers" class="form-control" value="{{ $service->first_timers }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="branch_id" class="form-label">Branch</label>
                        </div>
                        <div class="col-md-9">
                            <select name="branch_id" class="form-select chosen" required>
                                <option value="">Select Branch</option>
                                @isset(Auth::user()->church->first()->name)
                                    @foreach (Auth::user()->church->first()->branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $service->branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="church_id" class="form-label">Church: <span class="text-primary">
                            @isset(Auth::user()->church->first()->name)
                                {{ Auth::user()->church->first()->name }}
                            @endisset
                        </span> </label>
                    <input type="number" name="church_id"
                        value="@isset(Auth::user()->church->first()->name){{ Auth::user()->church->first()->id }}@endisset"
                        class="form-control" readonly hidden>
                </div>
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Admin: {{ Auth::user()->name }}
                        <span class="text-primary italic">(You!)</span></label>
                    <input type="number" name="user_id" value="{{ Auth::user()->id }}" class="form-control" hidden
                        readonly>
                </div>
            </div>


            <button type="submit" class="btn btn-success mt-3">Update Report</button>
        </form>
    </div>
@endsection
