<main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
        </div>
    </section>
    <section class="detail-sec detail-secbox">
        <div class="container">
            <div class="row">
                @if ($car)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" wire:ignore>
                        <div class="galleryslider swiper swiper-gallery">
                            <div class="swiper-wrapper">
                                @foreach ($car->carimages as $image)
                                    <div class="swiper-slide shadow galleria-image active">
                                        <div class="slider_details_wrap">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/car_image/' . $image->image) }}"
                                                alt="{{ $car->cartypemaster->car_type ?? '' }}">
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
                                <h4 style="font-weight:700;">Car Details</h4>
                                <div class="mb-2">
                                    <span>
                                        <i class="fa fa-users" style="color:#b49164;"></i> No of Seats:
                                        {{ $car->no_of_seats ?? '' }}
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <span>
                                        <i class="fa fa-thermometer-half" style="color:#b49164;"></i> Air
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
                                <div class="mb-2">
                                    <span><strong> Description :</strong></span>
                                    <p style="margin: 0; color: #333;">{!! $car->description !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="similar-packages pt-0">
                            <div class="similar_packages-box">
                                @if (session('enquiry_success'))
                                    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert"
                                        style="color: #1d6119;border: 1px solid #1d6119;display: flex;justify-content: space-between;">
                                        <div>{!! session('enquiry_success') !!}</div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                            style="color: #1d6119;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <h5>All fields are mandatory</h5>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Pickup From"
                                                name="pickup_from" id="pickup_from" value=""
                                                wire:model="pickup_from">
                                            @error('pickup_from')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" wire:model.live='sector_name'>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.sector') }}</option>
                                                @foreach ($carsectormaster as $SectorId => $SectorName)
                                                    <option value="{{ $SectorId }}">{{ $SectorName }}</option>
                                                @endforeach
                                            </select>
                                            @error('sector_name')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Pickup Date"
                                                name="pickup_date" id="pickup_date" value=""
                                                wire:model="pickup_date" onfocus="(this.type='date')"
                                                onblur="(this.type='text')">
                                            @error('pickup_date')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="time" class="form-control" placeholder="Pickup Time"
                                                name="pickup_time" id="pickup_time" value=""
                                                wire:model="pickup_time">
                                            @error('pickup_time')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Full Name" wire:model="name">
                                            @error('name')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Email"
                                                name="email" id="email" value="" wire:model="email">
                                            @error('email')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Nationality"
                                                name="nationality" id="nationality" value=""
                                                wire:model="nationality">
                                            @error('nationality')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" name="mobile_home" id="mobile_home"
                                                class="form-control" placeholder="Mobile No(home)"
                                                wire:model="mobile_home" maxlength="10">
                                            @error('mobile_home')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" name="mobile_saudi" id="mobile_saudi"
                                                class="form-control" placeholder="Mobile No(saudi)"
                                                wire:model="mobile_saudi" maxlength="10">
                                            @error('mobile_saudi')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" name="whatsapp_num" id="whatsapp_num"
                                                class="form-control" placeholder="WhatsApp Number"
                                                wire:model="whatsapp_num" maxlength="10">
                                            @error('whatsapp_num')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <textarea class="form-control" placeholder="Address" name="address" id="address" value=""
                                                wire:model="address"></textarea>
                                            @error('address')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <textarea class="form-control" placeholder="Description" name="description" id="description" value=""
                                                wire:model="description"></textarea>
                                            @error('description')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" wire:model.live="userInput"
                                                placeholder="Enter CAPTCHA">
                                            <div class="mb-2">
                                                @error('userInput')
                                                    <span class="block text-red"
                                                        style="color: red;font-weight: 500;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div style="display:flex;">
                                                <img src="data:image/jpeg;base64,{{ $captchaImage }}"
                                                    alt="Captcha Image">
                                                    <i wire:click="generateCaptcha" class="fa fa-refresh" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex text-center">
                                        <button type="submit" class="submit-btn">Send Enquiry</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12" wire:ignore>
                    <div class="dt-tabbing-sec">
                        <div id="terms_condition"></div>
                        <div class="dt-box-1 shadow">
                            <div class="tabnav">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li>
                                        <a href="#overview" class="active" aria-controls="overview" role="tab"
                                            data-toggle="tab" aria-expanded="true" aria-selected="true">Terms And
                                            Conditions</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" style="padding-top: 20px;">
                                <div role="tabpanel" class="tab-pane active" id="overview">
                                    <div class="terms_list">
                                        {!! $car->terms ?? '' !!}
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
    <style>
        .slider_details_wrap {
            margin-bottom: 0;
            overflow: hidden;
            position: relative;
            height: 500px;
        }
    </style>
@endpush
