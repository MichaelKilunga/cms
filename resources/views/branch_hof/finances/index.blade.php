@extends('finances.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Finance Reports</h2>
            <a href="{{ route('branch_admin.finances.create') }}" class="btn btn-primary mb-3">Add New Finance Report</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Date</th>
                    {{-- <th>Worship Offering</th>
                <th>Tithe Offering</th>
                <th>Thanksgiving Offering</th>
                <th>Project Offering</th>
                <th>Special Offering</th> --}}
                    <th>Total Amount (TZS)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($finances as $finance)
                    <tr>
                        <td>{{ $finance->service->name }}</td>
                        <td>{{ $finance->date }}</td>
                        {{-- <td>{{ $finance->worship_offering }}</td>
                    <td>{{ $finance->tithe_offering }}</td>
                    <td>{{ $finance->thanksgiving_offering }}</td>
                    <td>{{ $finance->project_offering }}</td>
                    <td>{{ $finance->special_offering }}</td> --}}
                        <td>
                            {{ number_format(
                                $finance->worship_offering +
                                    $finance->tithe_offering +
                                    $finance->thanksgiving_offering +
                                    $finance->project_offering +
                                    $finance->special_offering +
                                    $finance->firstfruits_offering +
                                    $finance->children_offering +
                                    $finance->cds_dvd_tapes +
                                    $finance->books_and_stickers,
                                2,
                            ) }}
                        </td>
                        <td>
                            <a href="{{ route('branch_admin.finances.edit', $finance->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('branch_admin.finances.show', $finance->id) }}"
                                class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('branch_admin.finances.destroy', $finance->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
