<div>
    @livewire('user-front.packages-filter-component')

     {{-- <section class="section services-section">
        <div class="container">
            <div class="section-title text-center pb-0">
                <h2 class="title">Our Services</h2>
            </div>
            <div class="services">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ Route('customer.foodMenu') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/catering.png') }}" alt="catering" />
                            <h6>Catering</h6>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ Route('customer.ticket') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/tickets.png') }}" alt="tickets" />
                            <h6>Tickets (Pnrs)</h6>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ Route('customer.transport') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/transfers.png') }}" alt="transfers" />
                            <h6>Transfers</h6>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ Route('customer.laundry') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/laundries.png') }}" alt="laundries" />
                            <h6>Laundries</h6>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ route('customer.bookMyAssistant') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/assistant.png') }}" alt="assistant" />
                            <h6>Book My Assistant</h6>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        <a href="{{ Route('customer.Shopping') }}" class="service-box">
                            <img src="{{ asset('assets/user-front/images/shopping.png') }}" alt="shopping" />
                            <h6>Shopping</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- style added by karthi --}}
    <style>
.service-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 250px;  /* Set fixed width */
    height: 300px; /* Set fixed height */
    border: 1px solid #ddd;
    padding: 20px;
    transition: all 0.3s ease-in-out;
    text-decoration: none;
    background: white;
}

.service-item:hover {
    transform: translateY(-5px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    background: #FFA600;
}

.service-icon {
    width: 80px;   /* Fixed size for the icon container */
    height: 80px;
    margin-bottom: 10px;
}

.service-icon i {
    font-size: 40px; /* Icon size */
    /* color: #007bff; */
    color: #FFA600;
}
/* Change icon and heading color when hovering */
.service-item:hover .service-icon i,
.service-item:hover h5 {
    color: white !important; /* Change color to white */
}
h5 {
    font-size: 18px;
}

p {
    font-size: 14px;
}

    </style>
    {{-- style added by karthi --}}

    <section>
        <div class="container-xxl py-5" id="service">
                    <div class="container">
                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                            <!-- <h6 class="section-title text-center text-primary text-uppercase">Our Services</h6> -->
                            <h2 class="title mb-5">Our Services</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" href="{{ Route('customer.umrahPackage') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-mosque fa-2x  "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Umrah</h5>
                                    <p class="text-body mb-0">Specialized packages for Umrah pilgrims.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 my-3 wow fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" href="{{ Route('customer.hajjPackage') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-place-of-worship fa-2x  "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Hajj</h5>
                                    <p class="text-body mb-0">Comprehensive Hajj travel and accommodation solutions.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 my-3 wow fadeInUp" data-wow-delay="0.5s">
                                <a class="service-item rounded" href="{{ Route('customer.ziyaratPackages') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-person-praying fa-2x"></i>
                                        </div>

                                    </div>
                                    <h5 class="mb-3">Ziyarat</h5>
                                    <p class="text-body mb-0">Organized visits to religious and historical sites. </p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 my-3 wow fadeInUp" data-wow-delay="0.1s">
                                <a class="service-item rounded" href="{{ Route('customer.hotels') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa fa-hotel fa-2x "></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Hotels & Rooms</h5>
                                    <p class="text-body mb-0">Comfortable accommodations with various options</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.2s">
                                <a class="service-item rounded" href="{{ Route('customer.foodMenu') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa fa-utensils fa-2x "></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Food & Catering</h5>
                                    <p class="text-body mb-0">Quality meals tailored to dietary needs.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.3s">
                                <a class="service-item rounded" href="{{ Route('customer.transport') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-bus fa-2x"></i>

                                        </div>
                                    </div>
                                    <h5 class="mb-3">Transportation</h5>
                                    <p class="text-body mb-0">Reliable and convenient travel arrangements.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.4s">
                                <a class="service-item rounded" >
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-file-shield fa-2x"></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Visa & Insurance </h5>
                                    <p class="text-body mb-0"> Hassle-free visa processing and comprehensive insurance.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.5s">
                                <a class="service-item rounded" >
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-tent-arrow-left-right fa-2x "></i>

                                        </div>

                                    </div>
                                    <h5 class="mb-3">SightSeeing</h5>
                                    <p class="text-body mb-0">Guided tours to explore key attractions. </p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" href="{{ Route('customer.laundry') }}">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-shirt fa-2x "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Complimentary Laundary</h5>
                                    <p class="text-body mb-0"> Free laundry services for convenience.</p>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" href="https://rahatitsolutions.com/" target="_blank">
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">

                                            <i class="fa-solid fa-laptop-code fa-2x "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Software</h5>
                                    <p class="text-body mb-0">Advanced tools for seamless booking and management.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" >
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">

                                            <i class="fa-solid fa-coins fa-2x "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Forex</h5>
                                    <p class="text-body mb-0">Currency exchange services for travelers.</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 wow my-3 fadeInUp" data-wow-delay="0.6s">
                                <a class="service-item rounded" >
                                    <div class="service-icon bg-transparent border rounded p-1">
                                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">

                                            <i class="fa-solid fa-handshake fa-2x "></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-3">Partner with us</h5>
                                    <p class="text-body mb-0">Collaboration opportunities for businesses.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @livewire('user-front.components.popular-packages-component')

    <section class="section testimonial-section">
        <div class="container">
            <div class="section-title text-center pb-0">
                <h2 class="title text-white">Testimonials</h2>
            </div>
            <div class="testimonial-slider">
                @foreach ($testimonials as $testimonial)
                    <div class="item">
                        <div class="testimonial-box">
                            <div class="testimonial-img">
                                <img src="{{ asset('storage/cust_testimonial_image/' . $testimonial->image) }}"
                                    alt="{{ $testimonial->name }}" loading="lazy" />
                            </div>
                            <h5 class="testimonial-author">{{ $testimonial->name }}</h5>
                            <h5 class="testimonial-city">{{ $testimonial->city_name }}</h5>
                            <div class="testimonial-caption">
                                <p>{!! $testimonial->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- @livewire('user-front.newsletter-component') --}}
    {{-- <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7 mb-5 mb-lg-0">
                    <div class="appstore-box">
                        <div class="section-title">
                            <h2 class="title mb-4">Make your Umrah Enhance your spiritual experience with HUO App</h2>
                            <p>Best travel deals on the go - only on HUO mobile!</p>
                        </div>
                        <h6 class="mb-0">Get the App</h6>
                        <div class="d-flex align-items-center flex-wrap">
                            <a class="d-inline-flex my-2 mr-2" href="#" title="Play Store">
                                <img src="{{ asset('assets/user-front/images/googleplay.png') }}" alt="googleplay"
                                    width="122px" height="40px">
                            </a>
                            <a class="d-inline-flex my-2" href="#" title="App Store">
                                <img src="{{ asset('assets/user-front/images/appstore.png') }}" alt="appstore"
                                    width="122px" height="40px">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 text-center">
                    <img src="{{ asset('assets/user-front/images/android-phone.png') }}" alt="android-phone" />
                </div>
            </div>
        </div>
    </section> --}}
    <section class="section partners-section">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title mb-4">Our Partner</h2>
            </div>

            <div class="row justify-content-center">
                @foreach ($partners as $partner)
                    <div class="col-6 col-sm-4 col-md-auto">
                        <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer">
                            <div class="partner-logo">
                                <img src="{{ asset('storage/partner_image/' . $partner->image) }}"
                                    alt="{{ $partner->name }}" loading="lazy" />
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section searchby-section">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By Month</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                <li><a href="#">Umrah in January 2024</a></li>
                                <li><a href="#">Umrah in February 2024</a></li>
                                <li><a href="#">Umrah in March 2024</a></li>
                                <li><a href="#">Umrah in April 2024</a></li>
                                <li><a href="#">Umrah in May 2025</a></li>
                                <li><a href="#">Umrah in June 2025</a></li>
                                <li><a href="#">Umrah in July 2026</a></li>
                                <li><a href="#">Umrah in August 2027</a></li>
                                <li><a href="#">Umrah in September 2024</a></li>
                                <li><a href="#">Umrah in October 2024</a></li>
                                <li><a href="#">Umrah in November 2024</a></li>
                                <li><a href="#">Umrah in December 2024</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By Month</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @foreach ($months as $month_id => $month)
                                    <li>
                                        <a href="#">Umrah in {{ $month['month'] }} {{ $month['year'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By Month</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @foreach ($months as $month_id => $month)
                                    <li>
                                        <a href="{{ route('customer.umrahPackage', ['month' => $month_id]) }}">
                                            Umrah in {{ $month['month'] }} {{ $month['year'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>





                {{-- <div class="col-md-4">
                    <select class="form-control" wire:model="month">
                        <option value="">{{ __('tablevars.select') }}
                            {{ __('tablevars.month') }}</option>
                        @for ($month = 1; $month <= 12; $month++)
                            <option value="{{ $month }}">
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                        @endfor
                    </select>
                    @error('month')
                        <span class="v-msg">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By City</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @foreach ($departureCities as $city)
                                    <div>
                                        @if ($city->city)
                                            <a
                                                href="{{ route('customer.umrahPackage', ['id' => $city->dept_city_id]) }}">Umrah
                                                From {{ $city->city->city_name }}</a>
                                        @endif
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By City</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @foreach ($departureCities as $city)
                                    @if ($city->city)
                                        <div>
                                            @foreach ($this->getPackagesForCity($city->dept_city_id) as $package)
                                                <a style="pointer-events: auto;"
                                                    href="{{ route('customer.umrahPackage', ['id' => $city->dept_city_id]) }}">
                                                    Umrah From {{ $city->city->city_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By Umrah Package</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @if ($packages->isEmpty())
                                    <p>No active packages available with the selected service and Umrah type.</p>
                                @else
                                    @foreach ($packages as $package)
                                        <div>
                                            <a
                                                href="{{ route('customer.umrahPackageView', ['id' => $package->id , 'type' => 29]) }}">{{ $package->name }}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="searchby-box">
                        <h5 class="searchby-title">Search By Hotel Type</h5>
                        <div class="scrollcontent">
                            <ul class="searchby-list">
                                @foreach ($hotels as $hotel)
                                    <div>
                                        <a
                                            href="{{ route('customer.hotel-detail', ['id' => $hotel->id]) }}">{{ $hotel->hotel_name }}{{ $hotel->star_rating }}</a>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- script added by karthi --}}

                <!-- jQuery (required for WOW.js) -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                <!-- WOW.js for animations -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
                <script>
                 new WOW().init();
                </script>
                {{-- script added by karthi --}}

            </div>
        </div>
    </section>

</div>
