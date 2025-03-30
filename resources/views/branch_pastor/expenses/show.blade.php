@extends('finances.app')

@section('content')
<div class="container">
    <h2>Finance Report Details</h2>
    <div class="card">
        <div class="card-body">
            <h4>Service: {{ $finance->service->name }}</h4>
            <p><strong>Date:</strong> {{ $finance->date }}</p>
            <p><strong>Worship Offering:</strong> {{ $finance->worship_offering }} TZS</p>
            <p><strong>Tithe Offering:</strong> {{ $finance->tithe_offering }} TZS</p>
            <p><strong>Thanksgiving Offering:</strong> {{ $finance->thanksgiving_offering }} TZS</p>
            <p><strong>Project Offering:</strong> {{ $finance->project_offering }} TZS</p>
            <p><strong>Special Offering:</strong> {{ $finance->special_offering }} TZS</p>
            <p><strong>Firstfruits Offering:</strong> {{ $finance->firstfruits_offering }} TZS</p>
            <p><strong>Children Offering:</strong> {{ $finance->children_offering }} TZS</p>
            <p><strong>CDs/DVDs/Tapes Sales:</strong> {{ $finance->cds_dvd_tapes }} TZS</p>
            <p><strong>Books/Stickers Sales:</strong> {{ $finance->books_and_stickers }} TZS</p>
            <p><strong>Entered By:</strong> {{ $finance->user->name }}</p>
            <p><strong>Report Date:</strong> {{ $finance->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
    <a href="{{ route('branch_pastor.finances') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
