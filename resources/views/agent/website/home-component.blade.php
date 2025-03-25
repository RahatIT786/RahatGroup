<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $agent->agency_name }} Agency</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('agent-website/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('agent-website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    {{-- <link href="{{asset('agent-website/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('agent-website/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('agent-website/css/style.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('extra_css')
    @vite([])

    <style>
        @keyframes jump {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
                /* Moves the icon up by 10px */
            }
        }

        #whatsapp {
            height: clamp(25px, 30vw, 5rem);
            z-index: 4;
            position: fixed;
            right: 10px;
            bottom: 6rem;
            cursor: pointer;
            animation: jump 1.5s infinite ease-in-out;

        }

        #call {

            height: clamp(15px, 8vw, 3rem);
            z-index: 4;
            position: fixed;
            left: 1rem;
            bottom: 7rem;
            cursor: pointer;
            animation: jump 1.5s infinite ease-in-out;
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <div id="whatsapp">
        {{-- <a href="https://wa.me/+971567866713"> --}}
        <a
            href="https://api.whatsapp.com/send/?phone=%2B{{ $agent->mobile }}&text={{ urlencode('Hello, I want some details about package') }}&type=phone_number&app_absent=0">
            <img src="{{ asset('agent-website/img/whatsapp.png') }}" alt="whats_app" style="height: 100%;">
        </a>
    </div>

    <div id="call">
        <a href="tel:{{ $agent->mobile }}">
            <img src="{{ asset('agent-website/img/call_logo.png') }}" alt="call_logo" style="height: 100%;">
        </a>
    </div>

    <!-- Topbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar d-none d-lg-block">
            <div class="topbar-inner">
                <div class="row gx-0">
                    <div class="col-lg-7 text-start">
                        <div class="h-100 d-inline-flex align-items-center me-4">
                            <span class="fa fa-phone-alt me-2 text-dark"></span>
                            <a href="tel:{{ $agent->mobile }}"
                                class="text-secondary"><span>{{ $agent->mobile }}</span></a>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center">
                            <span class="far fa-envelope me-2 text-dark"></span>
                            <a href="mailto:{{ $agent->email }}"
                                class="text-secondary"><span>{{ $agent->email }}</span></a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-end">
                        <div class="h-100 d-inline-flex align-items-center">
                            <span class="text-body">Follow Us:</span>
                            <a class="text-dark px-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-instagram"></i></a>
                            {{-- <a class="text-body ps-4" href=""><i class="fa fa-lock text-dark me-1"></i> Signup/login</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-3">
                <a href="index.html" class="navbar-brand">
                    <h1 class="mb-0">{{ $agent->agency_name }}<span class="text-primary"></span> </h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav ms-lg-auto mx-xl-auto">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#package" class="nav-item nav-link">Packages</a>
                        <a href="#services" class="nav-item nav-link">Services</a>
                        {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 rounded-0">
                                    <a href="blog.html" class="dropdown-item">Latest Blog</a>
                                    <a href="team.html" class="dropdown-item">Our Team</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div> --}}
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                    {{-- <a href="" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block">Donate</a> --}}
                </div>
            </nav>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Hero Start -->
    <div class="container-fluid hero-header" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <p class="fs-4 text-dark">WELCOME TO {{ strtoupper($agent->agency_name) }}</p>
                        <h1 class="display-1 mb-5 text-dark">Purity Comes From Faith</h1>
                        {{-- <a href="" class="btn btn-primary py-3 px-5">Read More</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Satrt -->
    <div class="container-fluid about py-5" id="about">
        <div class="container py-5">
            <div class="row g-5 mb-5">
                <div class="col-xl-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="{{ asset('agent-website/img/about-1.jpg') }}"
                                class="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt="">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('agent-website/img/about-2.jpg') }}img/about-2.jpg"
                                class="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                            <img src="{{ asset('agent-website/img/about-3.jpg') }}" class="img-fluid pt-3 wow zoomIn"
                                data-wow-delay="0.1s" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="fs-5 text-uppercase text-primary">About Us</p>
                    <h1 class="display-5 pb-4 m-0">Welcome to {{ $agent->agency_name }}</h1>
                    <p class="pb-4">Your trusted partner in organizing unforgettable Umrah pilgrimages. With a deep
                        commitment to serving the spiritual needs of Muslims worldwide, we strive to make your journey
                        to the holy cities of Mecca and Medina seamless and spiritually enriching.</p>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i
                                        class="fa fa-eye text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <h5>Our Vision</h5>
                                    <ul>
                                        <li>To become the most trusted and respected Umrah agency globally.</li>
                                        <li>To be recognized for our commitment to excellence in every service we
                                            provide.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i
                                        class="fa fa-flag text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <h5>Our Mission</h5>
                                    <ul>
                                        <li>To provide reliable, affordable, and spiritually uplifting Umrah
                                            experiences.</li>
                                        <li>To ensure every pilgrim’s journey is seamless, comfortable, and deeply
                                            meaningful.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-2">
                        <i class="fa fa-mosque fa-5x text-white"></i>
                    </div>
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="mb-0">Every Muslim Needs To Realise The Importance Of The "Pillar" Of Islam</h1>
                    </div>
                    <div class="col-lg-3">
                        <a href="" class="btn btn-light py-2 px-4">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Activities Start -->
    <div class="container-fluid activities py-5" id="services">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                {{-- <p class="fs-5 text-uppercase text-primary">Services</p> --}}
                <h1 class="display-3">Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-mosque fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Umrah</h4>
                            <p class="mb-4">Exclusive Umrah pilgrim packages tailored for a seamless spiritual
                                journey.</p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fas fa-kaaba fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Hajj</h4>
                            <p class="mb-4">Complete Hajj travel and accommodation solutions for a seamless
                                pilgrimage experience.</p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fas fa-pray fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Ziyarat</h4>
                            <p class="mb-4">Efficiently organized visits to religious and historical sites for a
                                seamless experience.</p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fas fa-hotel fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Hotels</h4>
                            <p class="mb-4">Comfortable accommodations with a variety of options for a relaxing stay.
                            </p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fas fa-utensils fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Food & Catering</h4>
                            <p class="mb-4">Quality meals expertly crafted to meet your dietary preferences and
                                needs.</p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fas fa-bus fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Transport</h4>
                            <p class="mb-4">Reliable and convenient travel arrangements for a stress-free journey.
                            </p>
                            {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Activities Start -->

    <style>
        .table-sm td {
            padding: 2px !important;
            /* Reduce cell padding */
            vertical-align: middle;
            /* Align content properly */
        }

        /* Reduce space between price name and value */
        .price-label {
            margin-bottom: 1px;
            /* Less space below text */
            font-size: 13px;
            /* Smaller text */
            font-weight: 600;
        }

        .price-value {
            margin-top: 0;
            /* Reduce space above price */
            font-size: 15px;
            font-weight: 700;

        }
    </style>

    <!-- Sermon Start -->
    <div class="container-fluid sermon py-5" id="package">
        @foreach ($packages as $i => $package)
            <div class="container-fluid p-4" style=" max-width: 75% !important">
                <div class="outer_box col-lg-12 p-4 col-md-12  shadow-lg rounded bg-white">
                    <h5 class="text-start text-primary fw-bold mb-0">
                        {{ $package->name }}
                    </h5>

                    <div class="row d-flex justify-content-center  mt-4 outer_box">
                        <!-- Image Section -->
                        <div
                            class="d-flex flex-column align-items-center justify-content-center col-lg-3 col-md-3  p-0 outer_box">
                            <div>
                                @php
                                    $imageName = !empty($package->pkgImages[0]) ? $package->pkgImages[0]->pkg_img : '';
                                    $imagePath = !empty($imageName)
                                        ? 'package_image/' . $imageName
                                        : 'storage/dummy.jpg';

                                    $imageExists = !empty($imageName) && Helper::fileExists($imagePath);
                                @endphp
                                <img src="{{ $imageExists ? asset('storage/' . $imagePath) : asset('storage/dummy.jpg') }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 100%; width: 100%; object-fit: cover; border-radius: 25px !important;">
                            </div>
                            {{-- <p style="" class="p-4">Package ID : 78935</p> --}}
                            {{-- <div class="text-center">
                                <a href="#" class="btn btn-dark w-100 fw-semibold">View Detailed Itinerary</a>
                            </div> --}}
                        </div>

                        <div class="col-lg-6 col-md-7 p-0 outer_box">
                            <div class="package-card p-0 border rounded shadow-sm bg-light">

                                <div>
                                    <ul class="nav nav-tabs d-flex justify-content-evenly"
                                        id="packageTabs{{ $i }}" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="price-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#price-{{ $i }}"
                                                role="tab" aria-controls="price-{{ $i }}"
                                                aria-selected="true">Price</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="hotels-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#hotels-{{ $i }}"
                                                role="tab" aria-controls="hotels-{{ $i }}"
                                                aria-selected="false">Hotels</a>
                                        </li>
                                        {{-- <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="flights-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#flights-{{ $i }}"
                                                role="tab" aria-controls="flights-{{ $i }}"
                                                aria-selected="false">Flights</a>
                                        </li> --}}
                                        {{-- <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="sightseeing-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#sightseeing-{{ $i }}"
                                                role="tab" aria-controls="sightseeing-{{ $i }}"
                                                aria-selected="false">Sightseeing</a>
                                        </li> --}}
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="inclusion-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#inclusion-{{ $i }}"
                                                role="tab" aria-controls="inclusion-{{ $i }}"
                                                aria-selected="false">Inclusion</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="exclusion-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#exclusion-{{ $i }}"
                                                role="tab" aria-controls="exclusion-{{ $i }}"
                                                aria-selected="false">Exclusion</a>
                                        </li>
                                        {{-- <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="dates-tab-{{ $i }}"
                                                data-bs-toggle="tab" href="#dates-{{ $i }}"
                                                role="tab" aria-controls="dates-{{ $i }}"
                                                aria-selected="false">Dates</a>
                                        </li> --}}
                                    </ul>
                                </div>

                                <!-- Tab Content -->
                                <div class="tab-content mt-3" id="packageTabsContent">

                                    <div class="tab-pane fade show active" id="price-{{ $i }}"
                                        role="tabpanel" aria-labelledby="price-tab-{{ $i }}">
                                        <div class="mt-3">
                                            <!-- Navigation Tabs for Package Types -->
                                            <ul class="nav nav-pills d-flex justify-content-start mb-3"
                                                id="packageFilterTabs" role="tablist">
                                                @foreach ($package->pkgDetails as $index => $pkgDetail)
                                                    <li class="nav-item" role="presentation">
                                                        @switch($pkgDetail->pkg_type_id)
                                                            @case(29)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="super-saver-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="super-saver"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Super Saver
                                                                </button>
                                                            @break

                                                            @case(6)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="gold-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="gold"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Gold
                                                                </button>
                                                            @break

                                                            @case(8)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="silver-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="silver"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Silver
                                                                </button>
                                                            @break

                                                            @case(9)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="executive-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="executive"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Executive
                                                                </button>
                                                            @break

                                                            @case(24)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="esteem-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="esteem"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Esteem
                                                                </button>
                                                            @break

                                                            @case(12)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="elite-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="elite"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Elite
                                                                </button>
                                                            @break

                                                            @case(27)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="bronze-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="bronze"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Bronze
                                                                </button>
                                                            @break

                                                            @case(38)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="royal-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="royal"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Royal
                                                                </button>
                                                            @break

                                                            @case(39)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                    id="classic-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#package-{{ $pkgDetail->id }}"
                                                                    type="button" role="tab" aria-controls="classic"
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Classic
                                                                </button>
                                                            @break

                                                            @default
                                                                <span
                                                                    class="badge bg-secondary px-3 py-2 rounded-pill">Standard</span>
                                                        @endswitch
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <!-- Tab Content for Packages -->
                                             <div class="tab-content" id="packageFilterTabsContent">
                                                @foreach ($package->pkgDetails as $index => $pkgDetail)
                                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                                        id="package-{{ $pkgDetail->id }}" role="tabpanel"
                                                        aria-labelledby="{{ strtolower($pkgDetail->pkgType->name ?? 'standard') }}-tab">

                                                        {{-- <h6 class="text-success fw-semibold my-3 mx-3">
                                                                @switch($pkgDetail->pkg_type_id)
                                                                    @case(29) Super Saver @break
                                                                    @case(6) Gold @break
                                                                    @case(8) Silver @break
                                                                    @case(9) Executive @break
                                                                    @case(24) Esteem @break
                                                                    @case(12) Elite @break
                                                                    @case(27) Bronze @break
                                                                    @case(38) Royal @break
                                                                    @case(39) Classic @break
                                                                    @default Standard
                                                                @endswitch
                                                            </h6> --}}

                                                        <table class="table table-bordered shadow-sm text-center">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Group
                                                                            Share</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->g_share) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Quad Share
                                                                        </p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->qt_share) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Triple
                                                                            Share</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->t_share) }}
                                                                        </h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Double
                                                                            Share</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->d_share) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Single
                                                                            Share</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->single) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Child with
                                                                            Bed</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->child_with_bed) }}
                                                                        </h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Child No
                                                                            Bed</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->chlid_no_bed) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Infant</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->infant) }}
                                                                        </h5>
                                                                    </td>
                                                                    <td class="bg-light p-0">
                                                                        <p class="mb-1 fw-bold text-primary">Senior
                                                                            Citizen</p>
                                                                        <h5 class="mb-0 text-success">
                                                                            ₹{{ number_format($pkgDetail->senior_citizen ?? 0) }}
                                                                        </h5>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Inclusions Section -->
                                        <div
                                            class="inclusions-section mt-4 d-flex justify-content-start align-items-center ">
                                            <h6 class="text-success fw-semibold mx-2">Inclusions</h4>
                                                <ul class="list-unstyled d-flex">
                                                    <li class="me-4">
                                                        <i class="bi bi-airplane-engines"
                                                            style="font-size: 24px;"></i>
                                                        <span>Flight</span>
                                                    </li>
                                                    <li class="me-4">
                                                        <i class="bi bi-house-door" style="font-size: 24px;"></i>
                                                        <span>Hotel</span>
                                                    </li>
                                                    <li class="me-4">
                                                        <i class="bi bi-egg" style="font-size: 24px;"></i>
                                                        <span>All Meals</span>
                                                    </li>
                                                </ul>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="hotels-{{ $i }}" role="tabpanel" aria-labelledby="hotels-tab-{{ $i }}">
                                        <div class="mt-3">
                                            <!-- Navigation Tabs for Package Types -->
                                            <ul class="nav nav-pills d-flex justify-content-start mb-3" id="hotelPackageTabs-{{ $i }}" role="tablist">
                                                @foreach ($package->pkgDetails->unique('pkg_type_id') as $index => $pkgDetail)
                                                    <li class="nav-item" role="presentation">
                                                        @switch($pkgDetail->pkg_type_id)
                                                            @case(29)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="super-saver-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#super-saver-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="super-saver-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Super Saver
                                                                </button>
                                                            @break

                                                            @case(6)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="gold-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#gold-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="gold-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Gold
                                                                </button>
                                                            @break

                                                            @case(8)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="silver-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#silver-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="silver-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Silver
                                                                </button>
                                                            @break

                                                            @case(9)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="executive-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#executive-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="executive-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Executive
                                                                </button>
                                                            @break

                                                            @case(24)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="esteem-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#esteem-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="esteem-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Esteem
                                                                </button>
                                                            @break

                                                            @case(12)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="elite-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#elite-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="elite-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Elite
                                                                </button>
                                                            @break

                                                            @case(27)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="bronze-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#bronze-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="bronze-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Bronze
                                                                </button>
                                                            @break

                                                            @case(38)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="royal-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#royal-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="royal-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Royal
                                                                </button>
                                                            @break

                                                            @case(39)
                                                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                                        id="classic-hotel-tab-{{ $i }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#classic-hotel-{{ $i }}"
                                                                        type="button" role="tab"
                                                                        aria-controls="classic-hotel"
                                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                    Classic
                                                                </button>
                                                            @break

                                                            @default
                                                                <span class="badge bg-secondary px-3 py-2 rounded-pill">Standard</span>
                                                        @endswitch
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <!-- Tab Content for Hotels by Package Type -->
                                            <div class="tab-content" id="hotelPackageTabsContent-{{ $i }}">
                                                @foreach ($package->pkgDetails->unique('pkg_type_id') as $index => $pkgDetail)
                                                    @php
                                                        // Get all package details of this type
                                                        $typeDetails = $package->pkgDetails->where('pkg_type_id', $pkgDetail->pkg_type_id);
                                                        // Determine tab ID based on package type
                                                        $tabId = match($pkgDetail->pkg_type_id) {
                                                            29 => 'super-saver-hotel-' . $i,
                                                            6 => 'gold-hotel-' . $i,
                                                            8 => 'silver-hotel-' . $i,
                                                            9 => 'executive-hotel-' . $i,
                                                            24 => 'esteem-hotel-' . $i,
                                                            12 => 'elite-hotel-' . $i,
                                                            27 => 'bronze-hotel-' . $i,
                                                            38 => 'royal-hotel-' . $i,
                                                            39 => 'classic-hotel-' . $i,
                                                            default => 'standard-hotel-' . $i
                                                        };
                                                    @endphp

                                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                                         id="{{ $tabId }}"
                                                         role="tabpanel"
                                                         aria-labelledby="{{ str_replace('-hotel-', '-hotel-tab-', $tabId) }}">

                                                        {{-- <h6 class="text-success fw-semibold my-3">
                                                            @switch($pkgDetail->pkg_type_id)
                                                                @case(29) Super Saver @break
                                                                @case(6) Gold @break
                                                                @case(8) Silver @break
                                                                @case(9) Executive @break
                                                                @case(24) Esteem @break
                                                                @case(12) Elite @break
                                                                @case(27) Bronze @break
                                                                @case(38) Royal @break
                                                                @case(39) Classic @break
                                                                @default Standard
                                                            @endswitch
                                                            Hotels
                                                        </h6> --}}

                                                        @foreach($typeDetails as $detail)
                                                            <table class="table table-bordered table-striped shadow-sm mb-4">
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <th>Location</th>
                                                                        <th>Hotel Name</th>
                                                                        {{-- <th>Nights</th> --}}
                                                                        <th>Rating</th>
                                                                        <th>Distance from Haram</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if($detail->makkahotel)
                                                                    <tr>
                                                                        <td>Makkah</td>
                                                                        <td>{{ $detail->makkahotel->hotel_name }}</td>
                                                                        {{-- <td>{{ $detail->makka_nights }} Nights</td> --}}
                                                                        <td>
                                                                            {{$detail->makkahotel->star_rating}}
                                                                            {{-- @for($j = 0; $j < ($detail->makkahotel->star_rating ?? 0); $j++)
                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                            @endfor --}}
                                                                        </td>
                                                                        <td>{{ $detail->makkahotel->distance ?? 'N/A' }} m</td>
                                                                    </tr>
                                                                    @endif

                                                                    @if($detail->madinahotel)
                                                                    <tr>
                                                                        <td>Madinah</td>
                                                                        <td>{{ $detail->madinahotel->hotel_name }}</td>
                                                                        {{-- <td>{{ $detail->madina_nights }} Nights</td> --}}
                                                                        <td>
                                                                            {{$detail->madinahotel->star_rating}}
                                                                            {{-- @for($j = 0; $j < ($detail->madinahotel->star_rating ?? 0); $j++)
                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                            @endfor --}}
                                                                        </td>
                                                                        <td>{{ $detail->madinahotel->distance ?? 'N/A' }} m</td>
                                                                    </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Flights Tab -->
                                    {{-- <div class="tab-pane fade" id="flights-{{ $i }}" role="tabpanel"
                                        aria-labelledby="flights-tab-{{ $i }}">
                                        <div class="flights-section mb-3">
                                            <h6>Onward Flight included in the package</h6>
                                            <table class="table  table-sm" align="center">
                                                <tr>

                                                    <td rowspan="2" width="10%"
                                                        class="text-center align-middle">
                                                        <img src="{{ asset('./asserts/user/img/jabl-e-rehmat.jpg') }}"
                                                            style="height:50px;width:50px" alt="Airline Logo"
                                                            class="img-fluid rounded-circle"
                                                            style="max-width: 100px;">
                                                    </td>


                                                    <td width="20%" class="font-weight-bold text-center">Saudi
                                                        Arabian Airlines</td>


                                                    <td width="20%"></td>


                                                    <td width="20%" class="text-center"
                                                        style="vertical-align: middle; position: relative;">
                                                        5 Hours
                                                        <span class="arrow"></span>
                                                    </td>


                                                    <td></td>
                                                </tr>
                                                <tr>

                                                    <td width="20%" class="text-center">SV-759</td>


                                                    <td width="20%" class="text-center">20:05:00</td>


                                                    <td width="20%"></td>


                                                    <td width="20%">23:05:00</td>
                                                </tr>
                                            </table>


                                        </div>
                                    </div> --}}

                                    <!-- Sightseeing Tab -->
                                    {{-- <div class="tab-pane fade" id="sightseeing-{{ $i }}" role="tabpanel"
                                        aria-labelledby="sightseeing-tab-{{ $i }}">
                                        <div class="sightseeing-section mb-3">
                                            <div class="activities">
                                                <p class="title">Activities / Sightseeing</p>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td width="20%" class="day text-center align-middle">Day 1
                                                        </td>
                                                        <td class="locations text-start">
                                                            Arafat, Jabl E Rehmat, Jabl E Sour, Jable E Noor, Jamaraat,
                                                            Jannat Ul Muallah, Masjid Al-Jinn, Masjid Al-Khaif, Masjid
                                                            al-Mashar al-Haram, Masjid Fatah, Masjid Jurana, Masjid
                                                            Nimrah, Masjid Shajarah, Mina, Muzdalifa, Ghazwa-e-Khandaq
                                                            (Masjid E Sabaa ), Jabl E Uhud, Jannatul Baqi, Masijd Ali,
                                                            Masjid Al-Ghamamah, Masjid E Jumma, Masjid E Qiblatain,
                                                            Masjid E Quba, Masjid E Umar, Masjid E Usman, Masjid Ijaaba,
                                                            Shuhada Uhud
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Inclusion Tab -->
                                    <div class="tab-pane fade" id="inclusion-{{ $i }}" role="tabpanel"
                                        aria-labelledby="inclusion-tab-{{ $i }}">
                                        <div class="inclusion-section mb-3">
                                            <div class="inclusions" style="max-height: 300px; overflow-y: auto;">
                                                <h4>Inclusions</h4>
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-check-circle text-success"></i> Return Air
                                                        Tickets.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Umrah Visa with
                                                        Insurance.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Hotel Stay in
                                                        Makkah & Madinah.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Food: Indian
                                                        Set Menu (3 Meals).</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Ziarats in
                                                        Makkah & Madinah.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Round Trip
                                                        Transfers.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Complimentary
                                                        items provided by the Tour operator (Not for bookings without
                                                        bed).</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Saudi Simcard.
                                                    </li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Laundry (2
                                                        times in Makkah and 2 times in Madinah).</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Zamzam.</li>
                                                    <li><i class="bi bi-check-circle text-success"></i> Internal
                                                        Transportation by bus in Groups.</li>
                                                </ul>
                                                <p><strong>Note:</strong> Travel Bags, Laundry, Sim Cards, Zamzam are
                                                    Complimentary items given as Free Gifts by the Tour operator.
                                                    Laundry (2 times in Makkah and 2 times in Madinah) will be provided
                                                    Complimentary by the Tour Operator.</p>
                                            </div>


                                        </div>
                                    </div>

                                    <!-- Exclusion Tab -->
                                    <div class="tab-pane fade" id="exclusion-{{ $i }}" role="tabpanel"
                                        aria-labelledby="exclusion-tab-{{ $i }}">
                                        <div class="exclusion-section mb-3">
                                            <div class="exclusions">
                                                <h4>Exclusions</h4>
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-x-circle text-danger"></i> GST & TCS.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Private & Personal
                                                        Transfers.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Room Service.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Anything not
                                                        Mentioned in Inclusions.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Bucket and Tubs will
                                                        not be available in hotels.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> No Fans are
                                                        available in Rooms, only AC.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Indian Toilets are
                                                        not available, only English Toilets.</li>
                                                    <li><i class="bi bi-x-circle text-danger"></i> Water is available
                                                        only on Buffet, not in Rooms.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dates Tab -->
                                    {{-- <div class="tab-pane fade" id="dates-{{ $i }}" role="tabpanel"
                                        aria-labelledby="dates-tab-{{ $i }}">
                                        <div class="dates-section mb-3">
                                            <h4 class="text-success fw-semibold">Departure Dates</h4>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 ">
                            <div class="py-1">
                                <label for="stateSelect" class="form-label">Departure City:</label>
                                <select id="stateSelect" class="form-select">
                                    <option value="" selected disabled>Choose a Departure City</option>
                                    <option value="delhi">Delhi</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="uttar-pradesh">Uttar Pradesh</option>
                                </select>
                            </div>
                            <div class="py-1">
                                <label for="packageSelect" class="form-label">Select Package:</label>
                                <select id="packageSelect" class="form-select">
                                    <option value="" selected disabled>Choose a package</option>
                                    <option value="super-saver">Super Saver</option>
                                    <option value="gold">Gold</option>
                                    <option value="bronze">Bronze</option>
                                </select>
                            </div>
                            <div class="text-center py-3">
                                <h6>Starting From</h6>
                                <h4>INR 29,146</h4>
                                {{-- <p>Hexa Sharing</p> --}}
                            </div>
                            {{-- <div class="text-center mt-3">
                                <a href="#" class="btn btn-dark w-100 fw-semibold">Get Quote</a>
                            </div> --}}
                            {{-- <div class="text-center mt-3">
                                <a href="#" class="btn btn-dark w-100 fw-semibold">Enquire</a>
                            </div> --}}
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-dark w-100 fw-semibold" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Sermon End -->


    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Submit Your Enquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Standard Laravel Form -->
                    <form action="{{ route('agent.submit.enquiry') }}" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Mobile Number Field -->
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" pattern="[0-9]{10}" required>
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Message Box -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="container-fluid contact py-5" id="contact">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Contact Us</p>
                <h1 class="display-3">Get In Touch</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-light p-5 h-100">
                        <h2 class="mb-4">Send Us a Message</h2>
                        <form>
                            @csrf
                            <div class="mb-4">
                                <input type="text" name="name" class="form-control p-3"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" name="email" class="form-control p-3"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="mb-4">
                                <input type="text" name="subject" class="form-control p-3" placeholder="Subject"
                                    required>
                            </div>
                            <div class="mb-4">
                                <textarea name="message" class="form-control p-3" rows="6" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-light p-5 h-100">
                        <h2 class="mb-4">Contact Information</h2>
                        <p class="mb-4">Feel free to reach out to us for any inquiries or assistance. We're here to
                            help!</p>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Address</h5>
                                <p class="text-dark">{{ $agent->city }}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fas fa-phone-alt text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Phone</h5>
                                <p class="text-dark">{{ $agent->mobile }}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Email</h5>
                                <p class="text-dark">{{ $agent->email }}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                <i class="fas fa-globe text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Website</h5>
                                <p class="text-dark">rahatgroup.in/{{ $agent->website_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testiminial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Testimonial</p>
                <h1 class="display-3">What People Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="{{ asset('agent-website/img/testimonial-1.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute"
                                style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Mohammed Iqbal</h5>
                            <p class="m-0">Saudi Arabia</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">{{ $agent->agency_name }} Tour and Travels made my Hajj pilgrimage
                            smooth and fulfilling with great guidance, comfortable accommodations, and seamless travel
                            arrangements.</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="{{ asset('agent-website/img/testimonial-2.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute"
                                style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Farah Khan</h5>
                            <p class="m-0">Mumbai</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">{{ $agent->agency_name }} Tour and Travels made my Umrah memorable
                            with attentive staff, smooth arrangements, and a focus on worship. Highly recommended!</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="{{ asset('agent-website/img/test1.jpg') }}" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute"
                                style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Akhtar</h5>
                            <p class="m-0">Mumbai</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">{{ $agent->agency_name }} Tour and Travels ensured a smooth Umrah
                            experience with attentive, helpful staff, allowing me to focus on my worship.</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="{{ asset('agent-website/img/test2.jpg') }}" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute"
                                style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">Bhilal</h5>
                            <p class="m-0">Mumbai</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">{{ $agent->agency_name }} Tour and Travels made our Hajj experience
                            memorable with great guidance, genuine care, and a focus on our comfort and safety.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testiminial End -->


    <!-- Footer Start -->
    <div class="container-fluid footer pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-4 footer-inner">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item mt-5">
                        <h4 class="text-light mb-4"><span class="text-primary">{{ $agent->agency_name }}</span></h4>
                        <p class="mb-4 text-secondary">
                            Welcome to {{ $agent->agency_name }} Agency! We offer tailored travel experiences, from
                            pilgrimages to vacations, ensuring seamless journeys and unforgettable memories.
                        </p>
                        {{-- <a href="" class="btn btn-primary py-2 px-4">Donate Now</a> --}}
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item mt-5">
                        {{-- <h4 class="text-light mb-4">Our Mosque</h4> --}}
                        <div class="d-flex flex-column">
                            <h6 class="text-secondary mb-0">Our Address</h6>
                            <div class="d-flex align-items-center border-bottom py-4">
                                <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i
                                        class="fa fa-map-marker-alt text-dark"></i></span>
                                <a href="" class="text-body">{{ $agent->city }}</a>
                            </div>
                            <h6 class="text-secondary mt-4 mb-0">Our Mobile</h6>
                            <div class="d-flex align-items-center py-4">
                                <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i
                                        class="fa fa-phone-alt text-dark"></i></span>
                                <a href="" class="text-body">{{ $agent->mobile }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item mt-5">
                        <h4 class="text-light mb-4">Explore Link</h4>
                        <div class="d-flex flex-column align-items-start">
                            <a class="text-body mb-2" href="#home"><i
                                    class="fa fa-check text-primary me-2"></i>Home</a>
                            <a class="text-body mb-2" href="#about"><i
                                    class="fa fa-check text-primary me-2"></i>About Us</a>
                            <a class="text-body mb-2" href="#services"><i
                                    class="fa fa-check text-primary me-2"></i>Our Services</a>
                            <a class="text-body mb-2" href="#package"><i
                                    class="fa fa-check text-primary me-2"></i>Our Packages</a>
                            <a class="text-body mb-2" href="#contact"><i
                                    class="fa fa-check text-primary me-2"></i>Our Contact</a>
                            {{-- <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Our Events</a>
                                <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Donations</a>
                                <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Sermons</a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container py-4">
            <div class="border-top border-secondary pb-4"></div>
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{ $agent->agency_name }}</a>, All Right
                    Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://rahatitsolutions.com/">Rahat IT Solutions</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('agent-website/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('agent-website/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('agent-website/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('agent-website/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('agent-website/js/main.js') }}"></script>
    @livewireScripts
</body>

</html>
