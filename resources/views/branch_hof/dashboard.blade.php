<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Quick actions that prompt creation modals of each entity resspectively --}}
                <div class="container mt-4">
                    <h1 class="text-center text-primary h2 mb-4">Quick Actions</h1>
                    <div class="row smaller g-5 mb-4 justify-content-center">
                        <div class="col-md-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#memberModal">
                                Add Member
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal">
                                File Service Report
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#financeModal">
                                File Finance Report
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="container mt-4 mb-4">
                        <h1 class="text-center h2 text-primary mb-4">Church Admin Dashboard</h1>
                        <div class="row g-6  justify-content-center">
                            <!-- Total Members -->
                            <div class="col-md-2">
                                <div class="card text-white bg-warning">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Members</h5>
                                        <p class="card-text fs-3">{{ $totalMembers }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Services -->
                            <div class="col-md-2">
                                <div class="card text-white bg-danger">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Services</h5>
                                        <p class="card-text fs-3">{{ $totalServices }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Finances -->
                            <div class="col-md-3">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Finances Reports</h5>
                                        <p class="card-text fs-3">{{ $totalFinances }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- MODAL TO CREATE MEMBER --}}
        <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="memberModalLabel">Add Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('branch_admin.member.store') }}" method="POST">
                        @csrf
                        <div class="modal-body mb-3">
                            <label for="name" class="form-label">Member Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3" hidden>
                            <label for="church_id" class="form-label">Church</label>
                            <input type="number" name="church_id" value="{{session('church_id')}}" class="form-control">
                        </div>
                        <div class="modal-body mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="" class="form-label" required>
                                <option value="" selected>--Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="modal-body mb-3" hidden>
                            <label for="branch_id" class="form-label">Branch</label>
                            <input type="number" name="branch_id" value="{{session('branch_id')}}" class="form-control">                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL TO CREATE SERVICE:
            Service atttributes are;
            [
            'name',
            'service_category_id',
            'date',
            'message',
            'minister',
            'women',
            'men',
            'children',
            'cars',
            'baptism_water',
            'baptism_spirit',
            'new_birth',
            'first_timers',
            'user_id',
            'branch_id',
            'church_id'
            ];
            --}}
        <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="serviceModalLabel">Add Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('branch_admin.services.store') }}" method="POST">
                        @csrf
                        <div class="modal-body mb-3">
                            <label for="name" class="form-label text-primary">Service Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="service_category_id" class="form-label text-primary">Service Category</label>
                            <select name="service_category_id"  class="form-select chosen" required>
                                <option value="">Select Service Category</option>
                                    @foreach ( App\Models\serviceCategory::where('status','active')->where('church_id', session('church_id'))->get() as $serviceCategory)
                                        <option value="{{ $serviceCategory->id }}">{{ $serviceCategory->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="modal-body  mb-3">
                            <label for="date" class="form-label text-primary">Service Date</label>
                            {{-- set date to today --}}
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>  
                        <div class="modal-body  mb-3">
                            <label for="message" class="form-label text-primary">Message</label>
                            <textarea name="message" class="form-control" required></textarea>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="minister" class="form-label text-primary">Minister</label>
                            <input type="text" name="minister" class="form-control" required>
                        </div>
                        {{-- number of men, women and children --}}
                        <div class="modal-body mb-3">
                            <label for="women" class="form-label text-primary">Number of women </label>
                            <input type="number" name="women" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="men" class="form-label text-primary">Number of men </label>
                            <input type="number" name="men" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="children" class="form-label text-primary">Number of children </label>
                            <input type="number" name="children" value="0" class="form-control" required>
                        </div>
                        {{-- number of cars, baptism_water, baptism_spirit, new_birth, first_timers --}}
                        <div class="modal-body mb-3">
                            <label for="cars" class="form-label">Number of cars </label>
                            <input type="number" name="cars" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="baptism_water" class="form-label text-primary">Number of Baptism by Water</label>   
                            <input type="number" name="baptism_water"  value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="baptism_spirit" class="form-label text-primary">Number of Baptism by Spirit</label>
                            <input type="number" name="baptism_spirit" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="new_birth" class="form-label text-primary">Number of New Birth</label>
                            <input type="number" name="new_birth" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="first_timers" class="form-label text-primary">Number of First Timers</label>
                            <input type="number" name="first_timers" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="branch_id" class="form-label">Branch: <span class="text-primary">{{ $currentBranch->name }}</span> </label>
                            <input type="number" name="branch_id" value="{{session('branch_id')}}" hidden readonly>
                        </div>
                        <div class="modal-body   mb-3">
                            <label for="church_id" class="form-label">Church: <span class="text-primary">{{ $currentChurch->name }}</span> </label>
                            <input type="number" name="church_id"
                                value="{{ session('church_id') }}"
                                class="form-control" readonly hidden>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="user_id" class="form-label">Admin: {{ Auth::user()->name }}
                                <span class="text-primary italic">(You!)</span></label>
                            <input type="number" name="user_id" value="{{ Auth::user()->id }}" class="form-control" hidden
                                readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL TO CREATE FINANCE REPORT 
            Finance attributes are;
            [
            'service_id','date', 'worship_offering', 'tithe_offering', 'thanksgiving_offering',
            'project_offering', 'special_offering', 'firstfruits_offering', 'children_offering',
            'cds_dvd_tapes', 'books_and_stickers', 'user_id', 'branch_id', 'church_id',
            ];
            --}}
        <div class="modal fade" id="financeModal" tabindex="-1" aria-labelledby="financeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="financeModalLabel">Add Finance Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('branch_admin.finances.store') }}" method="POST">
                        @csrf                        
                        <div class="modal-body mb-3">
                            <label for="service_id" class="form-label text-primary">Service</label>
                            <select name="service_id" class="form-select chosen" required>
                                <option value="" selected>--Select Service--</option>
                                @isset(Auth::user()->church->first()->name)
                                {{-- get the last 10 services --}}
                                    @foreach (App\Models\Service::where('church_id', session('church_id'))->where('branch_id', session('branch_id'))->take(10)->get() as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="date" class="form-label text-primary">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="worship_offering" class="form-label text-primary">Worship Offering</label>
                            <input type="number" name="worship_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="tithe_offering" class="form-label text-primary">Tithe Offering</label>
                            <input type="number" name="tithe_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body  mb-3">
                            <label for="thanksgiving_offering" class="form-label text-primary">Thanksgiving Offering</label>
                            <input type="number" name="thanksgiving_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="project_offering" class="form-label text-primary">Project Offering</label>
                            <input type="number" name="project_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="special_offering" class="form-label text-primary">Special Offering</label>
                            <input type="number" name="special_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="firstfruits_offering" class="form-label text-primary">Firstfruits Offering</label>
                            <input type="number" name="firstfruits_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="children_offering" class="form-label text-primary">Children Offering</label>
                            <input type="number" name="children_offering" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="cds_dvd_tapes" class="form-label text-primary">CDs, DVD, Tapes</label>
                            <input type="number" name="cds_dvd_tapes" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="books_and_stickers" class="form-label text-primary">Books and Stickers</label>
                            <input type="number" name="books_and_stickers" value="0" class="form-control" required>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select name="branch_id" class="form-select chosen" required>
                                <option value="">Select Branch</option>
                                @isset(Auth::user()->church->first()->name)
                                    @foreach (Auth::user()->church->first()->branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="modal-body   mb-3">
                            <label for="church_id" class="form-label">Church: <span class="text-primary">@isset(Auth::user()->church->first()->name){{ Auth::user()->church->first()->name }}@endisset</span> </label>
                            <input type="number" name="church_id"
                                value="@isset(Auth::user()->church->first()->name){{ Auth::user()->church->first()->id }}@endisset"
                                class="form-control" readonly hidden>
                        </div>
                        <div class="modal-body mb-3">
                            <label for="user_id" class="form-label">Admin: {{ Auth::user()->name }}
                                <span class="text-primary italic">(You!)</span></label>
                            <input type="number" name="user_id" value="{{ Auth::user()->id }}" class="form-control" hidden
                                readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Finance Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
