<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Navigation</p>
            <span></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.dashboard') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- {{ dd(Request::is('staff/leads')) }} --}}
        {{-- <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#leads-mgmnt" aria-expanded="false" aria-controls="leads-mgmnt">
                <i class="mdi mdi-palette menu-icon"></i>
                <span class="menu-title">Sales Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="" id="leads-mgmnt">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link {{ Request::is('staff/leads*') ? '' : 'collapsed' }}" href="{{ route('staff.leads') }}" >Leads</a> </li>
                </ul>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.staffsheet') }}">
                <i class="mdi mdi-calendar-check menu-icon"></i> <!-- New attendance icon -->
                <span class="menu-title">Staff Attendance</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.manageAgent') }}">
                <i class="mdi mdi-account-circle menu-icon"></i> <!-- Font Awesome agent icon -->
                <span class="menu-title">Manage Agent</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.customer') }}">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">Manage User</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.earnings') }}">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Earnings</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.enquiry') }}">
                <i class="mdi mdi-palette menu-icon"></i>
                <span class="menu-title">Enquiries</span>
            </a>
        </li>
    </ul>
</nav>
