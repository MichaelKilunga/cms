<div class="container">
    <h1 class="text-center mb-4">Super Admin Dashboard</h1>
    <div class="row g-4">
        <!-- Total Churches -->
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Churches</h5>
                    <p class="card-text fs-3">{{ $totalChurches }}</p>
                </div>
            </div>
        </div>

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
            <li class="list-group-item">Recent churches: {{ $recentChurches }}</li>
            <li class="list-group-item">Recent branches: {{ $recentBranches }}</li>
            <li class="list-group-item">Recent members: {{ $recentMembers }}</li>
        </ul>
    </div>
</div>
