<div class="col-xl-2 col-lg-3 col-md-12 theiaStickySidebar">
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>DASHBOARD</h3>
            <ul>
                <li class="nav-item {{ Request::is('agent') || Request::is('agent/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('agent.dashboard') }}" class="nav-link">
                        My Dashboard
                    </a>
                </li>
                <li
                    class="nav-item accordion-item {{ Request::is('agent/quotes*') || Request::is('agent/negotiated*') || Request::is('agent/bookings*') || Request::is('agent/travel-calendar*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/quotes*') || Request::is('agent/negotiated*') || Request::is('agent/bookings*') || Request::is('agent/travel-calendar*') ? '' : 'collapsed' }} "
                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne">
                        Bookings
                    </a>
                    <div id="collapseOne"
                        class="accordion-collapse {{ Request::is('agent/quotes*') || Request::is('agent/negotiated*') || Request::is('agent/bookings*') || Request::is('agent/travel-calendar*') ? '' : 'collapse' }} "
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/quotes*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.quotes.index') }}">All Requests</a></li>

                                <li class="{{ Request::is('agent/negotiated*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.negotiated.quotes.index') }}">Negotiated
                                        Requests</a></li>
                                <li class="{{ Request::is('agent/bookings*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.bookings.index') }}">Bookings</a></li>
                                <li {{ Request::is('agent/travel-calendar*') ? 'active' : '' }}><a
                                        href="{{ route('agent.travel-calendar.index') }}">Travel
                                        Calender</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>



                <li
                    class="nav-item accordion-item {{ Request::is('agent/payment*') || Request::is('agent/approved-payment*') || Request::is('agent/pending-payment*') || Request::is('agent/commission*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/payment*') || Request::is('agent/approved-payment*') || Request::is('agent/pending-payment*') || Request::is('agent/commission*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Payments
                    </a>
                    <div id="collapseTwo"
                        class="accordion-collapse {{ Request::is('agent/payment*') || Request::is('agent/approved-payment*') || Request::is('agent/pending-payment*') || Request::is('agent/commission*') ? '' : 'collapse' }} "
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/payment*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.payment.index') }}">All Payment Lists</a></li>
                                <li class="{{ Request::is('agent/approved-payment*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.approvedPayment.index') }}">Online Payment
                                        List</a></li>
                                <li class="{{ Request::is('agent/pending-payment*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.pendingPayment.index') }}">Offline Payment
                                        List</a></li>
                                <li class="{{ Request::is('agent/commission*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.commission.index') }}">Commissions Earned</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>


                <li
                    class="nav-item accordion-item {{ Request::is('agent/client-report*') || Request::is('agent/statement-report*') ? 'active' : '' }}">
                    <a  href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/client-report*') || Request::is('agent/statement-report*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        Reports
                    </a>
                    <div id="collapseThree"
                        class="accordion-collapse {{ Request::is('agent/client-report*') || Request::is('agent/statement-report*') ? '' : 'collapse' }}"
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/client-report*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.clientReport.index') }}">Client Report</a></li>
                                <li class="{{ Request::is('agent/statement-report*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.statementReport.index') }}">Statement
                                        Report</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li
                    class="nav-item accordion-item {{ Request::is('agent/invoices*') || Request::is('agent/vouchers*') || Request::is('agent/visa*') || Request::is('agent/print-receipt*') || Request::is('agent/ticket*') || Request::is('agent/flyer*') || Request::is('agent/i-cards*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/invoices*') || Request::is('agent/vouchers*') || Request::is('agent/visa*') || Request::is('agent/print-receipt*') || Request::is('agent/ticket*') || Request::is('agent/flyer*') || Request::is('agent/i-cards*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                        aria-controls="collapseFour">
                        Downloads
                    </a>
                    <div id="collapseFour"
                        class="accordion-collapse {{ Request::is('agent/invoices*') || Request::is('agent/visa*') || Request::is('agent/vouchers*') || Request::is('agent/print-receipt*') || Request::is('agent/ticket*') || Request::is('agent/flyer*') || Request::is('agent/i-cards*') ? '' : 'collapse' }} "
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/invoices*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.invoices.index') }}">Invoice</a></li>
                                <li class="{{ Request::is('agent/vouchers*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.vouchers.index') }}">Vouchers</a></li>
                                <li class="{{ Request::is('agent/print-receipt*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.printReceipt.index') }}">Print Receipts</a>
                                </li>
                                <li class="{{ Request::is('agent/ticket*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.ticket.index') }}">Ticket</a></li>
                                <li class="{{ Request::is('agent/visa*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.visa.index') }}">Visa</a></li>
                                <li class="{{ Request::is('agent/i-cards*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.icard.index') }}">ID Card</a></li>
                                <li class="{{ Request::is('agent/flyer*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.flyer.index') }}">Flyer</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li
                    class="nav-item accordion-item {{ Request::is('agent/pending-seat*') || Request::is('agent/flight-details*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/pending-seat*') || Request::is('agent/flight-details*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                        PNR
                    </a>
                    <div id="collapseFive"
                        class="accordion-collapse {{ Request::is('agent/pending-seat*') || Request::is('agent/flight-details*') ? '' : 'collapse' }}"
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/pending-seat*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.pendingSeat.index') }}">Pending Seats</a></li>
                                <li class="{{ Request::is('agent/flight-details*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.flightDetails.index') }}">PNR Flight
                                        details</a></li>
                            </ul>
                        </div>
                    </div>
                </li>


                <li class="nav-item accordion-item {{ Request::is('agent/package-details*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/package-details*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Packages
                    </a>
                    <div id="collapseSix"
                        class="accordion-collapse {{ Request::is('agent/package-details*') ? '' : 'collapse' }}"
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/package-details*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.packageDetails.index') }}">Package Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li
                    class="nav-item accordion-item {{ Request::is('agent/make-customize*') || Request::is('agent/complaint-box*') || Request::is('agent/add-feedback*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/make-customize*') || Request::is('agent/complaint-box*') || Request::is('agent/add-feedback*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false"
                        aria-controls="collapseSeven">
                        Tool
                    </a>
                    <div id="collapseSeven"
                        class="accordion-collapse {{ Request::is('agent/make-customize*') || Request::is('agent/add-feedback*') || Request::is('agent/complaint-box*') ? '' : 'collapse' }} "
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/make-customize*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.makeCustomize.index') }}">Make Customize</a>
                                </li>
                                <li class="{{ Request::is('agent/complaint-box*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.complaintBox.index') }}">Complaint Box</a>
                                </li>
                                <li class="{{ Request::is('agent/add-feedback*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.addFeedback.index') }}">Add Feedback &
                                        Testimomials</a></li>

                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('agent.resource.index') }}">Resource
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('agent.user.enquiry') }}">User Enquiry
                    </a>
                </li>

                <li
                    class="nav-item accordion-item {{ Request::is('agent/content*') || Request::is('agent/image-gallery*') || Request::is('agent/video-gallery*') || Request::is('agent/contact*') || Request::is('agent/faq*') || Request::is('agent/setting*') || Request::is('agent/banner*') || Request::is('agent/subscribers*') || Request::is('agent/sub-agent*') ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="nav-link accordion-button {{ Request::is('agent/content*') || Request::is('agent/contact*') || Request::is('agent/faq*') || Request::is('agent/setting*') || Request::is('agent/banner*') || Request::is('agent/subscribers*') || Request::is('agent/sub-agent*') || Request::is('agent/image-gallery*') || Request::is('agent/video-gallery*') ? '' : 'collapsed' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false"
                        aria-controls="collapseEight">
                        Settings
                    </a>
                    <div id="collapseEight"
                        class="accordion-collapse {{ Request::is('agent/content*') || Request::is('agent/faq*') || Request::is('agent/contact*') || Request::is('agent/setting*') || Request::is('agent/banner*') || Request::is('agent/subscribers*') || Request::is('agent/sub-agent*') || Request::is('agent/image-gallery*') || Request::is('agent/video-gallery*') ? '' : 'collapse' }} "
                        aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="sidebar-submenu">
                                <li class="{{ Request::is('agent/content*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.content.index') }}">Manage Content Page</a>
                                </li>
                                <li class="{{ Request::is('agent/contact*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.contact.index') }}">Manage User Contact</a>
                                </li>
                                <li class="{{ Request::is('agent/faq*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.faq.index') }}">Manage Faq</a></li>
                                <li class="{{ Request::is('agent/setting*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.setting.index') }}">Manage settings</a></li>
                                <li class="{{ Request::is('agent/banner*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.banner.index') }}">Banner</a></li>
                                <li class="{{ Request::is('agent/subscribers*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.subscribers.index') }}">Subscribers</a></li>
                                <li class="{{ Request::is('agent/sub-agent*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.subAgent.index') }}">Sub Agent List</a></li>
                                <li class="{{ Request::is('agent/image-gallery*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.imageGallery.index') }}">Image Gallery</a>
                                </li>
                                <li class="{{ Request::is('agent/video-gallery*') ? 'active' : '' }}"><a
                                        href="{{ route('agent.videoGallery.index') }}">Video Gallery</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
