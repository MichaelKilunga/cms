<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Church Finance Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: url('/images/church-hero.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 60px 0;
        }
    </style>
</head>

<body class="bg-light h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom bg-white py-3">
        <div class="container">
            <div class="d-flex align-items-center">
                <x-application-mark class="h-9 w-auto me-2" />
                <button class="btn btn-sm btn-outline-danger">{{ config('app.name') }}</button>
            </div>
            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a class="btn btn-outline-primary me-2" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="overlay text-center text-white">
            <div class="container">
                <h1 class="display-4 fw-bold">Church Finance Management System</h1>
                <p class="lead mb-4 mt-3">Track offerings, generate reports, manage branches & members with ease.</p>
                @auth
                    <a class="btn btn-light me-2" href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a class="btn btn-light me-2" href="{{ route('login') }}">Login</a>
                @endauth
                @if (Route::has('register'))
                    <a class="btn btn-outline-light" href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="h1 text-primary mb-4">Key Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Service Reports</h5>
                            <p class="card-text">Record attendance, messages preached, and spiritual stats for each service.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Finance Tracking</h5>
                            <p class="card-text">Manage offerings, tithes, and sales transparently across all branches.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Role-Based Access</h5>
                            <p class="card-text">Each user group sees only what they are authorized to control or view.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sample Users Section -->
    <section class="bg-white py-5">
        <div class="container text-center">
            <h2 class="h1 text-primary mb-4">Sample Test Users</h2>
            <div class="row g-4">
                @foreach ([
                    ['Super Admin', 'superadmin@demo.com', '0700000000'],
                    ['Church Admin', 'churchadmin@demo.com', '0711111111'],
                    ['Church Board', 'churchboard@demo.com', '0722222222'],
                    ['Branch Admin', 'branchadmin@demo.com', '0733333333'],
                    ['Branch Leader', 'branchleader@demo.com', '0744444444'],
                    ['Member', 'member@demo.com', '0755555555'],
                ] as [$role, $email, $phone])
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $role }}</h5>
                                <p class="card-text">Email: {{ $email }}</p>
                                <p class="card-text">Phone: {{ $phone }}</p>
                                <p class="card-text">Password: <span class="text-muted">password</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-top text-muted bg-white py-4 text-center">
        <div class="container">
            <small>© {{ now()->year }} | {{ config('app.name') }} | Built with 💒 by Emic-Soft Company</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
