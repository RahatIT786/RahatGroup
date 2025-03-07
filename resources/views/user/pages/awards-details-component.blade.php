<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url('https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp');">
        <div class="container">
            <h1>Awards</h1>
        </div>
    </section>
    <section class="detail-sec detail-secbox">
        <div class="container">
            <div class="row">
                @if ($award)
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="MainContent_divInfo" class="row" style="display: none">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info">
                                            No Record found.
                                        </div>
                                    </div>
                                </div>

                                <div class="mainheading">
                                    <h3>
                                        <span id="MainContent_lblAwardTitle">{{ $award->title }}</span>
                                    </h3>
                                </div>

                                <div class="infotxt">
                                    <p>{!! $award->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="galleryslider swiper swiper-gallery">
                            <div class="swiper-wrapper">

                                @foreach ($award->awardimages as $awardimage)
                                    <div class="swiper-slide galleria-image active">
                                        <div class="slider_details_wrap">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/award/' . $awardimage->image) }}"
                                                alt="{{ $award->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                @endif


            </div>
        </div>

</main>

@push('extra_css')
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

        .infotxt {
            color: #000;
            font-size: 16px;
            line-height: 26px;
        }
    </style>
@endpush
