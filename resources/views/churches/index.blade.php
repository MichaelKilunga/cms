@extends('churches.app')

@section('content')
<div class="container">
    <h2>Churches</h2>
    <a href="{{ route('churches.create') }}" class="btn btn-primary mb-3">Add New Church</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Logo</th>
                <th>Motto</th>
                <th>Administrator</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($churches as $church)
                <tr>
                    <td>{{ $church->name }}</td>
                    <td>
                        @if ($church->logo)
                            <img src="{{ asset('storage/' . $church->logo) }}" alt="Logo" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $church->motto }}</td>
                    <td>{{ $church->administrator->name }}</td>
                    <td>
                        <a href="{{ route('churches.edit', $church->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('churches.destroy', $church->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
