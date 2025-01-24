@extends('services.app')

@section('content')
    <div class="container pb-4">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-center text-primary">Create Service Report</h2>
            <a href="{{ route('church_admin.services') }}" class="btn btn-secondary mb-3">Back</a>
        </div>
        <form action="{{ route('church_admin.services.store') }}" method="POST">
            @csrf
            {{-- <input type="number" name="user_id" class="form-control" placeholder="Enter service name" hidden required> --}}
            <div class="mb-3">
                <label for="name" class="form-label text-primary">Service Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter service name" required>
            </div>
            <div class="mb-3">
                <label for="service_category_id" class="form-label text-primary">Service Category</label>
                <select name="service_category_id" class="form-select chosen" required>
                    <option value="">Select Service Category</option>
                    @isset(Auth::user()->church->first()->name)
                        @foreach (App\Models\serviceCategory::where('status', 'active')->where('church_id', Auth::user()->church->first()->id)->get() as $serviceCategory)
                            <option value="{{ $serviceCategory->id }}">{{ $serviceCategory->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="modal-body  mb-3">
                <label for="date" class="form-label text-primary">Service Date</label>
                {{-- set date to today --}}
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="modal-body  mb-3">
                <label for="message" class="form-label text-primary">Message</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>
            <div class="modal-body mb-3">
                <label for="minister" class="form-label text-primary">Minister</label>
                <input type="text" name="minister" class="form-control" required>
            </div>

            <!-- Attendance Details -->
            <h4>Attendance</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="women" class="form-label">Women</label>
                    <input type="number" value="0" name="women" class="form-control"
                        placeholder="Enter number of women" min="0">
                </div>
                <div class="col-md-4">
                    <label for="men" class="form-label">Men</label>
                    <input type="number" value="0" name="men" class="form-control"
                        placeholder="Enter number of men" min="0">
                </div>
                <div class="col-md-4">
                    <label for="children" class="form-label">Children</label>
                    <input type="number" value="0" name="children" class="form-control"
                        placeholder="Enter number of children" min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="cars" class="form-label">Cars</label>
                    <input type="number" value="0" name="cars" class="form-control"
                        placeholder="Enter number of cars" min="0">
                </div>
                <div class="col-md-4">
                    <label for="baptism_water" class="form-label">Baptisms (Water)</label>
                    <input type="number" value="0" name="baptism_water" class="form-control"
                        placeholder="Enter number of baptisms by water" min="0">
                </div>
                <div class="col-md-4">
                    <label for="baptism_spirit" class="form-label">Baptisms (Spirit)</label>
                    <input type="number" value="0" name="baptism_spirit" class="form-control"
                        placeholder="Enter number of baptisms by spirit" min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="new_birth" class="form-label">New Believers</label>
                    <input type="number" value="0" name="new_birth" class="form-control"
                        placeholder="Enter number of new believers" min="0">
                </div>
                <div class="col-md-4">
                    <label for="first_timers" class="form-label">First-Time Attendees</label>
                    <input type="number" value="0" name="first_timers" class="form-control"
                        placeholder="Enter number of first-time attendees" min="0">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 row">
                    <div class="col-md-2">
                        <label for="branch_id" class="form-label">Branch</label>
                    </div>
                    <div class="col-md-10">
                        <select name="branch_id" class="form-select" required>
                            <option value="">Select Branch</option>
                            @isset(Auth::user()->church->first()->name)
                                @foreach (Auth::user()->church->first()->branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
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

            <button type="submit" class="btn btn-primary mt-3">Submit Report</button>
        </form>
    </div>
@endsection
