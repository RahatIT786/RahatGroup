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
                                <span class="breadcrumb-text">Guides & Pdfs</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <section class="content-section">
                    <div class="container">
                        <div class="contentbox">
                            <p class="iebARE">{!! html_entity_decode($guides->description) !!}</p>
                        </div>
                    </div>
                </section>
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

            .content-section {
                padding: 50px 0px;
            }

            .contentbox {
                margin-bottom: 20px;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 25px;
                -webkit-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                -moz-box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
                box-shadow: 5px 13px 23px 10px rgba(0, 0, 0, 0.05);
            }

            .content-section a {
                color: #0059e3;
                cursor: pointer;
            }

            .content-section a:hover {
                color: #0546a7;
                text-decoration: none;
            }
        </style>
    @endpush
