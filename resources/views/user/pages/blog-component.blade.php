<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Blogs</h1>
        </div>
    </section>
    <section class="innercontarea">
        <div class="container">
            <div class="row">
                @foreach ($QsBlog as $RsBlog)
                    <div class="col-md-4 col-sm-4">
                        <div class="recentarticlesbox">
                            <div class="recentarticlesboximg">
                                <a href="{{ route('blog-details', ['id' => $RsBlog->id]) }}"><img
                                        src="{{ asset('/storage/blog_image/' . $RsBlog->image) }}"></a>

                            </div>
                            <div class="articlecont">
                                <h4 style="margin-top: 0px;min-height: 45px;">
                                    <a
                                        href="{{ route('blog-details', ['id' => $RsBlog->id]) }}">{{ $RsBlog->title }}</a>
                                </h4>
                                {{-- <a href="Blogs.aspx?Id=1056">{{ $RsBlog->title }}</a> --}}
                                {{-- <p>
                                    {!! Helper::limitText($RsBlog->description) !!}
                                </p> --}}
                                <div class="infolinks">
                                    <a href="{{ route('blog-details', ['id' => $RsBlog->id]) }}">Read More</a>
                                  </div>
                                  {{-- <a href="{{ route('blog-details') }}">Read More</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
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
