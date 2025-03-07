<main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">

        </div>
    </section>


    <section class="detail-sec detail-secbox">
        <div class="container">
            @if ($hotel->video)
                <a href="{{ $hotel->video }}" target="_blank">
                    <i class="fas fa-video"></i> Click to View Video
                </a>
            @else
                {{-- <p>No video available</p> --}}
            @endif

            <div class="row">
                @if ($hotel)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="galleryslider swiper swiper-gallery">
                            <div class="swiper-wrapper">
                                @foreach ($hotel->hotelimage as $image)
                                    <div class="swiper-slide shadow galleria-image active">
                                        <div class="slider_details_wrap">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/hotel_photo/' . $image->hotel_img) }}"
                                                alt="{{ $hotel->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="similar-packages">
                            <div class="mt-0">
                                <h4 style="font-weight:700;">{{ $hotel->hotel_name }}</h4>
                                <div class="mb-2" style="font-weight:normal;color:#b49164;">{{ $hotel->address }}
                                </div>
                                <div class="mb-2">
                                    <span><i class="fa fa-phone" style="color:#b49164;"></i> {{ $hotel->contact }} | <i
                                            class="fa fa-envelope" style="color:#b49164;"></i>
                                        {{ $hotel->email }}</span>
                                </div>
                                <div class="mb-2">
                                    <span><i class="fa fa-clock-o" style="color:#b49164;"></i> Check in:
                                        {{ $hotel->check_in }} | <i class="fa fa-clock-o" style="color:#b49164;"></i>
                                        Check Out:
                                        {{ $hotel->check_out }}</span>
                                </div>
                                <div class="listbox-title-new my-2">
                                    <a href="{{ $hotel->website_url }}" target="_blank"><i class="fa fa-globe"
                                            style="color:#b49164;"></i>
                                        {{ $hotel->website_url }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="similar-packages pt-0">
                            <div class="banner-title-details text-center shadow"
                                style="background: #b49164;color: #ffffff;padding: 8px;border-radius: 10px;">
                                Enquiry
                            </div>
                            <div class="similar_packages-box">
                                @if (session('hotel_success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                                        style="color: #1d6119;border: 1px solid #1d6119;">
                                        {!! session('hotel_success') !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                            style="color: #1d6119;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>{{ __('tablevars.name') }}<span class="text-red">*</span></label>
                                            <input type="text" name="cust_name" id="cust_name" class="form-control"
                                                placeholder="Name" wire:model="cust_name">
                                            @error('cust_name')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('tablevars.country') }}<span class="text-red">*</span></label>
                                            <select class="form-control" wire:model='country_id'>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.country') }}</option>
                                                @foreach ($country as $countryId => $countryName)
                                                    <option value="{{ $countryId }}">{{ $countryName }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ __('tablevars.phone') }}<span class="text-red">*</span></label>
                                            <input type="text" name="mob_num" id="mob_num" class="form-control"
                                                placeholder="Mobile number" wire:model="mob_num" maxlength="20">
                                            @error('mob_num')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Query <span class="text-red">*</span></label>
                                            <textarea name="message" class="form-control" wire:model='message'></textarea>
                                            @error('message')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{-- <label>Captcha<span class="text-red">*</span></label> --}}
                                            <input type="text" class="form-control" wire:model.live="userInput"
                                                placeholder="Enter CAPTCHA">
                                            <div class="mb-2">
                                                @error('userInput')
                                                    <span class="block text-red"
                                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div style="display:flex;">
                                                <img src="data:image/jpeg;base64,{{ $captchaImage }}"
                                                    alt="Captcha Image">
                                                <i wire:click="generateCaptcha" class="fa fa-refresh"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            <div class="col-md-12 d-flex text-center">
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                            </form>
                        </div>


                    </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dt-tabbing-sec">
                    <div id="terms_condition"></div>
                    <div class="dt-box-1 shadow">
                        <div class="tabnav">
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <a href="#overview" class="active" aria-controls="overview" role="tab"
                                        data-toggle="tab" aria-expanded="true" aria-selected="true">Overview</a>
                                </li>
                                <li>
                                    <a href="#rooms" class="" aria-controls="rooms" role="tab"
                                        data-toggle="tab" aria-expanded="false" aria-selected="false">Rooms</a>
                                </li>
                                <li>
                                    <a href="#map" class="" aria-controls="map" role="tab"
                                        data-toggle="tab" aria-expanded="false" aria-selected="false">Map</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" style="padding-top: 20px;">
                            <div role="tabpanel" class="tab-pane active" id="overview">
                                <div class="terms_list">
                                    {{ $hotel->hotel_overview ?? '' }}
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="rooms">
                                <div class="row">
                                    @foreach ($hotel->hotelimage as $image)
                                        <div class="col-md-4">
                                            <div class="fl-img liting-img">
                                                <a href="#">
                                                    <img class="img-fluid"
                                                        src="{{ asset('storage/hotel_photo/' . $image->hotel_img) }}"
                                                        alt="{{ $hotel->name }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="map">
                                <div class="col-md-12">
                                    <div class="mapouter">
                                        <div class="gmap_canvas">

                                            {!! $hotel->google_map !!}
                                            {{-- <iframe width="100%" height="450" id="gmap_canvas"
                                                    src="{{ $hotel->google_map }}" frameborder="0" scrolling="no"
                                                    marginheight="0" marginwidth="0"></iframe> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

@push('extra_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .slider_details_wrap {
            margin-bottom: 0;
            overflow: hidden;
            position: relative;
            height: 500px;
        }
    </style>
@endpush
