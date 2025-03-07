<div>
    <div>
        <div class="bannercls">
            <picture>
                <source media="(min-width:980px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <source media="(min-width:400px)" src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
                <img src="{{ asset('/assets/user-front/images/about-us-header.jpg') }}">
            </picture>
            <div class="box">
                <div class="container">
                    <div class="animate-box">
                        <nav class="breadcrumbs">
                            <span>
                                <span class="breadcrumb-text">
                                    <a href="#">Home</a>
                                </span>
                                <span class="breadcrumb-separator"></span>
                                <span class="breadcrumb-text">AGM</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    @if ($agm)
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
                                            <span id="MainContent_lblAwardTitle">{{ $agm->name }}</span>
                                        </h3>
                                    </div>
                                    <div class="infotxt">
                                        <p>{!! $agm->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="galleryslider">
                                @foreach ($agm->agmimages as $agmimage)
                                    <div class="item galleria-image active">
                                        <div class="slider_details_wrap">
                                            <img class="img-fluid" src="{{ asset('storage/agm/' . $agmimage->image) }}"
                                                alt="{{ $agm->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('extra_css')
        <style>
            .animate-box {
                padding: 20px 0 !important;
            }

            .bannercls .box {
                background: rgba(0, 0, 0, .5) !important;
            }

            .bannercls .box {
                position: absolute;
                z-index: 999;
                bottom: 0;
                display: block;
                color: #ffffff;
                padding: 0;
                width: 100%;
            }

            .container {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }

            .breadcrumbs {
                font-size: 14px;
                font-weight: normal !important;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                width: 100%;
            }

            .animate-box {
                padding: 20px 0 !important;
            }

            .breadcrumbs {
                font-size: 14px;
                font-weight: normal !important;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                width: 100%;
            }

            .about-section {
                padding: 50px 0;
                background-color: #f8f8f8;
            }

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
                line-height: 22px;
            }
        </style>
    @endpush
    @push('extra_js')
        <script>
            var $videoSrc;
            $('.video-btn').click(function() {
                $videoSrc = $(this).data("src");
            });
            console.log($videoSrc);
            $('#videoModal').on('shown.bs.modal', function(e) {
                $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"); //
            })
            $('#videoModal').on('hide.bs.modal', function(e) {
                $("#video").attr('src', '');
            });

            $('.galleryslider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                arrows: true,
                dots: true,
                autoplaySpeed: 5000,
            });
        </script>
    @endpush
