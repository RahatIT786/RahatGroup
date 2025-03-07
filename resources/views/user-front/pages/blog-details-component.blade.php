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
                                <span class="breadcrumb-text">Blog Details</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    @if ($blog)
                        <div class="col-sm-8">
                            <div class="blogarea">
                                <h4><strong>{{ $blog->title }}</strong></h4>
                                <div class="blogimg">
                                    <img id="MainContent_ImgMainBlog" class="img-responsive"
                                        src="{{ asset('/storage/blog_image/' . $blog->image) }}"
                                        alt="{{ $blog->title }}">
                                </div>
                                <h2>{{ $blog->subtitle }}</h2>
                                <div class="infotxt">
                                    <p><strong>{!! $blog->description !!}</strong></p>

                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-sm-4 rowmargintabmob30">
                        <div class="mainheading">
                            <h3>Related Posts</h3>
                        </div>
                        <div class="row">
                            @foreach ($QsBlog as $RsBlog)
                                <div class="col-md-12 col-sm-6">
                                    <div class="mostviewblogbox">
                                        <a href="{{ route('blog-details', ['id' => $RsBlog->id]) }}">
                                            <div class="row nopaddingarea">
                                                <div class="col-xs-4 nopadding">
                                                    <img src="{{ asset('/storage/blog_image/' . $RsBlog->image) }}"
                                                        alt="{{ $RsBlog->title }}">
                                                </div>
                                                <div class="col-xs-8 nopadding">
                                                    <div class="mostviewblogcont">
                                                        <h6>{{ $RsBlog->title }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('extra_css')
        <style>
            .innercontarea {
                padding: 30px 0px;
            }

            .blogarea {
                margin-bottom: 30px;
                border-bottom: dotted 1px #afafaf;
                padding-bottom: 30px;
            }

            .blogarea h4 {
                font-size: 17px;
                color: #1e1e1e;
                line-height: 22px;
                font-weight: 500;
                margin-top: 0px;
                margin-bottom: 15px;
            }

            .blogimg img {
                max-width: 100%;
            }

            .infotxt {
                color: #000;
                font-size: 14px;
                line-height: 22px;
            }

            .mainheading {
                padding: 0px;
            }

            .mainheading h3 {
                font-size: 30px;
                color: #1e1e1e;
                line-height: 30px;
                font-weight: 500;
                margin-top: 0px;
                margin-bottom: 20px;
            }

            .mostviewblogbox {
                background-color: #fff;
                border-radius: 10px;
                padding: 10px;
                border: solid 1px #c6d9f2;
                -webkit-box-shadow: 5px 5px 25px 0px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 5px 5px 25px 0px rgba(0, 0, 0, 0.1);
                box-shadow: 5px 5px 25px 0px rgba(0, 0, 0, 0.1);
                margin-bottom: 15px;
            }

            .nopaddingarea {
                padding: 0px 15px;
            }

            .row::before {
                display: table;
                content: " ";
            }

            .nopadding {
                padding: 0px;
            }

            .mostviewblogbox img {
                width: 100%;
                height: 80px;
                object-fit: cover;
                object-position: 50% 50%;
                border-radius: 5px;
            }

            .mostviewblogcont {
                padding: 0px 10px 0px 15px;
                width: 100%;
                height: 80px;
                display: table;
            }

            .mostviewblogcont h6 {
                font-size: 16px;
                color: #000;
                line-height: 20px;
                font-weight: 600;
                margin-top: 0px;
                margin-bottom: 10px;
                display: table-cell;
                vertical-align: middle;
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
