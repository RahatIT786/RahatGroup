<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
            <h1>Food Menu</h1>
        </div>
    </section>
    <section class="detail-sec detail-secbox">
        <div class="container">
            <div>
                @if ($food)
                    <div class="row">
                        <div class="col-md-12">
                            <div id="MainContent_divInfo" class="row" style="display: none">
                                <div class="col-sm-12">
                                    <div class="alert alert-info">
                                        No Record found.
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" style="color: black;">
                                <div class="col-md-7">
                                    <h4>
                                        <span id="MainContent_lblAwardTitle">{{ $food->food_type }}
                                            <strong>-&#xFDFC;</strong>
                                            {{ number_format($food->price, 2) }}</span>
                                    </h4>
                                </div>
                                {{-- <div class="col-md-3 text-right">
                                    <a  href="{{ asset('storage/food_pdf/' . $food->food_pdf) }}"
                                        class="default-btn btn btn-block py-2 px-2"
                                        data-title="Deluxe Long Shifting Hajj 40 Days"
                                        class="estimate-btn sendRateEnuiryPackagetour"
                                        href="javascript:void(0);" >Download PDF <i class="fa fa-file-pdf-o"
                                        style="font-size: 16px; color: white;"></i></a>

                                </div> --}}

                                <div class="col-md-3 text-right">
                                    @if($food->food_pdf !='')
                                        <a  style="max-width:150px"id="estinamtebtnid" href="{{ asset('storage/food_pdf/' . $food->food_pdf) }}"
                                            class="default-btn btn btn-block py-2 px-2"
                                            data-title="Deluxe Long Shifting Hajj 40 Days" data-id="28"
                                            data-target="#foodModal" class="estimate-btn sendRateEnuiryPackagetour"
                                            href="javascript:void(0);">Download PDF <i class="fa fa-file-pdf-o"
                                            style="font-size: 16px; color: red;"></i></a>
                                    @endif
                                </div>

                              
                                <div class="col-md-2 text-right">
                                    <a id="estinamtebtnid" data-toggle="modal"
                                        class="default-btn btn btn-block py-2 px-2"
                                        data-title="Deluxe Long Shifting Hajj 40 Days" data-id="28"
                                        data-target="#foodModal" class="estimate-btn sendRateEnuiryPackagetour"
                                        href="javascript:void(0);">Enquiry</a>

                                </div>
                                {{-- <h6>
                                    <span id="MainContent_lblAwardTitle">{{ $food->price }}</span>
                                </h6> --}}
                            </div>
                            {{-- <div class="infotxt">
                                <h6>
                                    <span id="MainContent_lblAwardTitle">{{ $food->price }}</span>
                                </h6>
                            </div> --}}

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="foodbox p-3">
                                        <h4>Lunch</h4>
                                        <div class="galleryslider swiper gallery swiper-gallery">
                                            <div class="swiper-wrapper">
                                                @if ($food->foodimage_breakfast->isNotEmpty())
                                                    @foreach ($food->foodimage_breakfast as $breakfastImage)
                                                        <div class="swiper-slide">
                                                            <a href="{{ asset('storage/food_image/' . $breakfastImage->image) }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ asset('storage/food_image/' . $breakfastImage->image) }}"
                                                                    class="card-img-top" style="height: 250px;">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No lunch images available.</p>
                                                @endif
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        </div>

                                        <div class="infotxt mt-2">
                                            {{-- <p>{!! $food->description !!}</p> --}}
                                            <p>{!! $food->lunch !!}</p>
                                            {{-- <p>{!! $food->dinner !!}</p> --}}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="foodbox p-3">
                                        <h4>Lunch</h4>
                                        <div class="galleryslider swiper gallery swiper-gallery">
                                            <div class="swiper-wrapper">
                                                @if ($food->foodimage_lunch->isNotEmpty())
                                                    @foreach ($food->foodimage_lunch as $lunchImage)
                                                        <div class="swiper-slide">
                                                            <a href="{{ asset('storage/food_image/' . $lunchImage->image) }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ asset('storage/food_image/' . $lunchImage->image) }}"
                                                                    class="card-img-top" style="height: 250px;">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No lunch images available.</p>
                                                @endif
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        </div>

                                        <div class="infotxt mt-2">
                                            {{-- <p>{!! $food->description !!}</p> --}}
                                            <p>{!! $food->lunch !!}</p>
                                            {{-- <p>{!! $food->dinner !!}</p> --}}
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                    <div class="foodbox p-3">
                                        <h4>Dinner</h4>
                                        <div class="galleryslider swiper gallery swiper-gallery">
                                            <div class="swiper-wrapper">
                                                @if ($food->foodimage_dinner->isNotEmpty())
                                                    @foreach ($food->foodimage_dinner as $dinnerImage)
                                                        <div class="swiper-slide">
                                                            <a href="{{ asset('storage/food_image/' . $dinnerImage->image) }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ asset('storage/food_image/' . $dinnerImage->image) }}"
                                                                    class="card-img-top" style="height: 250px;">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>No dinner images available.</p>
                                                @endif
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        </div>

                                        <div class="infotxt mt-2">
                                            {{-- <p>{!! $food->description !!}</p> --}}
                                            {{-- <p>{!! $food->lunch !!}</p> --}}
                                            <p>{!! $food->dinner !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>

@push('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        .mainheading {
            padding: 0px;
        }

        .mainheading h4 {
            font-size: 24px;
            color: #1e1e1e;
            line-height: 26px;
            font-weight: 500;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .foodbox {
            height: 100%;
            background: #ffffff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .foodbox .galleryslider {
            box-shadow: none;
        }

        .infotxt {
            color: #000;
            font-size: 16px;
            line-height: 24px;
        }
    </style>
@endpush
@push('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        // Fancybox Config
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "slideShow",
                "zoom",
                "fullScreen",
                "close"
            ],
            loop: false,
            protect: true
        });
    </script>
@endpush
