<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
                {{-- @can('manage system') --}}
                <div class="container">
                    <h1 class="text-center mb-4">Super Admin Dashboard</h1>
                    <div class="row g-4">
                        <!-- Total Churches -->
                        {{-- <div class="col-md-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Total Churches</h5>
                                    <p class="card-text fs-3">{{ $totalChurches }}</p>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Total Branches -->
                        <div class="col-md-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Total Branches</h5>
                                    <p class="card-text fs-3">{{ $totalBranches }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Members -->
                        <div class="col-md-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Total Members</h5>
                                    <p class="card-text fs-3">{{ $totalMembers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mt-4">
                        <!-- Total Services -->
                        <div class="col-md-4">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <h5 class="card-title">Total Services</h5>
                                    <p class="card-text fs-3">{{ $totalServices }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Finances -->
                        <div class="col-md-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Total Finances Reports</h5>
                                    <p class="card-text fs-3">{{ $totalFinances }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Service Categories -->
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title">Total Service Categories</h5>
                                    <p class="card-text fs-3">{{ $totalServiceCategories }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h3>Recent Activities</h3>
                        <ul class="list-group">
                            {{-- <li class="list-group-item">Recent churches: {{ $recentChurches }}</li> --}}
                            <li class="list-group-item">Recent branches: {{ $recentBranches }}</li>
                            <li class="list-group-item">Recent members: {{ $recentMembers }}</li>
                        </ul>
                    </div>
                </div>
                {{-- @endcan --}}
            </div>
        </div>
    </div>

    {{-- MODAL TO REGISTER ONE CHURCH IF NONE --}}
    @can('manage church')
        <div class="modal fade" id="guestChurchAdminModal" tabindex="-1" aria-labelledby="churchAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="churchAdminModalLabel">Register Church</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('church_admin.church.create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Church Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Church Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="motto" class="form-label">Church Motto</label>
                                <input type="text" name="motto" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="administrator_id" class="form-label">Admin: {{Auth::user()->name}} (You!)</label>
                                <input type="text" name="administrator_id" value="{{ Auth::user()->id }}" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <script>
        $('document').ready(function() {

            @if (session('guest_church_admin'))
                $('#guestChurchAdminModal').modal('show');
            @endif
        });
    </script>
</x-app-layout>
