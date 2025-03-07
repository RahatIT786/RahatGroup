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
                                <span class="breadcrumb-text">Blog</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    @foreach ($QsBlog as $RsBlog)
                        <div class="col-md-4 col-sm-4">
                            <div class="recentarticlesbox">
                                <div class="recentarticlesboximg">
                                    <a href="{{ route('customer.BlogDetails', ['id' => $RsBlog->id]) }}"><img
                                            src="{{ asset('/storage/blog_image/' . $RsBlog->image) }}"></a>

                                </div>
                                <div class="articlecont">
                                    <h4 style="margin-top: 0px;min-height: 45px;">
                                        <a
                                            href="{{ route('customer.BlogDetails', ['id' => $RsBlog->id]) }}">{{ $RsBlog->title }}</a>
                                    </h4>
                                    {{-- <a href="Blogs.aspx?Id=1056">{{ $RsBlog->title }}</a> --}}
                                    {{-- <p>
                                        {!! Helper::limitText($RsBlog->description) !!}
                                    </p> --}}
                                    <div class="infolinks">
                                        <a href="{{ route('customer.BlogDetails', ['id' => $RsBlog->id]) }}">Read
                                            More</a>
                                    </div>
                                    {{-- <a href="{{ route('blog-details') }}">Read More</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @push('extra_css')
        <style>
            .innercontarea {
                padding: 30px 0px;
            }

            .recentarticlesbox {
                margin-bottom: 30px;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 8px;
                -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            }

            .recentarticlesboximg {
                width: 100%;
                height: 190px;
                border-radius: 8px;
            }

            .recentarticlesboximg img {
                width: 100%;
                height: 190px;
                border-radius: 8px;
                object-fit: cover;
                object-position: 50% 50%;
            }

            .articlecont {
                font-size: 15px;
                font-weight: 400;
                padding: 15px;
            }

            .recentarticlesbox h4 {
                font-size: 17px;
                color: #1e1e1e;
                line-height: 22px;
                font-weight: 600;
                margin-top: 15px;
                margin-bottom: 15px;
            }

            .recentarticlesbox h4 a {
                color: #1e1e1e;
                text-decoration: none;
            }

            .infolinks {
                color: #0059e3;
                font-size: 13px;
                line-height: 16px;
            }

            .infolinks a {
                color: #0059e3;
                text-decoration: none;
            }
        </style>
    @endpush
