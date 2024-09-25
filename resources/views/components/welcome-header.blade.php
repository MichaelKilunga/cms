<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="assets/img/cms_logo.svg" alt="..." /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            {{__('Menu')}}
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#services">{{__('header.features')}} </a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">{{__('Partners')}} </a></li>
                <li class="nav-item"><a class="nav-link" href="#about">{{__('About')}}</a></li>
                <li class="nav-item"><a class="nav-link" href="#team">{{__('Testimonies')}} </a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">{{__('Contact us')}}</a></li>
                @if (Route::has('login'))
                    {{-- <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10"> --}}
                    @auth
                        <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"> {{__('Dashboard')}}</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">{{__('Login')}}</a></li>

                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">{{__('Register')}}</a></li>
                        @endif
                    @endauth
                    {{-- </div> --}}
                @endif
                </li>
            </ul>
        </div>
    </div>
</nav>