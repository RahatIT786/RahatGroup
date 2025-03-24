<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$agent->agency_name}} Agency</title>
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <link href="{{asset('agent-website/lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('agent-website/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <!-- Customized Bootstrap Stylesheet -->
        {{-- <link href="{{asset('agent-website/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
        <link href="{{asset('agent-website/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('agent-website/css/style.css')}}" rel="stylesheet">
        @livewireStyles
        @stack('extra_css')
        @vite([])

        <style>
            @keyframes jump {
                    0%, 100% {
                        transform: translateY(0);
                    }
                    50% {
                        transform: translateY(-10px); /* Moves the icon up by 10px */
                    }
                }

            #whatsapp{
                height: clamp(25px,30vw,5rem);
                z-index: 4;
                position: fixed;
                right: 10px;
                bottom:6rem;
                cursor: pointer;
                animation: jump 1.5s infinite ease-in-out;

            }
            #call{

                height: clamp(15px,8vw,3rem);
                z-index: 4;
                position: fixed;
                left: 1rem;
                bottom:7rem;
                cursor: pointer;
                animation: jump 1.5s infinite ease-in-out;
            }
        </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <div id="whatsapp">
            {{-- <a href="https://wa.me/+971567866713"> --}}
            <a href="https://api.whatsapp.com/send/?phone=%2B{{$agent->mobile}}&text={{urlencode('Hello, I want some details about package')}}&type=phone_number&app_absent=0">
                <img src="{{asset('agent-website/img/whatsapp.png')}}" alt="whats_app" style="height: 100%;">
            </a>
        </div>

        <div id="call">
            <a href="tel:{{$agent->mobile}}">
                <img src="{{asset('agent-website/img/call_logo.png')}}" alt="call_logo" style="height: 100%;">
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
                                <a href="tel:{{ $agent->mobile }}" class="text-secondary"><span>{{ $agent->mobile }}</span></a>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center">
                                <span class="far fa-envelope me-2 text-dark"></span>
                                <a href="mailto:{{ $agent->email }}" class="text-secondary"><span>{{ $agent->email }}</span></a>
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
                        <h1 class="mb-0">{{$agent->agency_name}}<span class="text-primary"></span> </h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
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
                                <img src="{{asset('agent-website/img/about-1.jpg')}}" class="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt="">
                            </div>
                            <div class="col-6">
                                <img src="{{asset('agent-website/img/about-2.jpg')}}img/about-2.jpg" class="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                                <img src="{{asset('agent-website/img/about-3.jpg')}}" class="img-fluid pt-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                        <p class="fs-5 text-uppercase text-primary">About Us</p>
                        <h1 class="display-5 pb-4 m-0">Welcome to {{$agent->agency_name}}</h1>
                        <p class="pb-4">Your trusted partner in organizing unforgettable Umrah pilgrimages. With a deep commitment to serving the spiritual needs of Muslims worldwide, we strive to make your journey to the holy cities of Mecca and Medina seamless and spiritually enriching.</p>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="ps-3 d-flex align-items-center justify-content-start">
                                    <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i class="fa fa-eye text-dark fa-4x mb-5 pb-2"></i></span>
                                    <div class="ms-4">
                                        <h5>Our Vision</h5>
                                        <ul>
                                            <li>To become the most trusted and respected Umrah agency globally.</li>
                                            <li>To be recognized for our commitment to excellence in every service we provide.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ps-3 d-flex align-items-center justify-content-start">
                                    <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i class="fa fa-flag text-dark fa-4x mb-5 pb-2"></i></span>
                                    <div class="ms-4">
                                        <h5>Our Mission</h5>
                                        <ul>
                                            <li>To provide reliable, affordable, and spiritually uplifting Umrah experiences.</li>
                                            <li>To ensure every pilgrim’s journey is seamless, comfortable, and deeply meaningful.</li>
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
                                <p class="mb-4">Exclusive Umrah pilgrim packages tailored for a seamless spiritual journey.</p>
                                {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                            <i class="fas fa-kaaba fa-4x text-dark"></i>
                            <div class="ms-4">
                                <h4>Hajj</h4>
                                <p class="mb-4">Complete Hajj travel and accommodation solutions for a seamless pilgrimage experience.</p>
                                {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                            <i class="fas fa-pray fa-4x text-dark"></i>
                            <div class="ms-4">
                                <h4>Ziyarat</h4>
                                <p class="mb-4">Efficiently organized visits to religious and historical sites for a seamless experience.</p>
                                {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                            <i class="fas fa-hotel fa-4x text-dark"></i>
                            <div class="ms-4">
                                <h4>Hotels</h4>
                                <p class="mb-4">Comfortable accommodations with a variety of options for a relaxing stay.</p>
                                {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                            <i class="fas fa-utensils fa-4x text-dark"></i>
                            <div class="ms-4">
                                <h4>Food & Catering</h4>
                                <p class="mb-4">Quality meals expertly crafted to meet your dietary preferences and needs.</p>
                                {{-- <a href="" class="btn btn-primary px-3">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                            <i class="fas fa-bus fa-4x text-dark"></i>
                            <div class="ms-4">
                                <h4>Transport</h4>
                                <p class="mb-4">Reliable and convenient travel arrangements for a stress-free journey.</p>
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
                padding: 2px !important;  /* Reduce cell padding */
                vertical-align: middle;  /* Align content properly */
            }

            /* Reduce space between price name and value */
            .price-label {
                margin-bottom: 1px; /* Less space below text */
                font-size: 13px;  /* Smaller text */
                font-weight: 600;
            }

            .price-value {
                margin-top: 0; /* Reduce space above price */
                font-size: 15px;
                font-weight: 700;

            }
        </style>

        <!-- Sermon Start -->
        <div class="container-fluid sermon py-5" id="package">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                    {{-- <p class="fs-5 text-uppercase text-primary">Sermons</p> --}}
                    <h1 class="display-3">Our Packages</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($packages as $package)
                        <div class="col-lg-6 col-xl-4">
                            <div class="sermon-item wow fadeIn" data-wow-delay="0.1s">
                                <div class="overflow-hidden p-4 pb-0">
                                    <a class="img-thumb" href="javascript:void(0);">
                                        @php
                                            $imageName = !empty($package->pkgImages[0]) ? $package->pkgImages[0]->pkg_img : '';
                                            $imagePath = !empty($imageName)
                                                ? 'package_image/' . $imageName
                                                : 'storage/dummy.jpg';

                                            $imageExists = !empty($imageName) && Helper::fileExists($imagePath);
                                        @endphp
                                        <img class="img-fluid" alt="Package Image"
                                            src="{{ $imageExists ? asset('storage/' . $imagePath) : asset('storage/dummy.jpg') }}" style="width: 380px; height: 280px;object-fit: cover;" />
                                    </a>
                                </div>
                                <div class="p-4">
                                    <a href="" class="d-inline-block h4 lh-sm mb-3">{{$package->name }}</a>
                                    <div class="price-list row text-center">
                                        <table class="table table-bordered table-hover text-center table-striped shadow-sm mt-3" style="border-color: #343a40;">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th>Package Type</th>
                                                    <th> Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if pkgDetails exists --}}
                                                @if($package->pkgDetails)
                                                    @foreach($package->pkgDetails as $pkgDetail)
                                                        <tr class="align-middle">
                                                            {{-- Package Type Display with Icons and Colors --}}
                                                            <td>
                                                                @switch($pkgDetail->pkg_type_id)
                                                                    @case(29)
                                                                        <span class="badge bg-primary px-3 py-2 rounded-pill">Super Saver</span>
                                                                        @break
                                                                    @case(6)
                                                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Gold</span>
                                                                        @break
                                                                    @case(8)
                                                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">Silver</span>
                                                                        @break
                                                                    @case(9)
                                                                        <span class="badge bg-success px-3 py-2 rounded-pill">Executive</span>
                                                                        @break
                                                                    @case(24)
                                                                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Esteem</span>
                                                                        @break
                                                                    @case(12)
                                                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Elite</span>
                                                                        @break
                                                                    @case(27)
                                                                        <span class="badge bg-dark px-3 py-2 rounded-pill">Bronze</span>
                                                                        @break
                                                                    @case(38)
                                                                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">Royal</span>
                                                                        @break
                                                                    @case(39)
                                                                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill">Classic</span>
                                                                        @break
                                                                    @default
                                                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">Standard</span>
                                                                @endswitch
                                                            </td>

                                                            {{-- G Share Price with Icons --}}
                                                            <td class="text-success fw-bold">
                                                                <i class="fa-solid fa-indian-rupee-sign me-1"></i>{{ number_format($pkgDetail->g_share) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                 <!-- Add Two Buttons Here -->
                                 <div class="d-flex justify-content-around align-items-center gap-2 mb-2">
                                    <a href="tel:{{$agent->mobile}}" class="btn btn-primary">Contact here</a>
                                    <a href="#" class="btn btn-secondary">View More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Sermon End -->


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
                            <form >
                                @csrf
                                <div class="mb-4">
                                    <input type="text" name="name" class="form-control p-3" placeholder="Your Name" required>
                                </div>
                                <div class="mb-4">
                                    <input type="email" name="email" class="form-control p-3" placeholder="Your Email" required>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="subject" class="form-control p-3" placeholder="Subject" required>
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
                            <p class="mb-4">Feel free to reach out to us for any inquiries or assistance. We're here to help!</p>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Address</h5>
                                    <p class="text-dark">{{$agent->city}}</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fas fa-phone-alt text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Phone</h5>
                                    <p class="text-dark">{{$agent->mobile}}</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Email</h5>
                                    <p class="text-dark">{{$agent->email}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fas fa-globe text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Website</h5>
                                    <p class="text-dark">rahatgroup.in/{{$agent->website_name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testiminial Start -->
        <div class="container-fluid testimonial py-5" >
            <div class="container py-5">
                <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                    <p class="fs-5 text-uppercase text-primary">Testimonial</p>
                    <h1 class="display-3">What People Say</h1>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                    <div class="testimonial-item">
                        <div class="d-flex mb-3">
                            <div class="position-relative">
                                <img src="{{asset('agent-website/img/testimonial-1.jpg')}}" class="img-fluid" alt="">
                                <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
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
                            <p class="fs-5 m-0 pt-3">{{$agent->agency_name}} Tour and Travels made my Hajj pilgrimage smooth and fulfilling with great guidance, comfortable accommodations, and seamless travel arrangements.</p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex mb-3">
                            <div class="position-relative">
                                <img src="{{asset('agent-website/img/testimonial-2.jpg')}}" class="img-fluid" alt="">
                                <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
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
                            <p class="fs-5 m-0 pt-3">{{$agent->agency_name}} Tour and Travels made my Umrah memorable with attentive staff, smooth arrangements, and a focus on worship. Highly recommended!</p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex mb-3">
                            <div class="position-relative">
                                <img src="{{asset('agent-website/img/test1.jpg')}}" class="img-fluid" alt="">
                                <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
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
                            <p class="fs-5 m-0 pt-3">{{$agent->agency_name}} Tour and Travels ensured a smooth Umrah experience with attentive, helpful staff, allowing me to focus on my worship.</p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="d-flex mb-3">
                            <div class="position-relative">
                                <img src="{{asset('agent-website/img/test2.jpg')}}" class="img-fluid" alt="">
                                <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
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
                            <p class="fs-5 m-0 pt-3">{{$agent->agency_name}} Tour and Travels made our Hajj experience memorable with great guidance, genuine care, and a focus on our comfort and safety.</p>
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
                                Welcome to {{$agent->agency_name }} Agency! We offer tailored travel experiences, from pilgrimages to vacations, ensuring seamless journeys and unforgettable memories.
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
                                    <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-map-marker-alt text-dark"></i></span>
                                    <a href="" class="text-body">{{ $agent->city }}</a>
                                </div>
                                <h6 class="text-secondary mt-4 mb-0">Our Mobile</h6>
                                <div class="d-flex align-items-center py-4">
                                    <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-phone-alt text-dark"></i></span>
                                    <a href="" class="text-body">{{ $agent->mobile }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item mt-5">
                            <h4 class="text-light mb-4">Explore Link</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="text-body mb-2" href="#home"><i class="fa fa-check text-primary me-2"></i>Home</a>
                                <a class="text-body mb-2" href="#about"><i class="fa fa-check text-primary me-2"></i>About Us</a>
                                <a class="text-body mb-2" href="#services"><i class="fa fa-check text-primary me-2"></i>Our Services</a>
                                <a class="text-body mb-2" href="#package"><i class="fa fa-check text-primary me-2"></i>Our Packages</a>
                                <a class="text-body mb-2" href="#contact"><i class="fa fa-check text-primary me-2"></i>Our Contact</a>
                                {{-- <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Our Events</a>
                                <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Donations</a>
                                <a class="text-body mb-2" href=""><i class="fa fa-check text-primary me-2"></i>Sermons</a> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item mt-5">
                            <h4 class="text-light mb-4">Latest Post</h4>
                            <div class="d-flex border-bottom border-secondary py-4">
                                <img src="{{asset('agent-website/img/blog-mini-1.jpg')}}" class="img-fluid flex-shrink-0" alt="">
                                <div class="ps-3">
                                    <p class="mb-0 text-muted">01 Jan 2045</p>
                                    <a href="" class="text-body">Lorem ipsum dolor sit amet elit eros vel</a>
                                </div>
                            </div>
                            <div class="d-flex py-4">
                                <img src="{{asset('agent-website/img/blog-mini-2.jpg')}}" class="img-fluid flex-shrink-0" alt="">
                                <div class="ps-3">
                                    <p class="mb-0 text-muted">01 Jan 2045</p>
                                    <a href="" class="text-body">Lorem ipsum dolor sit amet elit eros vel</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="container py-4">
                <div class="border-top border-secondary pb-4"></div>
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">{{$agent->agency_name}}</a>, All Right Reserved.
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
    <script src="{{asset('agent-website/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('agent-website/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('agent-website/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('agent-website/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('agent-website/js/main.js')}}"></script>
    @livewireScripts
    </body>

</html>
