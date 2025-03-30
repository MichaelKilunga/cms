@extends('branch_pastor.expenses.app')

@section('content')
    <div class="container">
        <div class="mt-4 d-flex justify-content-between">
            <h2 class="h3 text-primary">Funds Request's Pannel</h2>
            <a href="{{ route('branch_pastor.expenses.create') }}" class="btn btn-primary mb-3">Request Fund</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Purpose</th>
                    {{-- <th>Item</th> --}}
                    {{-- <th>Quantity</th> --}}
                    <th>Total Amount(TZS)</th>
                    {{-- <th>Requested By</th> --}}
                    <th>Requested</th>
                    <th>Required Before</th>
                    {{-- <th>Unit Price(TZS)</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->purpose }}</td>
                        {{-- <td>{{ $expense->item }}</td> --}}
                        {{-- <td>{{ $expense->quantity }}</td> --}}
                        <td>
                            {{ number_format(
                                $expense->unit_price *
                                $expense->quantity,
                                2,
                                ) }}
                        </td>
                        {{-- <td>{{ $expense->requester->name??"N/A" }}</td> --}}
                        {{--  time difference to current time  --}}
                        <td>{{ $expense->request_date ? $expense->request_date->diffForHumans() : "N/A" }}</td>
                        <td>{{ $expense->required_before ? $expense->request_date->diffForHumans() : "N/A" }}</td>
                        {{-- <td>{{ $expense->unit_price }}</td> --}}
                        <td>
                            @if ($expense->status === 1)
                                <a href="#" class="btn disabled btn-secondary btn-sm"><i class="bi bi-check" ></i>Approved</a>
                            @endif
                            @if ($expense->status === 0)
                                <a href="#" class="btn disabled btn-danger btn-sm"><i class="bi bi-x-circle" ></i> Rejected</a>
                            @endif
                            @if ($expense->status === null)
                                <a class="btn btn-primary btn-sm" href="javascript:void(0);"
                                    onclick="let approve = false;   
                                    if (confirm('Do you approve this request?')) {
                                            approve = true;
                                            let reason = prompt('Thanks!  Would you like to leave any note?');
                                            if(reason === null){
                                            // reload the page
                                            location.reload();                             
                                            }
                                            else{
                                            window.location.href = '{{ route('branch_pastor.expenses.approve', $expense->id) }}' + '?reason=' + reason +'&approve=1';
                                                }
                                        } else {
                                            let reason = prompt('Leave a reson please!');
                                        if(reason === null){                                            
                                            // reload the page
                                            location.reload();                                             
                                            }
                                            else{
                                            window.location.href = '{{ route('branch_pastor.expenses.approve', $expense->id) }}' + '?reason=' + reason +'&approve=0';
                                                }
                                     }"><i class="bi bi-reply" ></i>Respond</a>
                            @endif
                            <a href="{{ route('branch_pastor.expenses.edit', $expense->id) }}"
                                class="btn btn-warning btn-sm"><i class="bi bi-pencil" ></i> Edit</a>
                            <a href="{{ route('branch_pastor.expenses.show', $expense->id) }}"
                                class="btn btn-success btn-sm"><i class="bi bi-eye" ></i> Show</a>
                            <form action="{{ route('branch_pastor.expenses.destroy', $expense->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')"><i class="bi bi-trash" ></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
