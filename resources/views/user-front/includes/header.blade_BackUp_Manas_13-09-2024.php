<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rahat</title>
    <meta name="description" content="Rahat">
    <meta name="keywords" content="Rahat">
    <link href="{{ asset('assets/user-front/stylesheets/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user-front/stylesheets/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/slick-theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/user-front/stylesheets/splitting-cells.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user-front/stylesheets/fullcalendar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user-front/stylesheets/fullcalendar.print.css') }}"
        media="print" />
    <link href="{{ asset('assets/user-front/stylesheets/general.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,1000"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">
    @stack('extra_css')
</head>

<body>
    <header class="header">
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="contact-nav text-md-left text-center">
                            <ul>
                                <li>
                                    <div class="before-icon"><i class="bx bx-phone"></i>
                                        +91 7861078617 & 01123232384
                                    </div>
                                </li>
                                <li>
                                    <div class="before-icon"><i class="bx bx-envelope"></i>
                                        info@rahat.in
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right text-center">
                        <div class="d-flex justify-content-md-end justify-content-center align-items-center">
                            <div class="contact-nav">
                                <ul>
                                    <li>
                                        <a href="{{ route('customer.login') }}">
                                            <div class="before-icon"><i class="bx bx-lock-alt"></i>Login</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="before-icon"><i class="bx bx-edit"></i>Register</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Logo Start -->
                    <a class="navbar-brand logo" href="index.html" title="Rahat">
                        <img src="{{ asset('assets/user-front/images/logo.jpg') }}" alt="logo">
                    </a>
                    <!-- /Logo End -->

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="active-menu" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Hajj</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Shifting Long Package</a></li>
                                    <li><a href="#">Shifting Short Package</a></li>
                                    <li><a href="#">Shifting Very Short Package</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Umrah</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Fixed Group Departures</a></li>
                                    <li><a href="#">Land Packages</a></li>
                                    <li><a href="#">Umrah Plus</a></li>
                                    <li><a href="#">Customized Umrah Enquiry</a></li>
                                    <li><a href="{{ route('umrahCalendar') }}">Umrah Calender</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Ramzaan</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Full Month</a></li>
                                    <li><a href="#">Ramzaaan Plus Shawwal</a></li>
                                    <li><a href="#">RAMZAAN LAST 20 DAYS</a></li>
                                    <li><a href="#">Ramzaan Plus Shawwal </a></li>
                                    <li><a href="#">Ramzan First 20 Days</a></li>
                                    <li><a href="#">Shabaan Plus Ramzaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Ziyarat</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Baghdad + Karbala Kufa Najaf</a></li>
                                    <li><a href="#">Baghdad + Umrah</a></li>
                                    <li><a href="#">Jordan + Palestine</a></li>
                                    <li><a href="#">Jordan + Palestine + Egypt</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="" href="{{ route('hotels') }}">Hotels</a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="{{ Route('transport') }}">Transport</a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#">Catering</a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="{{ Route('ticket') }}">Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="" href="#">Visa</a><a href="javascript:void(0);"
                                    data-toggle="modal" data-target="#applyVisaModal" title="Apply E-Visa">Apply
                                    E-Visa</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Hajj Kit</a>
                                <ul class="sub-menu">
                                    <li><a href="#" title="Ehram &amp; Belt (Gents)">Ehram &amp; Belt
                                            (Gents)</a></li>
                                    <li><a href="#" title="Ehram &amp; Scraf (Ladies)">Ehram &amp; Scraf
                                            (Ladies)</a></li>
                                    <li><a href="#" title="Hajj Kit - Couple">Hajj Kit - Couple</a></li>
                                    <li><a href="#" title="Hajj Kit - Gents">Hajj Kit - Gents</a></li>
                                    <li><a href="#" title="Hajj Kit - Ladies">Hajj Kit - Ladies</a></li>
                                    <li><a href="#" title="Umrah Kit - Couple">Umrah Kit - Couple</a></li>
                                    <li><a href="#" title="Umrah Kit - Gents">Umrah Kit - Gents</a></li>
                                    <li><a href="#" title="Umrah Kit - Ladies ">Umrah Kit - Ladies </a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="drop-arrow">Services</a>
                                <ul class="sub-menu">
                                    <li><a href="#" title=" Book A Laundry"> Book A Laundry</a></li>
                                    <li><a href="#" title="Book a Forex">Book a Forex</a></li>
                                    <li><a href="#" title="Book My Assistant">Book My Assistant</a></li>
                                    <li><a href="#" title="Book my Guide">Book my Guide</a></li>
                                    <li><a href="#" title="Book My Insurance">Book My Insurance</a></li>
                                    <li><a href="#" title="Book my Ziarats">Book my Ziarats</a></li>
                                    <li><a href="#" title="Buy Saudi Sim Cards">Buy Saudi Sim Cards</a></li>
                                    <li><a href="#" title="">Must Buy Items</a></li>
                                </ul>
                            </li>
                            <button id="btn" style="color: rgb(35, 40, 44); font-weight: 600;" class="bFTLdA"
                                data-toggle="modal" data-target="#applyVisaModal">Apply E-Visa</button>
                        </ul>
                        <div class="hover-nav"><span></span></div>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </nav>
            <div class="modal fade" id="applyVisaModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="px-2 pt-2 text-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 512 512" height="25" width="25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body visamodal-body">
                            <div class="idwEoO">
                                <div class="oArUY active">1</div>
                                <div class="koQoDy activeline"></div>
                                <div class="oArUY">2</div>
                                <div class="koQoDy"></div>
                                <div class="oArUY">3</div>
                                <div class="koQoDy"></div>
                                <div class="oArUY">4</div>
                            </div>
                            <h4 class="fKPzfP">Apply E-Visa</h4>
                            <div class="visamodal-content" style="position: relative;">
                                <div class="dqkZBR" id="countrydropdown">
                                    <p class="gzOlds">What is your nationality?</p>
                                    <select id="countrySelect">
                                        <option value="" selected>Select a country</option>
                                        <option value="IN" data-icon="flag-icon flag-icon-in">India</option>
                                        <option value="AL" data-icon="flag-icon flag-icon-al">Albania</option>
                                        <option value="DZ" data-icon="flag-icon flag-icon-dz">Algeria</option>
                                        <option value="AS" data-icon="flag-icon flag-icon-as">American Samoa
                                        </option>
                                        <option value="AD" data-icon="flag-icon flag-icon-ad">Andorra</option>
                                        <option value="AO" data-icon="flag-icon flag-icon-ao">Angola</option>
                                        <option value="US" data-icon="flag-icon flag-icon-us">United States
                                        </option>
                                        <option value="CA" data-icon="flag-icon flag-icon-ca">Canada</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="klLqjz hide">
                                    <p class="gzOlds">Are you a US, UK or EU permanent residents or a US, UK or
                                        Schengen visa
                                        holder?</p>
                                    <div>
                                        <button class="eGDluE">
                                            <input type="radio" id="id-No" readonly="" name="visaholder"
                                                value="No">
                                            <span></span>
                                            <label for="id-No">No</label>
                                        </button>
                                        <button class="eGDluE">
                                            <input type="radio" id="id-Yes" readonly="" name="visaholder"
                                                value="Yes">
                                            <span></span>
                                            <label for="id-Yes">Yes</label>
                                        </button>
                                    </div>
                                </div>
                                <div class="dvDqDM hide">
                                    <p class="gzOlds">Are you a GCC resident?</p>
                                    <span>(GCC is a regional union comprising Bahrain, Kuwait, Oman, Qatar, Saudi
                                        Arabia, and
                                        the United Arab Emirates)</span>
                                    <div>
                                        <button class="eGDluE">
                                            <input type="radio" id="id-No" readonly="" name="resident"
                                                value="No">
                                            <span></span>
                                            <label for="id-No">No</label>
                                        </button>
                                        <button class="eGDluE">
                                            <input type="radio" id="id-Yes" readonly="" name="resident"
                                                value="Yes">
                                            <span></span>
                                            <label for="id-Yes">Yes</label>
                                        </button>
                                    </div>
                                </div>
                                <div id="nodiv" class="hide SATKy">
                                    <p class="gzOlds">You are eligible for:</p>
                                    <div class="fppvSN">
                                        <a href="#">
                                            <div class="text-center">
                                                <img alt="offices"
                                                    src="{{ asset('assets/user/svg/evisa/offices.svg') }}"
                                                    width="36px" height="36px" />
                                                <p class="gzOlds">Visa through our Offices</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div id="yesdiv" class="hide SATKy">
                                    <p class="gzOlds">You are eligible for:</p>
                                    <div class="fppvSN">
                                        <a href="#">
                                            <div class="text-center">
                                                <img alt="evisa"
                                                    src="{{ asset('assets/user/svg/evisa/visa-portal.svg') }}"
                                                    width="36px" height="36px" />
                                                <p class="gzOlds">eVisa Website</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="text-center">
                                                <img alt="package"
                                                    src="{{ asset('assets/user/svg/evisa/package.svg') }}"
                                                    width="36px" height="36px" />
                                                <p class="gzOlds">Visa through Package</p>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="text-center">
                                                <img alt="transit"
                                                    src="{{ asset('assets/user/svg/evisa/transit.svg') }}"
                                                    width="36px" height="36px" />
                                                <p class="gzOlds">Apply through Agent</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
