@extends('services.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Service Reports</h2>
            <a href="{{ route('branch_pastor.services.create') }}" class="btn btn-primary mb-3">Add New Service Report</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Branch</th>
                    <th>Church</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->date }}</td>
                        <td>{{ $service->branch->name }}</td>
                        <td>{{ $service->church->name }}</td>
                        <td>
                            @if ($service->status === 1)
                                <a href="#" class="btn disabled btn-secondary btn-sm">Approved</a>
                            @endif
                            @if ($service->status === 0)
                                <a href="#" class="btn disabled btn-danger btn-sm">Unapproved</a>
                            @endif
                            @if ($service->status === null)
                                <a class="btn btn-primary btn-sm" href="javascript:void(0);"
                                    onclick="let approve = false;
                                    if (confirm('Do you approve this report? (Yes/No)')) {
                                            approve = true;
                                            let reason = prompt('Thanks!   Would you like to leave any note to hof?');
                                            if(reason === null){
                                            // reload the page
                                            location.reload();                             
                                            }
                                            else{
                                            window.location.href = '{{ route('branch_pastor.services.approve', $service->id) }}' + '?reason=' + reason +'&approve=1';
                                                 }
                                        } else {
                                            let reason = prompt('Give reson please!');
                                        if(reason === null){
                                            // reload the page
                                            location.reload();                             
                                            }
                                            else{
                                            window.location.href = '{{ route('branch_pastor.services.approve', $service->id) }}' + '?reason=' + reason +'&approve=0';
                                                }
                                     }">Approve</a>
                            @endif
                            <a href="{{ route('branch_pastor.services.edit', $service->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('branch_pastor.services.show', $service->id) }}"
                                class="btn btn-success btn-sm">show</a>
                            <form action="{{ route('branch_pastor.services.destroy', $service->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
