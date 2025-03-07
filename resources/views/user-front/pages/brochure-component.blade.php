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
                                <span class="breadcrumb-text">Brochure</span>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="background-color: #7E9680; color: white;">Name</th>
                                    <th style="background-color: #7E9680; color: white;">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brochures as $brochure)
                                    <tr>
                                        <td>{{ $brochure->name }}</td>
                                        <td>
                                            <a href="{{ asset('storage/profile_image/' . $brochure->image) }}"
                                                target="_blank">
                                                <i class="fa fa-download"></i> &nbsp;{{ basename($brochure->image) }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
