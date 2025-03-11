<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" wire:navigate>AIHUT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}" wire:navigate>AIHUT</a>
        </div>
        <ul class="sidebar-menu">
            {{-- <li class="menu-header">Dashboard</li> --}}
            <li class="dropdown {{ Request::is('admin') || Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li
                class="dropdown {{ Request::is('admin/companies') ? 'active' : '' }} {{ Request::is('admin/bookings*') ? 'active' : '' }}{{ Request::is('admin/negotiated-requests*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                    class="fas fa-building"></i><span>Company Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/companies') ? 'menu-active' : '' }}"
                            href="{{ route('admin.companies') }}" wire:navigate>Companies</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/negotiated-requests') ? 'menu-active' : '' }}"
                            href="{{ route('admin.quotes.negotiated') }}" wire:navigate>Bank Account</a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/agent-list*') || Request::is('admin/sub-agent-list*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-handshake"></i>
                    <span>Agent Management</span></a>

                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/agent-list*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.agentlist.index') }}" wire:navigate>Agent List</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/sub-agent-list*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.subagentlist.index') }}" wire:navigate>Sub Agent List</a>
                    </li>

                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/staff*') || Request::is('admin/staffsalary*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-cog"></i>
                    <span>Staff Management</span></a>

                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/staff*') && !Request::is('admin/staffsalary*') ? 'menu-active' : '' }}"
                        href="{{ route('admin.staff.index') }}" wire:navigate>Staff List</a>

                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/staffsalary*') ? 'menu-active' : '' }}"
                        href="{{ route('admin.staff-salary.index') }}" wire:navigate>Staff Salary</a>

                    </li>
                </ul>
            </li>
            <li class="dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>User Management </span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/customer*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.customer.index') }}" wire:navigate>User List</a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/quotes*') ? 'active' : '' }} {{ Request::is('admin/bookings*') ? 'active' : '' }}{{ Request::is('admin/negotiated-requests*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-book"></i><span>Booking Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/quotes') ? 'menu-active' : '' }}"
                            href="{{ route('admin.quotes.index') }}" wire:navigate>All Requests</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/negotiated-requests') ? 'menu-active' : '' }}"
                            href="{{ route('admin.quotes.negotiated') }}" wire:navigate>Negotiated Requests</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings') ? 'menu-active' : '' }}"
                            href="{{ route('admin.booking.index') }}" wire:navigate>All Bookings</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/bookings/approved') ? 'menu-active' : '' }}" href="{{ route('admin.booking.approved') }}" wire:navigate>Approved Bookings</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/pending') ? 'menu-active' : '' }}" href="{{ route('admin.booking.pending') }}" wire:navigate>Pending Bookings</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/rejected') ? 'menu-active' : '' }}" href="{{ route('admin.booking.rejected') }}" wire:navigate>Rejected Bookings</a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/cancelled') ? 'menu-active' : '' }}"
                            href="{{ route('admin.booking.cancelled') }}" wire:navigate>Cancelled Bookings</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/bookings/suspended') ? 'menu-active' : '' }}" href="{{ route('admin.booking.suspended') }}" wire:navigate>Suspended Bookings</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/deleted') ? 'menu-active' : '' }}" href="{{ route('admin.booking.deleted') }}" wire:navigate>Deleted Bookings</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/online') ? 'menu-active' : '' }}" href="{{ route('admin.booking.online') }}" wire:navigate>Online Bookings</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/waiting') ? 'menu-active' : '' }}" href="{{ route('admin.booking.waiting') }}" wire:navigate>Waiting list</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/bookings/under-review') ? 'menu-active' : '' }}" href="{{ route('admin.booking.review') }}" wire:navigate>Under Review</a>
                    </li> --}}
                </ul>
            </li>

            {{-- Payments --}}
            <li class="dropdown {{ Request::is('admin/payments*') || Request::is('admin/payments/online*') || Request::is('admin/payments/offline') ? 'active' : '' }}">
            	<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-credit-card"></i><span>Payment Management</span></a>
            	<ul class="dropdown-menu">
            		<li>
            			<a class="nav-link {{ Request::is('admin/payments') ? 'menu-active' : '' }}" href="{{ route('admin.payment.index') }}" wire:navigate>Payments</a>
            		</li>
            		<li>
            			<a class="nav-link {{ Request::is('admin/payments/online*') ? 'menu-active' : '' }}" href="{{ route('admin.payment.approved') }}" wire:navigate>Online Payments</a>
            		</li>
            		<li>
            			<a class="nav-link {{ Request::is('admin/payments/offline*') ? 'menu-active' : '' }}" href="{{ route('admin.payment.pending') }}" wire:navigate>Offline Payments</a>
            		</li>
            	</ul>
            </li>

            {{-- Download --}}
            <li
                class="dropdown {{ Request::is('admin/invoices*') ? 'active' : '' }}{{ Request::is('admin/vouchers*') ? 'active' : '' }} {{ Request::is('admin/print-receipt*') ? 'active' : '' }}{{ Request::is('admin/ticket*') ? 'active' : '' }}{{ Request::is('admin/visa') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-download"></i><span>Download</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/invoices*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.invoices.index') }}" wire:navigate>Invoices</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/vouchers*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.vouchers.index') }}" wire:navigate>Vouchers</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/print-receipt*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.printReceipt.index') }}" wire:navigate>Print Receipts</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/ticket*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.ticket.index') }}" wire:navigate>Ticket</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/visa') ? 'menu-active' : '' }}"
                            href="{{ route('admin.visa.index') }}" wire:navigate>Visa</a>
                    </li>
                </ul>
            </li>

            {{-- Reports --}}
            <li
                class="dropdown {{ Request::is('admin/client-report*') ? 'active' : '' }}{{ Request::is('admin/agent-account-report*') ? 'active' : '' }}{{ Request::is('admin/statement-report*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-book"></i><span>Reports</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/client-report*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.clientReport.index') }}" wire:navigate>Client Report</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/agent-account-report*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.agentAccountReport.index') }}" wire:navigate>Agents Accounts
                            Report</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/statement-report*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.statementReport.index') }}" wire:navigate>Statement Report</a>
                    </li>
                </ul>
            </li>

            {{-- PNR --}}
            <li
                class="dropdown {{ Request::is('admin/pnr*') ? 'active' : '' }}{{ Request::is('admin/flight*') ? 'active' : '' }}{{ Request::is('admin/sector*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-ticket-alt"></i><span>PNR Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/flight*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.flight.index') }}" wire:navigate>Manage Flights</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/sector*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.addSector.index') }}" wire:navigate>Add Sector</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/pnr*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.pnr.index') }}" wire:navigate>Manage PNR Details</a>
                    </li>
                </ul>
            </li>

            {{-- Packages --}}
            <li
                class="dropdown {{ Request::is('admin/package-type*') ? 'active' : '' }}{{ Request::is('admin/laundry-type*') ? 'active' : '' }}{{ Request::is('admin/food-type*') ? 'active' : '' }}{{ Request::is('admin/transport-type*') ? 'active' : '' }}{{ Request::is('admin/visa-master*') ? 'active' : '' }}{{ Request::is('admin/hotels*') ? 'active' : '' }}{{ Request::is('admin/packages*') ? 'active' : '' }}{{ Request::is('admin/packagemaster*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-box-open"></i><span>Package Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/package-type*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.packageType.index') }}" wire:navigate>Package Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/laundry-type*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.laundryType.index') }}" wire:navigate>Laundry Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/food-type*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.foodType.index') }}" wire:navigate>Food Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/transport-type*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.transportType.index') }}" wire:navigate>Transport Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/visa-master*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.visaMaster.index') }}" wire:navigate>Visa Master</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/hotels*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.hotel.index') }}" wire:navigate>Hotels</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/packages*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.package.index') }}" wire:navigate>Packages</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/packagemaster*') ? 'menu-active' : '' }}" href="{{ route('admin.packageMaster.index') }}" wire:navigate>Package Master List</a>
                    </li> --}}
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('admin/state*') ? 'active' : '' }} {{ Request::is('admin/tour-category*') ? 'active' : '' }} {{ Request::is('admin/destination*') ? 'active' : '' }} {{ Request::is('admin/destination*') ? 'active' : '' }} {{ Request::is('admin/domestic-tour*') ? 'active' : '' }} {{ Request::is('admin/int-destination*') ? 'active' : '' }} {{ Request::is('admin/international-tour*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-box-open"></i>
                    <span>Tour Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/state*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.state.index') }}" wire:navigate>State & UT</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/tour-category*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.tourCategory.index') }}" wire:navigate>Tour Category</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/destination*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.destination.index') }}" wire:navigate>Domestic Destination</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/domestic-tour*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.tours.index') }}" wire:navigate>Domestic Tour Package</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/int-destination*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.intDestination.index') }}" wire:navigate>International
                            Destination</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/international-tour*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.intTours.index') }}" wire:navigate>International Tour Package</a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/category-page*') ? 'active' : '' }}{{ Request::is('admin/manage-notification*') ? 'active' : '' }}{{ Request::is('admin/manage-relation*') ? 'active' : '' }}{{ Request::is('admin/manage-page*') ? 'active' : '' }}{{ Request::is('admin/header-notification*') ? 'active' : '' }}{{ Request::is('admin/manage-ration*') ? 'active' : '' }}{{ Request::is('admin/manage-flier*') ? 'active' : '' }}{{ Request::is('admin/miscellaneous-items*') ? 'active' : '' }}{{ Request::is('admin/voucher-content/edit*') ? 'active' : '' }}{{ Request::is('admin/manage-services*') ? 'active' : '' }}{{ Request::is('admin/pnr-services*') ? 'active' : '' }}{{ Request::is('admin/sharing-type*') ? 'active' : '' }}{{ Request::is('admin/relationship-manager*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-server"></i><span>Resources Management</span></a>
                <ul class="dropdown-menu">
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/category-page*') ? 'menu-active' : '' }}" href="{{ route('admin.categoryPage.index') }}" wire:navigate>Manage category page</a>
                    </li> --}}
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/manage-page*') ? 'menu-active' : '' }}" href="{{ route('admin.managePage.index') }}" wire:navigate>Manage Page</a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-notification*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageNotification.index') }}" wire:navigate>Manage
                            Notification</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/header-notification*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.headerNotification.index') }}" wire:navigate>Header
                            Notification</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/manage-relation*') ? 'menu-active' : '' }}" href="{{ route('admin.manageRelation.index') }}" wire:navigate>Manage Relation</a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-ration*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manage-ration.index') }}" wire:navigate>Manage Ration</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-flier*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageFlier.index') }}" wire:navigate>Manage Flier</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/miscellaneous-items*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.miscellaneousItems.index') }}" wire:navigate>Miscellaneous
                            Items</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/voucher-content/edit*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.voucherContent.edit', 1) }}">Voucher Content</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-services*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageServices.index') }}" wire:navigate>Manage Service</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/shopping*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.shopping.index') }}" wire:navigate>Shopping</a>
                    </li> --}}
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/pnr-services*') ? 'menu-active' : '' }}" href="{{ route('admin.pnrServices.index') }}" wire:navigate>PNR Service</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/sharing-type*') ? 'menu-active' : '' }}" href="{{ route('admin.sharingType.index') }}" wire:navigate>Sharing Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/relationship-manager*') ? 'menu-active' : '' }}" href="{{ route('admin.relationshipManager.index') }}" wire:navigate>Relationship Manager</a>
                    </li> --}}
                </ul>
            </li>
            {{-- <li class="dropdown {{ Request::is('admin/pnr*') ? 'active' : '' }}{{ Request::is('admin/flight*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-ticket-alt"></i><span>Finance Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-ration*') ? 'menu-active' : '' }}" href="{{ route('admin.comingSoon') }}" wire:navigate>Bank Details</a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="dropdown {{ Request::is('admin/users*') || Request::is('admin/agents*') || Request::is('admin/drivers*') || Request::is('admin/owners*') || Request::is('admin/customers*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i><span>Users Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/users*') ? 'menu-active' : '' }}" href="{{ route('admin.users.index') }}" wire:navigate>Manage Admin</a>
                    </li>
                </ul>
            </li> --}}

            <li
                class="dropdown  {{ Request::is('admin/bank-details*') ? 'active' : '' }} {{ Request::is('admin/beneficiary*') ? 'active' : '' }} {{ Request::is('admin/company*') ? 'active' : '' }} {{ Request::is('admin/forex*') && !Request::is('admin/forex-transaction*') ? 'active' : '' }} {{ Request::is('admin/site-bank-info*') ? 'active' : '' }} {{ Request::is('admin/forex-transaction*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-ticket-alt"></i><span>Finance Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/bank-details*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.bankDetails.index') }}" wire:navigate>Agent Bank Details</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/site-bank-info*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.siteBankInfo.index') }}" wire:navigate>Site Bank Info</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/beneficiary*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.beneficiary.index') }}" wire:navigate>Beneficiary</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/company*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.company.index') }}" wire:navigate>Company Master</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/forex*') && !Request::is('admin/forex-transaction*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.forex.index') }}" wire:navigate>Manage Forex</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/forex-transaction*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.forexTransaction.index') }}" wire:navigate>Forex Transaction</a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('admin/image-gallery*') ? 'active' : '' }} {{ Request::is('admin/video-gallery*') ? 'active' : '' }}{{ Request::is('admin/cust-testimonials*') ? 'active' : '' }}{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-ticket-alt"></i><span>Gallery Management</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/image-gallery*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.imageGallery.index') }}" wire:navigate>Image gallery</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/video-gallery*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.videoGallery.index') }}" wire:navigate>Video gallery</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/testimonials*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.testimonial.index') }}" wire:navigate>Testimonials B2B</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/cust-testimonials*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.custTestimonial.index') }}" wire:navigate>Testimonials B2C</a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('admin/site-setting*') ? 'active' : '' }}{{ Request::is('admin/city*') ? 'active' : '' }} {{ Request::is('admin/site-page*') ? 'active' : '' }}{{ Request::is('admin/admin-setting*') ? 'active' : '' }}{{ Request::is('admin/site-fee*') ? 'active' : '' }}{{ Request::is('admin/admin-list*') ? 'active' : '' }}{{ Request::is('admin/membership*') ? 'active' : '' }}{{ Request::is('admin/newsletter*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-wrench"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/admin-list*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.admin.index') }}" wire:navigate>Manage Admin</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/agent-list*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.agentlist.index') }}" wire:navigate>Agent List</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/sub-agent-list*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.subagentlist.index') }}" wire:navigate>Sub Agent List</a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::is('admin/site-setting*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.sitesettings.index') }}" wire:navigate>Manage Settings</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::is('admin/staff*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.staff.index') }}" wire:navigate>Staff List</a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::is('admin/city*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.city.index') }}" wire:navigate>Manage City</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/site-fee*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.siteFee.index') }}" wire:navigate>Site Fee</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/site-page*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.sitePage.index') }}" wire:navigate>Page List</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/admin-setting*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.adminSetting.index') }}" wire:navigate>Admin Setting</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/membership*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.membership.index') }}" wire:navigate>Manage Membership</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/newsletter*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.newsletter.create') }}" wire:navigate>Manage NewsLetter</a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('admin/agm*') ? 'active' : '' }}{{ Request::is('admin/payment-mode*') ? 'active' : '' }}{{ Request::is('admin/award*') ? 'active' : '' }}{{ Request::is('admin/brochure*') ? 'active' : '' }} {{ Request::is('admin/blog*') ? 'active' : '' }} {{ Request::is('admin/faq*') ? 'active' : '' }} {{ Request::is('admin/banner*') ? 'active' : '' }} {{ Request::is('admin/contact*') ? 'active' : '' }} {{ Request::is('admin/content*') ? 'active' : '' }} {{ Request::is('admin/request*') ? 'active' : '' }} {{ Request::is('admin/location*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-wrench"></i><span>Manage Site Settings</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/faq*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.faq.index') }}" wire:navigate>Manage FAQ</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/banner*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.banner.index') }}" wire:navigate>Manage Banner</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/contact*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.contact.index') }}" wire:navigate>Manage Contact Us</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/content*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.content.index') }}" wire:navigate>Manage Content Page</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/location*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.location.index') }}" wire:navigate>Manage Location Address</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/request*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.request.index') }}" wire:navigate>Manage Request Quote</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/blog*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.blog.index') }}" wire:navigate>Manage Blog</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/brochure*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.brochure.index') }}" wire:navigate>Manage Broucher</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/award*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.award.index') }}" wire:navigate>Manage Awards</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/agm*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.agm.index') }}" wire:navigate>Manage AGM</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/payment-mode*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.paymentmode.index') }}" wire:navigate>Manage PaymentMode</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ Request::is('admin/enquiries*') ? 'active' : '' }}">
                <a href="{{ route('admin.enquiries.index') }}" class="nav-link"><i
                        class="fas fa-headset"></i><span>Manage Enquiries</span></a>
            </li>


            <li
                class="dropdown {{ Request::is('admin/car-type*') ? 'active' : '' }}{{ Request::is('admin/car-sector*') ? 'active' : '' }}{{ Request::is('admin/car-rental*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-server"></i><span>Transport Management </span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/car-type*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageCarType.index') }}" wire:navigate>Manage Car Type</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/car-sector*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageCarSector.index') }}" wire:navigate>Manage Car Sector</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/car-rental*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.manageCarRental.index') }}" wire:navigate>Manage Car Rental</a>
                    </li>
                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/services*') ? 'active' : '' }}{{ Request::is('admin/shopping*') ? 'active' : '' }}{{ Request::is('admin/laundry*') ? 'active' : '' }}{{ Request::is('admin/publication*') ? 'active' : '' }}
">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-server"></i><span>Services</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/services*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.services.index') }}" wire:navigate>Manage Service</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/laundry*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.laundry.index') }}" wire:navigate>Laundry</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/publication*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.publication.index') }}"
                            wire:navigate>{{ __('tablevars.publications') }}</a>
                    </li>


                    <li>
                        <a class="nav-link {{ Request::is('admin/shopping*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.shopping.index') }}" wire:navigate>Shopping</a>
                    </li>


                </ul>
            </li>
            <li
                class="dropdown {{ Request::is('admin/kit-item*') ? 'active' : '' }}{{ Request::is('admin/kit-category*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-server"></i><span>Kit Management </span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/kit-item*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.kitItem.index') }}" wire:navigate>Manage Kit Item</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::is('admin/kit-category*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.kitCategory.index') }}" wire:navigate>Manage Kit</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ Request::is('admin/manage-partner*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-server"></i><span>Partner</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link {{ Request::is('admin/manage-partner*') ? 'menu-active' : '' }}"
                            href="{{ route('admin.managePartner.index') }}" wire:navigate>Manage Partner</a>
                    </li>
                </ul>
            </li>
        </ul>
        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-rocket"></i> Documentation</a>
        </div> --}}
    </aside>
</div>
