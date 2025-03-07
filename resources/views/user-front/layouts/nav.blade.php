<header class="header header-page">
    <div class="header-fixed">
        <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
            <div class="container">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="{{ route('customer.dashboard') }}" class="navbar-brand logo">
                       
                            <img src="{{ asset('assets/user/images/logo.png') }}" class="img-fluid" alt="Logo" />
                       
                    </a>
                </div>
                <div class="main-menu-wrapper me-auto">
                    <div class="menu-header">
                        <a href="{{ route('customer.dashboard') }}" class="menu-logo">
                            <img src="{{ asset('img/agent/logo_1.svg') }}" class="img-fluid" alt="Logo" />
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav ">
                        <li class="has-submenu">
                            <a href="javascript:void(0)">My Bookings <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a class href="{{ route('customer.quotes.index') }}">All Requests</a></li>
                                <li><a href="{{ route('customer.bookings.index') }}">Bookings</a></li>
                                <li><a href="{{ route('customer.travel-calendar.index') }}">Travel Calender</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="javascript:void(0)">My Payments <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu first-submenu">
                                <li><a href="{{ route('customer.payment.index') }}">All Payment Lists</a></li>
                                <li><a href="{{ route('customer.approvedPayment.index') }}">Approved Payment List</a>
                                </li>
                                <li><a href="{{ route('customer.pendingPayment.index') }}">Pending Payment List</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('customer.profile.index') }}">My Profile</a>
                        </li>
                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="nav-item user-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if(auth()->user()->profile_img)
                                <img src="{{ asset('storage/user_profile_image/' .auth()->user()->profile_img)  }}"/>
                                <span class="status online"></span>
                                @else
                                <img src="{{ asset('img/agent/User.svg') }}" alt />
                                <span class="status online"></span>
                                @endif
                            </span>
                        </a>
                        <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">

                            <div class="user-header">
                                <div class="user-text ms-0">
                                    <h6>{{ auth()->user()->name }}</h6>
                                    {{-- <h6 class="mb-2">{{ $name }}</h6> --}}
                                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-unlock me-1"></i> Logout
                                        </button>
                                    </form>
                                    <!-- <p class="text-muted mb-0">Agent</p> -->
                                </div>
                            </div>
                            {{-- <div
                                style="background:#b33771 url({{ asset('img/support-bg.png') }});background-size: 80px;background-repeat: no-repeat;background-position: right top;color:#ffffff;padding:15px;padding-right: 53px;border-radius:10px;">
                                <h5 class="text-white">Customer Support </h5>
                                Relationship Manager: {{ $manager_name }} <br>
                                <i class="fa fa-envelope"></i> {{ $manager_email }}<br>
                                <i class="fa fa-phone"></i> {{ $manager_phone }}<br>
                              
                            </div> --}}
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
