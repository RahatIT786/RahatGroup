<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="py-5 border-top">
    <!-- Breadcrumb -->
    <div class="mb-7">
        <div class="container">
            <nav class="breadcrumbs mb-4">
                <span>
                    <span class="breadcrumb-text">
                        <a href="#">Home</a>
                    </span>
                    <span class="breadcrumb-separator"></span>
                    <span class="breadcrumb-text">
                        <a href="{{ route('customer.transport') }}">Vehicle</a>
                    </span>
                    <span class="breadcrumb-separator"></span>
                    <span class="breadcrumb-text">{{ $car->cartypemaster->car_type }}</span>
                </span>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="d-block d-md-flex flex-center-between align-items-start mb-2">
                    <div class="mb-3">
                        <div class="d-block d-md-flex flex-horizontal-center mb-2 mb-md-0">
                            <h4 class="font-size-23 font-weight-bold mb-1">
                                {{ $car->cartypemaster->car_type }} - {{ $car->no_of_seats }} Seater</h4>
                        </div>
                        <div class="d-block d-md-flex flex-horizontal-center font-size-14 text-gray-1">
                            <h4 class="font-size-18 font-weight-bold mb-1">
                                {{ $car->carsectormaster->sector_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="pb-4 mb-2">
                    <div class="position-relative">
                        <!-- Images Carousel -->
                        <div class="slider slider-for large-hotel-image mb-2" wire:ignore>
                            @foreach ($car->carimages as $imageId)
                                <div class="item-slide">
                                    <img class="img-fluid rounded"
                                        src="{{ asset('storage/car_image/' . $imageId->image) }}" alt="car image">
                                </div>
                            @endforeach
                        </div>
                        <div class="slider slider-nav" wire:ignore>
                            @foreach ($car->carimages as $imageId)
                                <div class="item-slide hotel-thumb-image" style="cursor: pointer;">
                                    <img class="img-fluid rounded"
                                        src="{{ asset('storage/car_image/' . $imageId->image) }}" alt="car image">
                                </div>
                            @endforeach
                        </div>
                        <!-- End Images Carousel -->
                    </div>
                </div>
                <div class="border-bottom position-relative">
                    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark">
                        Terms And Conditions
                    </h5>
                    @php
                        $carOverview = $car->terms ?? '';
                        $firstPart = substr($carOverview, 0, 200); // First 200 characters
                        $remainingPart = substr($carOverview, 200); // Rest of the content
                    @endphp
                    <p>
                        @if (!empty($firstPart))
                            {!! $firstPart !!}
                        @endif

                        @if (!empty($remainingPart))
                            <span class="collapse" id="collapseLinkExample">
                                {!! $remainingPart !!}
                            </span>
                        @endif
                    </p>
                    <a class="link-collapse link-collapse-custom gradient-overlay-half mb-5 d-inline-block border-bottom border-default"
                        data-toggle="collapse" href="#collapseLinkExample" role="button" aria-expanded="false"
                        aria-controls="collapseLinkExample">
                        <span class="link-collapse__default font-size-14">View More <i
                                class="icon-chevron-down font-size-10 ml-1"></i></span>
                        <span class="link-collapse__active font-size-14">View Less <i
                                class="icon-chevron-up font-size-10 ml-1"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="mb-4">
                    <div class="flex-horizontal-center">
                        <div class="flex-horizontal-center ml-2">
                            <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark">
                                Vehicle Details
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="border border-color-7 rounded mb-3">
                        <div class="border-bottom">
                            <div class="mb-2 p-1">
                                <span>
                                   <i class="fa fa-users" style="color:#e67717;"></i> No of Seats:
                                   {{ $car->no_of_seats ?? '' }}
                                </span>
                            </div>
                            <div class="mb-2 p-1">
                                <span>
                                   <i class="fa fa-thermometer-half" style="color:#e67717;"></i> Air
                                   Conditioner:
                                   @if ($car->air_conditioner == '1')
                                   Yes
                                   @elseif ($car->air_conditioner == '2')
                                   No
                                   @else
                                   {{ $car->air_conditioner }}
                                   @endif
                                </span>
                            </div>
                            <div class="mb-2 p-1">
                                <span><strong> Description :</strong></span>
                                <p style="margin: 0; color: #333;">{!! $car->description !!}</p>
                            </div>
                        </div>
                    </div>
                    @if (session('enquiry_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="color: #1d6119;border: 1px solid #1d6119;">
                            <div>{!! session('enquiry_success') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                style="color: #1d6119;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="border border-color-7 rounded px-4 pt-4 pb-3 mb-3">
                        <div class="">
                            <h5 class="font-size-21 font-weight-bold text-dark">
                                All fields are mandatory
                            </h5>
                            <form wire:submit.prevent="save">
                                <div class="row mb-5 mb-lg-0">
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Pickup From"
                                            name="pickup_from" id="pickup_from" value="" wire:model="pickup_from">
                                        @error('pickup_from')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <select class="form-control" wire:model.live='sector_name'>
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.sector') }}</option>
                                            @foreach ($carsectormaster as $SectorId => $SectorName)
                                                <option value="{{ $SectorId }}">{{ $SectorName }}</option>
                                            @endforeach
                                        </select>
                                        @error('sector_name')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Pickup Date"
                                            name="pickup_date" id="pickup_date" value=""
                                            wire:model="pickup_date" onfocus="(this.type='date')"
                                            onblur="(this.type='text')">
                                        @error('pickup_date')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="time" class="form-control" placeholder="Pickup Time"
                                            name="pickup_time" id="pickup_time" value=""
                                            wire:model="pickup_time">
                                        @error('pickup_time')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Full Name" wire:model="name">
                                        @error('name')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="email" id="email" value="" wire:model="email">
                                        @error('email')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Nationality"
                                            name="nationality" id="nationality" value=""
                                            wire:model="nationality">
                                        @error('nationality')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" name="mobile_home" id="mobile_home"
                                            class="form-control" placeholder="Mobile No(home)"
                                            wire:model="mobile_home" maxlength="10">
                                        @error('mobile_home')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" name="mobile_saudi" id="mobile_saudi"
                                            class="form-control" placeholder="Mobile No(saudi)"
                                            wire:model="mobile_saudi" maxlength="10">
                                        @error('mobile_saudi')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" name="whatsapp_num" id="whatsapp_num"
                                            class="form-control" placeholder="WhatsApp Number"
                                            wire:model="whatsapp_num" maxlength="10">
                                        @error('whatsapp_num')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <textarea class="form-control" placeholder="Address" name="address" id="address" value=""
                                            wire:model="address"></textarea>
                                        @error('address')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <textarea class="form-control" placeholder="Description" name="description" id="description" value=""
                                            wire:model="description"></textarea>
                                        @error('description')
                                        <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" class="form-control" wire:model.live="userInput"
                                            placeholder="Enter CAPTCHA">
                                        <div class="mb-2">
                                            @error('userInput')
                                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div style="display:flex; align-items:center;">
                                            <img src="data:image/jpeg;base64,{{ $captchaImage }}"
                                                alt="Captcha Image"><br>
                                            <i wire:click="generateCaptcha" class="fa fa-refresh fa-lg"
                                                style="cursor: pointer" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                        <button type="submit" class="btn secondary-btn" style="background-position: 300% 100% !important;">Send Enquiry</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


<!-- </div> -->
@push('extra_css')
    <style>
        .large-hotel-image img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .hotel-thumb-image img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .flex-content-center {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .flex-horizontal-center {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
        }

        .position-absolute {
            position: absolute !important;
        }

        .top-0 {
            top: 0;
        }

        .right-0 {
            right: 0;
        }

        .list-group-borderless .list-group-item {
            border: none;
        }

        .text-underline {
            text-decoration: underline;
        }

        .text-violet-1 {
            color: #a864a8 !important;
        }

        .text-indigo-light {
            color: #080e7b !important;
        }

        .text-gray-1 {
            color: #67747c !important;
        }

        .text-gray-3 {
            color: #3b444f !important;
        }

        .text-gray-7 {
            color: #5c6770 !important;
        }

        .text-gray-9 {
            color: #9fa9b8 !important;
        }

        .text-red-light-2 {
            color: #ff3c4e !important;
        }

        .border-color-8 {
            border-color: #ebf0f7 !important;
        }

        .border-violet-1 {
            border-color: #a864a8 !important;
        }

        .border-brown {
            border-color: #f8bd5b !important;
        }

        .border-maroon {
            border-color: #c72f74 !important;
        }

        .border-default {
            border-color: #2D6F76 !important;
        }

        .bg-violet-1 {
            background-color: #a864a8 !important;
        }

        .bg-brown {
            background-color: #f8bd5b !important;
        }

        .bg-maroon {
            background-color: #c72f74 !important;
        }

        .green-lighter {
            color: #b0d12b;
        }

        .border-width-2 {
            border-width: 2px !important;
        }

        .border-radius-3 {
            border-radius: 3px !important;
        }

        .height-45 {
            height: 2.813rem;
        }

        .width-45 {
            width: 2.813rem;
        }

        .height-110 {
            height: 110px;
        }

        .text-lh-1 {
            line-height: 1;
        }

        .text-lh-inherit {
            line-height: 1.5;
        }

        .text-lh-sm {
            line-height: 1.2;
        }

        .mb-6,
        .my-6 {
            margin-bottom: 2.5rem !important;
        }

        .ml-7,
        .mx-7 {
            margin-left: 3rem !important;
        }

        .mb-8,
        .my-8 {
            margin-bottom: 3.5rem !important;
        }

        .font-size-1 {
            font-size: 0.875rem;
        }

        .font-size-10 {
            font-size: 0.625rem;
        }

        .font-size-14 {
            font-size: 0.875rem;
        }

        .font-size-15 {
            font-size: 0.938rem;
        }

        .font-size-17 {
            font-size: 1.063rem;
        }

        .font-size-18 {
            font-size: 1.125rem;
        }

        .font-size-19 {
            font-size: 1.188rem;
        }

        .font-size-20 {
            font-size: 1.25rem;
        }

        .font-size-21 {
            font-size: 1.313rem;
        }

        .font-size-23 {
            font-size: 1.438rem;
        }

        .font-size-24 {
            font-size: 1.5rem;
        }

        .font-size-25 {
            font-size: 1.563rem;
        }

        .font-size-50 {
            font-size: 3.125rem;
        }

        .font-italic {
            font-style: italic !important;
        }

        .letter-spacing-2 {
            letter-spacing: 0.125rem;
        }

        .letter-spacing-3 {
            letter-spacing: 0.188rem;
        }

        .link-collapse-custom[aria-expanded="false"] {
            position: static;
        }

        [class*="gradient-overlay-half"]::before {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            right: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            content: "";
            transition: all 0.2s ease-in-out;
        }

        .link-collapse-custom[aria-expanded="false"]::before {
            background-image: linear-gradient(180deg, transparent 40%, #fff 99%);
            background-repeat: repeat-x;
            z-index: 1;
            bottom: 74px;
            height: auto;
        }

        .link-collapse[aria-expanded="true"] .link-collapse__default {
            display: none;
        }

        .link-collapse[aria-expanded="true"] .link-collapse__active {
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .link-collapse[aria-expanded="false"] .link-collapse__active {
            display: none;
        }

        .link-collapse[aria-expanded="false"] .link-collapse__default {
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .custom-social-share a {
            transition: all 0.2s ease-in-out;
        }

        .custom-social-share a:hover {
            border-color: #2D6F76 !important;
            background-color: #2D6F76 !important;
            color: #ffffff;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .media {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .slider-nav .slick-list {
            margin: 0px -5px;
        }

        .slider-nav .item-slide {
            padding: 0px 5px;
        }

        .slider-nav .item-slide:not(.slick-current) {
            opacity: 0.2;
        }

        @media (min-width: 1200px) {
            .border-xl-left {
                border-left: 1px solid #e7eaf3 !important;
            }

            .border-xl-top-0 {
                border-top: 0 !important;
            }

            .col-xl-3dot5 {
                -ms-flex: 0 0 29.16667%;
                flex: 0 0 29.16667%;
                max-width: 29.16667%;
            }

            .pb-xl-0,
            .py-xl-0 {
                padding-bottom: 0 !important;
            }

            .pt-xl-0,
            .py-xl-0 {
                padding-top: 0 !important;
            }

            .pr-xl-2,
            .px-xl-2 {
                padding-right: 0.5rem !important;
            }
        }
    </style>
@endpush
@push('extra_js')
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            focusOnSelect: true,
            responsive: [{
                "breakpoint": 992,
                "settings": {
                    "slidesToShow": 4
                }
            }, {
                "breakpoint": 768,
                "settings": {
                    "slidesToShow": 3
                }
            }, {
                "breakpoint": 554,
                "settings": {
                    "slidesToShow": 2
                }
            }]
        });
    </script>
@endpush
