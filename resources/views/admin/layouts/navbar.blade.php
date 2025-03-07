<div class="navbar-bg"></div>

<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto">

        <ul class="navbar-nav mr-3">

            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

        </ul>

    </form>

    <ul class="navbar-nav navbar-right" wire:ignore>

        <li class="dropdown"><a href="#" data-toggle="dropdown"

                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                {{-- <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1"> --}}

                {{-- @if (File::exists(public_path('storage/profile_image/' . Auth::user()->profile_image))) --}}

                @if (Auth::user()->profile_image)
                    
                    <img alt="image" src="{{ asset('storage/profile_image/' . Auth::user()->profile_image) }}"

                        class="rounded-circle mr-1">

                @else
                
                    <img alt="default image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">

                @endif

                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                @if (!empty($timeAgo))

                    <div class="dropdown-title">Logged in {{ $timeAgo }}</div>

                @endif

                {{-- change-password --}}

                <a href="{{ route('admin.user.edit', auth()->user()->id) }}" class="dropdown-item has-icon">

                    <i class="far fa-user"></i> Profile

                </a>

                {{-- {{ route('admin.change-password') }} --}}

                <a href="{{ route('admin.change-password.edit', auth()->user()->id) }}" class="dropdown-item has-icon">

                    <i class="fas fa-cog"></i> Change password

                </a>

                <div class="dropdown-divider"></div>

                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"

                    onclick="event.preventDefault();

                            document.getElementById('logout-form').submit();">

                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                        @csrf

                    </form>

                </a>

            </div>

        </li>

    </ul>

</nav>

