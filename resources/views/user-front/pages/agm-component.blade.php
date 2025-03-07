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
                                <span class="breadcrumb-text">Agm</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    @foreach ($agms as $agm)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="awardsagmbox mb-0" style="height: 100%;">
                                <div class="awardsagmboximg">
                                    @if ($agm->agmimage)
                                        <a href="{{ route('customer.AgmDetails', ['id' => $agm->id]) }}">
                                            <img class="img"
                                                src="{{ asset('/storage/agm/' . $agm->agmimage->image) }}"
                                                alt="image {{ $agm->agmimage->id }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="awardsagmcont">
                                    <h4>
                                        <a
                                            href="{{ route('customer.AgmDetails', ['id' => $agm->id]) }}">{{ $agm->name }}</a>
                                    </h4>
                                    <p>
                                        {!! Helper::limitText($agm->description) !!}
                                    </p>
                                    <div class="infolinks
                                                topmargin10">
                                        <a href="{{ route('customer.AgmDetails', ['id' => $agm->id]) }}">Read More</a>
                                    </div>
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


            .innercontarea {
                padding: 30px 0px;
            }

            .awardsagmbox {
                margin-bottom: 30px;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 8px;
                -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            }

            .awardsagmboximg {
                width: 100%;
                height: 200px;
                border-radius: 8px;
            }

            .awardsagmboximg img {
                width: 100%;
                height: 200px;
                border-radius: 8px;
                object-fit: cover;
                object-position: 50% 50%;
            }

            .awardsagmcont {
                padding: 20px 10px;
            }

            .awardsagmcont h4 {
                font-size: 18px;
                color: #1e1e1e;
                line-height: 22px;
                font-weight: 600;
                min-height: 45px;
                margin-top: 0px;
                margin-bottom: 15px;
            }

            .awardsagmcont h4 a {
                color: #1e1e1e;
                text-decoration: none;
            }

            .awardsagmtext {
                font-size: 13px;
                font-weight: 400;
                line-height: 18px;
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                max-height: 4em;
                min-height: 75px;
            }

            .infolinks {
                color: #0059e3;
                font-size: 13px;
                line-height: 16px;
                cursor: pointer;
            }

            .infolinks a {
                color: #0059e3;
                text-decoration: none;
            }
        </style>
    @endpush
