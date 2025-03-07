<main class="cAJbgc" style="margin-top: 0px;">
    <div class="bannercls">
        <picture>
            <source media="(min-width:980px)" srcset="{{ asset('assets/user-front/images/domestic-travel-banner.jpg') }}">
            <source media="(min-width:400px)" srcset="{{ asset('assets/user-front/images/domestic-travel-banner.jpg') }}">
            <img src="{{ asset('assets/user-front/images/domestic-travel-banner.jpg') }}" title="" alt=""
                border="0">
        </picture>
        <div class="box">
            <div class="container">
                <div class="animate-box">
                    <h1>India</h1>
                    <nav class="breadcrumbs">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Domestic Destinations</span>
                        </span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="domestic-listing">
        <div class="container">
            <div class="row">
                @foreach ($tourstates as $tourstate)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="tour-package-box">
                            <a href="{{ route('domesticTourListing',$tourstate->slug) }}">
                                <picture>
                                    <source media="(min-width:980px)"
                                        srcset="{{ asset('storage/state_img/' . $tourstate->image) }}">
                                    <source media="(min-width:400px)"
                                        srcset="{{ asset('storage/state_img/' . $tourstate->image) }}">
                                    <img class="round" src="{{ asset('storage/state_img/' . $tourstate->image) }}"
                                        title="{{ $tourstate->name }}" alt="{{ $tourstate->name }}" border="0">
                                </picture>
                                <span class="package-title">{{ $tourstate->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>


@push('extra_css')
    <style>
        .bannercls {
            height: auto;
            position: relative;
        }

        .bannercls img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .bannercls .box {
            position: absolute;
            z-index: 999;
            bottom: 0;
            display: block;
            color: #ffffff;
            padding: 0;
            width: 100%;
            background: rgba(0, 0, 0, .5);
        }

        .bannercls .box {
            background: rgba(0, 0, 0, .5) !important;
        }

        .animate-box {
            padding: 20px 0 !important;
        }

        .bannercls .box h1 {
            margin-bottom: 0;
            font-size: 30px;
            font-weight: 300;
            margin-top: 10px;
            color: #ffffff;
        }

        .bannercls .box h1 {
            font-weight: 600 !important;
            text-transform: uppercase;
        }

        .bannercls .breadcrumbs a {
            color: #ffffff;
        }

        .bannercls .breadcrumbs .breadcrumb-separator {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="6.96" height="12.05" viewBox="0 0 6.96 12.05"><path id="arrow" d="M0,5.753,5.419,0l5.218,5.753" transform="translate(6.46 0.707) rotate(90)" fill="none" stroke="%23ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></svg>');
            background-repeat: no-repeat;
        }

        .domestic-listing {
            padding: 50px 0;
            background-image: url('../images/tour-package-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .tour-package-box {
            position: relative;
            margin-bottom: 30px;
            width: 100%;
            height: 250px;
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            transition: all ease-in-out 0.4s;
        }

        .tour-package-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            transition: all ease-in-out 0.4s;
        }

        .tour-package-box:hover img {
            transform: scale(1.2) rotate(10deg);
        }

        .tour-package-box:hover {
            box-shadow: 0px 0px 15px rgba(14, 98, 217, 0.8);
        }

        .tour-package-box .package-title {
            position: absolute;
            bottom: 0;
            left: 0;
            background: rgb(0 0 0 / 63%);
            width: 100%;
            color: #fff;
            padding: 8px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 0px 0px 8px 8px;
            -moz-border-radius: 0px 0px 8px 8px;
            -webkit-border-radius: 0px 0px 8px 8px;
        }
    </style>
@endpush
