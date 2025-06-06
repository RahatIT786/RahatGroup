@extends('user.layouts.app')

@section('content')
    <main class="cAJbgc" style="margin-top: 0px;">

        <div class="banner-section">
            <div class="tp-banner-container" style="overflow: visible;">
                <div class="tp-banner">
                    <ul>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                            <!-- MAIN IMAGE -->
                            <img src="/assets/user/images/1_Banner.jpeg" alt="$banner->banner_alter"
                                data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                            <div class="tp-caption sfb very_large_text" data-x="120" data-hoffset="0" data-y="center"
                                data-speed="800" data-start="900" data-easing="Power4.easeOut" data-endspeed="400"
                                data-endeasing="Power1.easeIn" data-captionhidden="off"
                                style="z-index: 22;line-height:1.4;font-size:4rem;font-family: Displace;white-space:normal;max-width:800px;">
                                 Banner Details 1 </div>
                        </li>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                            <!-- MAIN IMAGE -->
                            <img src="/assets/user/images/2_Banner.jpeg" alt="$banner->banner_alter"
                                data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                            <div class="tp-caption sfb very_large_text" data-x="120" data-hoffset="0" data-y="center"
                                data-speed="800" data-start="900" data-easing="Power4.easeOut" data-endspeed="400"
                                data-endeasing="Power1.easeIn" data-captionhidden="off"
                                style="z-index: 22;line-height:1.4;font-size:4rem;font-family: Displace;white-space:normal;max-width:800px;">
                                Banner Details 2 </div>
                        </li>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                            <!-- MAIN IMAGE -->
                            <img src="/assets/user/images/3_Banner.jpeg" alt="$banner->banner_alter"
                                data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                            <div class="tp-caption sfb very_large_text" data-x="120" data-hoffset="0" data-y="center"
                                data-speed="800" data-start="900" data-easing="Power4.easeOut" data-endspeed="400"
                                data-endeasing="Power1.easeIn" data-captionhidden="off"
                                style="z-index: 22;line-height:1.4;font-size:4rem;font-family: Displace;white-space:normal;max-width:800px;">
                                Banner Details 3 </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="cVoRcU">
            <div class="container content-container">
                <div class=" title-container">

                    <h3 class="bsjjxR">Start Planning Your Journey</h3>
                    <p font-weight="300" class="edHYQK">Everything you need to know to start planning your journey to Makkah
                        and Madina.</p>

                </div>
            </div>
            <div class="swiper-container--outer">
                <div class="swiper container swiper-journey">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <article class="gzRGXF"
                                style="background-image: url('http://127.0.0.1:8080/assets/user/images/Hajj-Slider-1.jpg');">
                                <h4 class="elbGxZ">Hajj</h4>
                                <div>
                                    <p class="iXSQvt gpysnH">Follow the simple steps to satisfy entry requirements to Saudi
                                        Arabia.</p>
                                    <div class="chjRwV">
                                        <a style="justify-content: space-between;"
                                            href="http://127.0.0.1:8080/hajj-packages">
                                            <span font-weight="500" font-style="normal" font-size="1rem" class="eklPbQ">
                                                <span>Learn More</span>
                                            </span>
                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                                stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="swiper-slide">
                            <article class="gzRGXF"
                                style="background-image: url('http://127.0.0.1:8080/assets/user/images/Umrah-Slider-1.jpg');">
                                <h4 class="elbGxZ">Umrah</h4>
                                <div>
                                    <p class="iXSQvt gpysnH">Follow the simple steps to satisfy entry requirements to Saudi
                                        Arabia.</p>
                                    <div class="chjRwV">
                                        <a style="justify-content: space-between;"
                                            href="http://127.0.0.1:8080/umrah-packages">
                                            <span font-weight="500" font-style="normal" font-size="1rem" class="eklPbQ">
                                                <span>Learn More</span>
                                            </span>
                                            <svg stroke="currentColor" fill="none" stroke-width="2"
                                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="swiper-slide">
                            <article class="gzRGXF"
                                style="background-image: url('http://127.0.0.1:8080/assets/user/images/Ramazan-Slider-1.jpg');">
                                <h4 class="elbGxZ">Ramzan</h4>
                                <div>
                                    <p class="iXSQvt gpysnH">Follow the simple steps to satisfy entry requirements to Saudi
                                        Arabia.</p>
                                    <div class="chjRwV">
                                        <a style="justify-content: space-between;"
                                            href="http://127.0.0.1:8080/ramzan-packages">
                                            <span font-weight="500" font-style="normal" font-size="1rem" class="eklPbQ">
                                                <span>Learn More</span>
                                            </span>
                                            <svg stroke="currentColor" fill="none" stroke-width="2"
                                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="swiper-slide">
                            <article class="gzRGXF"
                                style="background-image: url('http://127.0.0.1:8080/assets/user/images/Tour-Slider-1.jpg');
                            ">
                                <h4 class="elbGxZ">Tours</h4>
                                <div>
                                    <p class="iXSQvt gpysnH">Follow the simple steps to satisfy entry requirements to Saudi
                                        Arabia.</p>
                                    <div class="chjRwV">
                                        <a style="justify-content: space-between;"
                                            href="http://127.0.0.1:8080/tour-packages">
                                            <span font-weight="500" font-style="normal" font-size="1rem" class="eklPbQ">
                                                <span>Learn More</span>
                                            </span>
                                            <svg stroke="currentColor" fill="none" stroke-width="2"
                                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="swiper-scrollbar"></div>
                </div>
                <div class="swiper-navigation-buttons--container">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </section>
        <section class="eWDjAZ">
            <div class="container content-container">
                <h1 class="cIhsBF">About Rahat</h1>
                <h4 class="elbGxZ">Holistic Journey Platform</h4>
                <p class="iXSQvt">Use Rahat, the first-ever official planning, booking and experience platform, to
                    create your Hajj or Umrah itinerary to Makkah, Madina, and beyond. With Rahat, travelers from
                    all over the world can easily organize their entire visit, from applying for an eVisa to booking
                    hotels and flights. In the future, Rahat can also be used to schedule visits to important sites,
                    find transportation, curate itineraries, and access on-ground tools such as the Tawaf tracker
                    and more.</p>
            </div>
        </section>
        <section class="klzXdu">
            <h1 class="cIhsBF container">F.A.Q</h1>
            <div class="dHuQhi container">
                <div class="bPqodi" data-toggle="collapse" data-target="#faq1" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq1">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq2" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq2">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq3" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq3">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq4" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq4">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq5" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq5">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq6" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq6">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq7" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq7">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bPqodi" data-toggle="collapse" data-target="#faq8" aria-expanded="false">
                    <div style="position: relative;">
                        <div class="dSETMm">
                            <p font-weight="600" class="gqhIqu">Is it possible to move between the cities of the
                                Kingdom with the Umrah Visa?</p>
                            <button class="arrow-up"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></button>
                            <button class="arrow-down"><svg stroke="currentColor" fill="none" stroke-width="2"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="25"
                                    width="25" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></button>
                        </div>
                        <div class="hKhJTI collapse" id="faq8">
                            <p class="isiQyk">
                            <div class="kexixH">
                                <span>Yes, the Umrah Visa enables the mu’tamir to move between Makkah al-Mukarramah,
                                    Medina, and all the cities of the Kingdom during the period of permitted
                                    stay.</span>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
