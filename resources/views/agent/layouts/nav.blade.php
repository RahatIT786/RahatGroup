<header class="header header-page">
    <div class="header-fixed">
        <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="{{ route('agent.dashboard') }}" class="navbar-brand logo">
                        @if ($agent_company_logo)
                            <img src="{{ asset('storage/company_logo/' . $agent_company_logo) }}" alt=""
                                style="height: 80px;" />
                            <span class="status online"></span>
                        @else
                            <img src="{{ asset('img/agent/logo_1.svg') }}" class="img-fluid" alt="Logo" />
                        @endif

                    </a>
                </div>
                <p class="m-0" style="text-align: center;">{{ $agency_name }}</p>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('agent.dashboard') }}" class="menu-logo">
                            <img src="{{ asset('img/agent/logo_1.svg') }}" class="img-fluid" alt="Logo" />
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>

                </div>
                <ul class="nav header-navbar-rht">
                    <li class="nav-item user-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if ($agent_profile_img)
                                    <img src="{{ asset('storage/profile_image/' . $agent_profile_img) }}" alt />
                                    <span class="status online"></span>
                                @else
                                    <img src="{{ asset('img/avatar/avatar-5.png') }}" alt />
                                    <span class="status online"></span>
                                @endif
                            </span>
                        </a>
                        <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">

                            <div class="user-header">
                                <!-- <div class="avatar avatar-sm">
                                    <img src="{{ asset('img/profile-avatar.jpg') }}" alt="User Image"
                                        class="avatar-img rounded-circle" />
                                </div> -->
                                <div class="user-text ms-0">
                                    <h6>{{ auth()->user()->name }}</h6>
                                    <h6 class="mb-2">{{ $agency_name }}</h6>
                                    <form id="logout-form" action="{{ route('agent.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-unlock me-1"></i> Logout
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <div
                                style="background:#b33771 url({{ asset('img/support-bg.png') }});background-size: 80px;background-repeat: no-repeat;background-position: right top;color:#ffffff;padding:15px;padding-right: 53px;border-radius:10px;">
                                <h5 class="text-white">Customer Support </h5>
                                Relationship Manager: {{ $manager_name }} <br>
                                <i class="fa fa-envelope"></i> {{ $manager_email }}<br>
                                <i class="fa fa-phone"></i> {{ $manager_phone }}<br>
                                {{-- Code: A1222<br> --}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
