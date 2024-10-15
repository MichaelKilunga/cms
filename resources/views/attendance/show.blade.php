@extends('layouts.app')

@section('content')
<h1>Attendance Report for {{ $report->service_name }}</h1>
<p>Date: {{ $report->service_date }}</p>
<p>Total Attendance: {{ $report->total_attendance }}</p>
<p>Male: {{ $report->male }}</p>
<p>Female: {{ $report->female }}</p>
<p>Children: {{ $report->children }}</p>
<!-- Display other fields here -->

<a href="{{ route('attendance.index') }}">Back to list</a>
@endsection
