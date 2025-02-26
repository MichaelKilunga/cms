@extends('finances.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Edit Finance Report</h2>
            <a href="{{ route('branch_admin.finances') }}" class="btn btn-secondary mb-3">Back</a>
        </div>
        <form action="{{ route('branch_admin.finances.update', $finance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="service_id" class="form-label">Service Name</label>
                <select name="service_id" class="form-select" required>
                    <option value="" disabled selected>Select Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ isset($finance) && $finance->service->id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Collection Date</label>
                <input type="date" name="date" class="form-control" value="{{ $finance->date }}" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="worship_offering" class="form-label">Worship Offering</label>
                    <input type="number" step="0.01" name="worship_offering" class="form-control"
                        value="{{ $finance->worship_offering }}">
                </div>
                <div class="col-md-6">
                    <label for="tithe_offering" class="form-label">Tithe Offering</label>
                    <input type="number" step="0.01" name="tithe_offering" class="form-control"
                        value="{{ $finance->tithe_offering }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="thanksgiving_offering" class="form-label">Thanksgiving Offering</label>
                    <input type="number" step="0.01" name="thanksgiving_offering" class="form-control"
                        value="{{ $finance->thanksgiving_offering }}">
                </div>
                <div class="col-md-6">
                    <label for="project_offering" class="form-label">Project Offering</label>
                    <input type="number" step="0.01" name="project_offering" class="form-control"
                        value="{{ $finance->project_offering }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="special_offering" class="form-label">Special Offering</label>
                    <input type="number" step="0.01" name="special_offering" class="form-control"
                        value="{{ $finance->special_offering }}">
                </div>
                <div class="col-md-6">
                    <label for="firstfruits_offering" class="form-label">Firstfruits Offering</label>
                    <input type="number" step="0.01" name="firstfruits_offering" class="form-control"
                        value="{{ $finance->firstfruits_offering }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="children_offering" class="form-label">Children Offering</label>
                    <input type="number" step="0.01" name="children_offering" class="form-control"
                        value="{{ $finance->children_offering }}">
                </div>
                <div class="col-md-6">
                    <label for="cds_dvd_tapes" class="form-label">CDs/DVDs/Tapes Sales</label>
                    <input type="number" step="0.01" name="cds_dvd_tapes" class="form-control"
                        value="{{ $finance->cds_dvd_tapes }}">
                </div>
            </div>

            <div class="mt-3">
                <label for="books_and_stickers" class="form-label">Books/Stickers Sales</label>
                <input type="number" step="0.01" name="books_and_stickers" class="form-control"
                    value="{{ $finance->books_and_stickers }}">
            </div>

            
            <div class="row mt-3">
                <div class="col-md-6 row">
                        <label for="branch_id" class="form-label">Branch: <span class="text-primary">
                            {{ $currentBranch->name }}
                        </span> </label>
                        <input type="number" name="branch_id" value="{{ $currentBranch->id }}" hidden>
                </div>  
                <div class="modal-body   mb-3  col-md-3">
                    <label for="church_id" class="form-label">Church: <span class="text-primary">
                        {{ $currentChurch->name }}  
                        </span> </label>
                    <input type="number" name="church_id"
                        value="{{ $currentChurch->id }}"
                        class="form-control" readonly hidden>
                </div>
                <div class="modal-body mb-3 col-md-3">
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
