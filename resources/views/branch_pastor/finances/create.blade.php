@extends('finances.app')

@section('content')
<div class="container">
    <h2>Create Finance Report</h2>
    <form action="{{ route('finances.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="service_category_id" class="form-label">Service Category</label>
            <select name="service_category_id" class="form-select" required>
                <option value="" disabled selected>Select a category</option>
                @foreach ($serviceCategories as $category)
                    <option value="{{ $category->id }}" 
                        {{ isset($finance) && $finance->service_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Collection Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="worship_offering" class="form-label">Worship Offering</label>
                <input type="number" value="0" step="0.01" name="worship_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="tithe_offering" class="form-label">Tithe Offering</label>
                <input type="number" value="0" step="0.01" name="tithe_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="thanksgiving_offering" class="form-label">Thanksgiving Offering</label>
                <input type="number" value="0" step="0.01" name="thanksgiving_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="project_offering" class="form-label">Project Offering</label>
                <input type="number" value="0" step="0.01" name="project_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="special_offering" class="form-label">Special Offering</label>
                <input type="number" value="0" step="0.01" name="special_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="firstfruits_offering" class="form-label">Firstfruits Offering</label>
                <input type="number" value="0" step="0.01" name="firstfruits_offering" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="children_offering" class="form-label">Children Offering</label>
                <input type="number" value="0" step="0.01" name="children_offering" class="form-control" placeholder="Amount in TZS">
            </div>
            <div class="col-md-6">
                <label for="cds_dvd_tapes" class="form-label">CDs/DVDs/Tapes Sales</label>
                <input type="number" value="0" step="0.01" name="cds_dvd_tapes" class="form-control" placeholder="Amount in TZS">
            </div>
        </div>

        <div class="mt-3">
            <label for="books_and_stickers" class="form-label">Books/Stickers Sales</label>
            <input type="number" value="0" step="0.01" name="books_and_stickers" class="form-control" placeholder="Amount in TZS">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Report</button>
    </form>
</div>
@endsection
