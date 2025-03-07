<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="navbar-brand-wrapper">

            <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('img/staff/logo.png') }}"
                    alt="logo" /></a>

            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('img/staff/logo-mini.svg') }}"
                    alt="logo" /></a>

        </div>

        <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Welcome back, {{ auth()->user()->first_name }}

        </h4>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item">

                <h4 class="mb-0 font-weight-bold d-none d-xl-block">{{ date('l, M d, Y') }}

                </h4>

            </li>

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">

            <span class="mdi mdi-menu"></span>

        </button>

    </div>

    <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">

        <ul class="navbar-nav mr-lg-2">

            <li class="nav-item nav-search d-none d-lg-block">

                <div class="input-group">

                    <input type="text" class="form-control no-border" placeholder="Search Here..."
                        aria-label="search" aria-describedby="search">

                </div>

            </li>

        </ul>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">

                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

                    @if (Auth::user()->photo)
                        <img alt="image" src="{{ asset('storage/staff_photo/' . Auth::user()->photo) }}"
                            class="rounded-circle mr-1">
                    @else
                        <img alt="default image" src="{{ asset('img/avatar/avatar-1.png') }}"
                            class="rounded-circle mr-1">
                    @endif

                    <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->first_name }}</div>

                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('staff.profile.edit', auth()->user()->id) }}">
                        <i class="mdi mdi-account-settings text-primary"></i>Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('staff.change-password.edit', auth()->user()->id) }}">
                        <i class="mdi mdi-settings text-primary"></i>Change password
                    </a>

                    <a href="{{ route('staff.logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();

                            document.getElementById('logout-form').submit();">

                        <i class="mdi mdi-logout text-primary"></i> {{ __('Logout') }}

                        <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">

                            @csrf

                        </form>

                    </a>

                </div>

            </li>

            <li class="nav-item">

                <a href="#" class="nav-link icon-link">

                    <i class="mdi mdi-clock-fast"></i>

                </a>

                &nbsp;<span class="clock-digital" style="color: black;font-size: larger;">{{ date('g:i A') }}</span>

            </li>

            {{-- setInterval(() => {

                document.getElementById('clock').innerText = new Date().toLocaleTimeString();

            }, 1000); --}}

        </ul>

    </div>

</nav>
