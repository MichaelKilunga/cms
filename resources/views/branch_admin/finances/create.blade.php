@extends('finances.app')

@section('content')
<div class="container pb-4">
    <div class="mt-4 d-flex justify-content-between">
    <h2 class="h3 text-primary">Create Finance Report</h2>
    <a href="{{ route('church_admin.finances') }}" class="btn btn-secondary mb-3">Back</a>
</div>
    <form action="{{ route('church_admin.finances.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="service_id" class="form-label text-primary">Service Name</label>
            <select name="service_id" class="form-select" required>
                <option value="" disabled selected>Select service</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" 
                        {{ isset($finance) && $finance->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="modal-body mb-3">
            <label for="date" class="form-label text-primary">Collection Date</label>
            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="worship_offering" class="form-label text-primary">Worship Offering</label>
                <input type="number" value="0" step="0.01" name="worship_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="tithe_offering" class="form-label text-primary">Tithe Offering</label>
                <input type="number" value="0" step="0.01" name="tithe_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="thanksgiving_offering" class="form-label text-primary">Thanksgiving Offering</label>
                <input type="number" value="0" step="0.01" name="thanksgiving_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="project_offering" class="form-label text-primary">Project Offering</label>
                <input type="number" value="0" step="0.01" name="project_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="special_offering" class="form-label text-primary">Special Offering</label>
                <input type="number" value="0" step="0.01" name="special_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="firstfruits_offering" class="form-label text-primary">Firstfruits Offering</label>
                <input type="number" value="0" step="0.01" name="firstfruits_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="children_offering" class="form-label text-primary">Children Offering</label>
                <input type="number" value="0" step="0.01" name="children_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="cds_dvd_tapes" class="form-label text-primary">CDs/DVDs/Tapes Sales</label>
                <input type="number" value="0" step="0.01" name="cds_dvd_tapes" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="mt-3">
            <label for="books_and_stickers" class="form-label text-primary">Books/Stickers Sales</label>
            <input type="number" value="0" step="0.01" name="books_and_stickers" class="form-control" placeholder="Amount in TZS">
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
