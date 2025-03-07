<div style="position: inherit;">
    <main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
            </div>
        </section>
        <section class="detial-headercls">
            <div class="container">
                <div class="row">
                    @if ($packages)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="banner-title-details">
                                {{ $packages->name }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="detail-sec detail-secbox">
            <div class="container">
                <div class="row">
                    @if ($packages)
                        <div class="col-lg-7 col-md-7 col-sm-6 col-12">

                            <div class="galleryslider swiper swiper-gallery">
                                <div class="swiper-wrapper">
                                    @if (!empty($packages->pkgImages))

                                        @foreach ($packages->pkgImages as $pkg_imgs)
                                            <div class="swiper-slide shadow">
                                                <div class="slider_details_wrap">
                                                    <img src="{{ asset('/storage/package_image/' . $pkg_imgs->pkg_img) }}"
                                                        title="" border="0">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p> No Image Found</p>
                                    @endif
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-5">
                        <div class="packagedetpricebox">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div class="genformlabel">
                                            <label class="form-control-label">{{ __('tablevars.departure_city') }}
                                                <span class="text-red">*</span></label>
                                        </div>
                                        <select class="form-control" wire:model='city_id' wire:change="putInData"
                                            id="city_id">
                                            <option value="">{{ __('tablevars.city') }} {{ __('tablevars.name') }}
                                            </option>
                                            @foreach ($city as $CityId => $CityName)
                                                <option value="{{ $CityId }}">{{ $CityName }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="v-msg-500 text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div class="genformlabel">
                                            <label>{{ __('tablevars.dept_date') }}<span
                                                    class="text-red">*</span></label>
                                            <input type="date" name="travel_date" id="travel_date"
                                                class="form-control" wire:model="travel_date" wire:change="putInData">
                                            @error('travel_date')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="MainContent_dvPackageCategory" class="col-sm-6">
                                    <div class="mb-3">
                                        <div class="genformlabel">
                                            <label class="form-control-label">{{ __('tablevars.airlines') }}
                                                <span class="text-red">*</span></label>
                                        </div>
                                        <select class="form-control" wire:model='airline_id' wire:change="putInData"
                                            id="airline_id">
                                            <option value="">{{ __('tablevars.airlines') }}
                                                {{ __('tablevars.name') }}</option>
                                            @foreach ($flight as $FlightId => $FlightName)
                                                <option value="{{ $FlightId }}">{{ $FlightName }}</option>
                                            @endforeach
                                        </select>
                                        @error('airline_id')
                                            <span class="v-msg-500 text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="MainContent_dvPackageCategory" class="col-sm-6">
                                    <div class="mb-3">
                                        <div class="genformlabel">
                                            <label class="form-control-label">{{ __('tablevars.pkg_type') }}
                                                <span class="text-red">*</span>
                                            </label>
                                        </div>
                                        <select class="form-control" name="package_type" wire:change="changeFlavour"
                                            wire:model="selectedPackageFlavourId">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.pkg_type') }}</option>
                                            @foreach ($packageType as $id => $type)
                                                <option value="{{ $id }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedPackageFlavourId')
                                            <span class="text-red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3">
                                <div class="col-7">
                                    <strong>
                                        <div id="MainContent_divCost" class="price">₹{{ number_format($g_share, 2) }}
                                        </div>
                                    </strong>
                                    <div style="font-weight: bold" class="pricefromtext">per person</div>
                                </div>
                                {{-- <div class="col-3">
                                     <strong>
                                        <div id="MainContent_divAvailableSeat" class="price">40</div>
                                    </strong>
                                    <div style="font-weight: bold" class="pricefromtext">Available Seats</div> 
                                </div> --}}
                                <div class="col-5 text-end">
                                    @php
                                        $isValid =
                                            !empty($city_id) &&
                                            !empty($travel_date) &&
                                            !empty($airline_id) &&
                                            !empty($selectedPackageFlavourId);
                                        $props = $isValid ? "data-toggle='modal' data-target='#hajjModal'" : '';
                                    @endphp
                                    <button type="button" title="Book Now" class="primarybtnborder" id="btnEnquire"
                                        wire:click.prevent="changeName" {!! $props !!}>
                                        {{ __('tablevars.enquire') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="topmargin20">
                            <a class="downloaditnerybtn" href="{{ route('downloadHajjPackage', $packages->id) }}"
                                type="button" id="lnkDownloadItinerary">{{ 'Download Itinerary' }} <i
                                    class="fa fa-download"></i></a>
                        </div>
                        <div style="margin-top: 40px">
                            @if ($packages)
                                <h5>{{ __('tablevars.desc') }}</h5>
                                <div class="addReadMore showlesscontent">{!! $packages->description !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($packages)
                        <div class="col-md-12">
                            <div class="row gx-2">
                                @foreach ($packageType as $id => $type)
                                    <div class="col-md-2 mb-3">
                                        <div class="select-paln-box">
                                            <input type="radio" name="package_type" id="{{ $id }}"
                                                value="{{ $id }}" wire:change="changeFlavour"
                                                wire:model="selectedPackageFlavourId">
                                            <label class="paln-label" for="{{ $id }}">
                                                <p>{{ $type }}</p>
                                            </label>
                                            <span class="check-mark"></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="dt-tabbing-sec">
                                {{-- <div id="terms_condition"></div> --}}
                                {{-- <div class="dt-title">Terms &amp; Conditions</div> --}}
                                <div class="dt-box-1 shadow">
                                    <div class="tabnav">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li>
                                                <a href="#details_tab3" class="active" aria-controls="details_tab3"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Hotels</a>
                                            </li>
                                            <li>
                                                <a href="#details_tab2" class="" aria-controls="details_tab2"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Tour Cost</a>
                                            </li>
                                            <li>
                                                <a href="#terms_conditions" class=""
                                                    aria-controls="terms_conditions" role="tab" data-toggle="tab"
                                                    aria-expanded="true" aria-selected="true">Package Overview</a>
                                            </li>
                                            <li>
                                                <a href="#details_tab7" class="" aria-controls="details_tab7"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Inclusion / Exclusion</a>
                                            </li>
                                            <li>
                                                <a href="#details_tab8" class="" aria-controls="details_tab8"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Itinerary</a>
                                            </li>
                                            <li>
                                                <a href="#details_tab5" class="" aria-controls="details_tab5"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Payment Policy / Important Notes</a>
                                            </li>
                                            <li>
                                                <a href="#details_tab6" class="" aria-controls="details_tab6"
                                                    role="tab" data-toggle="tab" aria-expanded="false"
                                                    aria-selected="false">Cancellation Policy</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" style="padding-top: 20px;">
                                        <div role="tabpanel" class="tab-pane" id="terms_conditions">
                                            <div class="terms_list">

                                                {{-- {{ $packages->description }} --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="packageoverviewbox">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <h6>Flight &amp; Transport</h6>
                                                                <div class="infotxt">
                                                                    <span id="lblNoRecordFlightTransport"
                                                                        style="display: none;">No Record Found</span>
                                                                    {{-- <ul id="ulFlightTransport"><li>Pickup and Drop will be in SIC basis</li><li>All Ziyarats and Intercity transfer will be on SIC Basis</li><li> Air Tickets cost are not included </li></ul> --}}
                                                                    <ul>
                                                                        {!! $packages->flight_transport !!}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 293.64 293.43">
                                                                    <path
                                                                        d="M3,217.9c5.1-5,10.22-10,15.3-15,3.61-3.55,7.21-7.11,10.73-10.75a4.12,4.12,0,0,1,4.21-1.43c11.65,2.06,23.34,3.94,35,5.75a4.6,4.6,0,0,0,3.5-1q29.87-30.92,59.57-62c.25-.26.45-.58.93-1.19L9.36,56.66a17.64,17.64,0,0,0,3.1-1.92C21.21,46.06,30,37.4,38.57,28.58A4.48,4.48,0,0,1,44,27.28q54.27,18.07,108.61,36c10.59,3.51,21.2,7,31.75,10.59,2.38.83,3.85.57,5.66-1.34,19-19.92,38.07-39.72,57.1-59.6,5.69-5.95,12.54-9.26,20.8-9.36a27.81,27.81,0,0,1,26.21,17.12c4.57,11.22,3,21.83-5.49,30.5-11,11.27-22.61,22-34,32.87-9.15,8.81-18.29,17.64-27.53,26.35A3.83,3.83,0,0,0,226,115.1Q249.4,185.54,272.73,256c.77,2.32.53,3.7-1.25,5.43-8.82,8.61-17.49,17.36-26.17,26.11a19.9,19.9,0,0,0-1.95,3.11L167.65,167.7c-.9.81-1.66,1.47-2.38,2.17q-30.21,28.95-60.43,57.88a4.27,4.27,0,0,0-1.38,4.28c2,11.67,3.91,23.34,5.7,35A4.88,4.88,0,0,1,108,270.7c-7.95,8.13-16,16.13-24.06,24.18-.66.65-1.22,1.41-1.82,2.12h-.58a2.91,2.91,0,0,0,0-.84c-6.51-18.62-13-37.24-19.62-55.81a4.85,4.85,0,0,0-2.76-2.4q-17.88-6.42-35.85-12.62C16.52,223,9.75,220.76,3,218.48Z"
                                                                        transform="translate(-3 -3.57)"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="packageoverviewbox">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <h6>Meals</h6>
                                                                <div class="infotxt">
                                                                    <span id="lblNoRecordMeals"
                                                                        style="display: none;">No
                                                                        Record Found</span>
                                                                    {{-- <ul id="ulMeals"><li>Breakfast - 3</li><li>Lunch - 3</li><li>Dinner - 3</li></ul> --}}
                                                                    <ul>
                                                                        {!! $packages->meals !!}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <svg id="Svg6" data-name="Layer 1"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 287.48 286.82">
                                                                    <path
                                                                        d="M294,186.21c-1.11-.08-2.22-.23-3.33-.23-10.48,0-21,0-31.44,0-7,0-10.14-3.2-10.14-10.1q0-66.51,0-133A36.44,36.44,0,0,1,282.88,6.38C288.24,6,292,7.68,294,12.74Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                    <path
                                                                        d="M294,279.4c-.37.94-.74,1.88-1.1,2.82a16.79,16.79,0,0,1-18.6,10.66c-7.51-1.1-13.86-7.92-13.91-15.69-.14-24.3,0-48.6,0-72.89a1.76,1.76,0,0,1,.17-.52c.15-.1.29-.28.43-.28l33,.11Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                    <path
                                                                        d="M82.35,186c0-22.64,0-45.27,0-67.91a3.52,3.52,0,0,1,2.2-3.62c15-8.07,22.77-20.68,23.06-37.66.25-14.31.11-28.62,0-42.94,0-2.13.56-3.11,2.63-3.73,44-13.31,84.16-6.1,120.43,22.33,1.49,1.17,1.64,2.48,1.64,4.12,0,39.66,0,79.32-.06,119,0,9,3,16.4,10.05,22.1a3.72,3.72,0,0,1,1.17,2.56q.12,16.69,0,33.39a4.66,4.66,0,0,1-1.23,2.9q-45.06,46.16-109.13,38.52c-17.4-2.09-33.5-8.11-48.5-17.16a4,4,0,0,1-2.26-4C82.38,231.29,82.35,208.65,82.35,186Zm68-72.33c-.75-.64-1.32-1.11-1.87-1.59a34.55,34.55,0,0,0-47.49,2c-12.64,13.12-13,34.15-.37,47.26,14.31,14.79,29,29.2,43.6,43.72a8.22,8.22,0,0,0,12.08.08C171,190.5,186,176.09,200.2,161c9.93-10.55,11.82-23.49,6-36.77S189.5,104,174.82,103.66C165.39,103.47,157.34,107.07,150.32,113.68Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                    <path
                                                                        d="M31.82,119.3H65.28a16.46,16.46,0,0,1,.22,1.91q0,77.43,0,154.84a16.81,16.81,0,0,1-30.13,10.54,17.6,17.6,0,0,1-3.55-11.26q.06-33.79,0-67.6V119.3Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                    <path
                                                                        d="M57.09,68.46H73.93V65.25q0-24.69,0-49.4c0-6,4.78-10,10.33-8.74,4,.89,6.49,4.28,6.49,9q0,30.32,0,60.63a27.75,27.75,0,0,1-.45,4.73C88.32,92.78,79,101.63,67.6,102c-12.61.44-25.26.48-37.87,0S6.75,90.6,6.63,77.83c-.19-20.77-.09-41.54,0-62.31a8.4,8.4,0,1,1,16.8.06c.05,16.56,0,33.12,0,49.68v3.2H40.25V60.17c0-14.78,0-29.56,0-44.34,0-5.68,4.23-9.53,9.53-8.85,4.44.57,7.28,4.09,7.29,9.13q0,24.55,0,49.12Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                    <path
                                                                        d="M150.36,187.23c-.55-.47-1-.8-1.37-1.18-11.84-11.83-23.76-23.58-35.48-35.52-9.31-9.49-5.93-24.78,6.36-29.06A16.87,16.87,0,0,1,137.61,125c2.23,2,4.25,4.21,6.4,6.29,3.83,3.7,8.65,3.73,12.49.06,2.23-2.13,4.31-4.43,6.6-6.49a17.49,17.49,0,0,1,23.71.26c6.58,6.18,8,16.82,1.86,23.33C176.28,161.7,163.23,174.29,150.36,187.23Z"
                                                                        transform="translate(-6.52 -6.32)"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="packageoverviewbox">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <h6>Visa &amp; Taxes</h6>
                                                                <div class="infotxt">
                                                                    <span id="lblNoRecordVisa"
                                                                        style="display: none;">No
                                                                        Record Found</span>
                                                                    {{-- <ul id="ulVisa"><li>Umrah Visa &amp; Insurance are not included </li><li>No Taxes Are Not Included </li></ul> --}}
                                                                    <ul>
                                                                        {!! $packages->visa_taxes !!}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <svg id="Svg7" data-name="Layer 1"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 232.99 287.51">
                                                                    <path
                                                                        d="M255.26,6c.84.36,1.68.71,2.52,1.08,5.22,2.32,8.26,6.27,8.83,12,.13,1.3.12,2.61.12,3.92q0,126.75,0,253.48a26.76,26.76,0,0,1-.54,6.4,13.9,13.9,0,0,1-13.31,10.55c-10.85.13-21.71.08-32.57,0-4.15,0-6.32-3.25-4.68-7.09a36.13,36.13,0,0,0,2.63-14.49q-.06-94.32,0-188.64c0-14.64-8.62-25.92-22.32-29.12a36.88,36.88,0,0,0-8.06-.82c-13.1-.08-26.2,0-39.31,0-4.88,0-6.31-1.44-6.32-6.37,0-7.58.3-15.17-.09-22.73-.46-9,2.75-15.22,11.5-18.16H169.9c6.52,1.86,10.07,6.21,12,12.69,2.92,9.64,12.25,16,22.37,16,10.29,0,19.7-6.24,22.66-16,2-6.48,5.5-10.85,12-12.72ZM233.85,185.52v50a21.89,21.89,0,0,0,.06,2.81,4.35,4.35,0,0,0,4.19,4.15,4.3,4.3,0,0,0,5-3.2,12.28,12.28,0,0,0,.36-3.59q0-50,0-99.93a17.44,17.44,0,0,0-.1-2.8,4.68,4.68,0,0,0-5.2-4c-2.76.24-4.26,2.13-4.26,5.55Q233.83,160,233.85,185.52Zm0-83.7h0v5.61c0,.19,0,.38,0,.56a4.82,4.82,0,0,0,4.44,4.61,4.6,4.6,0,0,0,4.95-4,125.53,125.53,0,0,0,0-13.44,4.46,4.46,0,0,0-4.93-4,4.6,4.6,0,0,0-4.44,4.54C233.79,97.7,233.87,99.77,233.87,101.82Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M33.75,177.81q0-47.15,0-94.3c0-10.11,5.16-17.42,14.06-19.85a25.34,25.34,0,0,1,6.38-.78q66.94-.06,133.89,0c12.49,0,20.55,8.09,20.55,20.55q0,94.73,0,189.45c0,12.65-8,20.62-20.74,20.62H54.29c-12.53,0-20.51-7.94-20.52-20.52Q33.71,225.38,33.75,177.81Zm87.49,21a50.41,50.41,0,0,0,50.29-50.42c-.07-28.23-22.91-50.3-52-50.22-26.31.07-48.74,23.41-48.64,50.6A50.25,50.25,0,0,0,121.24,198.82Zm-.23,43.7c10.19,0,20.37,0,30.56,0,3.67,0,5.72-2,5.46-5.19-.22-2.69-2.22-4.34-5.53-4.36-7.1-.05-14.21,0-21.31,0-12.9,0-25.79,0-38.69,0-2.38,0-4.52.4-5.71,2.72-1.74,3.38.7,6.83,4.94,6.86C100.82,242.56,110.91,242.52,121,242.52Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M91.8,153.31c8.77,0,8.41.06,10.3,8.72,1.45,6.6,4,13,5.92,19.47a16.62,16.62,0,0,1,.17,4.13c-1.38,0-3,.32-4.11-.23a39.87,39.87,0,0,1-21.86-25.22c-1.21-4,.68-6.63,4.81-6.86C88.62,153.24,90.21,153.31,91.8,153.31Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M150.91,153.3c1.31,0,2.62,0,3.92,0,4.68.13,6.64,2.78,5.24,7.23a39.83,39.83,0,0,1-16,21.62,43.37,43.37,0,0,1-6.87,3.72,2.41,2.41,0,0,1-3.25-3.38A87.41,87.41,0,0,0,141,158.14c.47-3.54,2.08-4.73,5.72-4.83C148.11,153.27,149.51,153.3,150.91,153.3Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M91.55,143.66c-1.78,0-3.56.11-5.32,0a4.55,4.55,0,0,1-4.26-5.9,40,40,0,0,1,23.09-26.5c.84-.37,2.57-.27,3,.29a3.75,3.75,0,0,1,.3,3.27,85.66,85.66,0,0,0-7,24.64,4.5,4.5,0,0,1-4.73,4.24c-1.68.06-3.36,0-5,0Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M150.75,143.7c-7.21,0-8.86,1-10.53-8.48-1.19-6.8-4.05-13.31-6-20-.34-1.17-.43-2.86.19-3.71.41-.57,2.46-.48,3.47,0a39.89,39.89,0,0,1,22.26,25.19c1.37,4.27-.67,6.91-5.17,7C153.55,143.73,152.15,143.7,150.75,143.7Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M121.42,153.41a49.41,49.41,0,0,1,5.58,0,4.37,4.37,0,0,1,4.14,5,62.79,62.79,0,0,1-7.82,23.45c-1.16,2.06-3.21,2-4.38-.15a66,66,0,0,1-7.74-23.2c-.37-2.72,1.5-4.76,4.34-5.2a6,6,0,0,1,.84-.07h5Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                    <path
                                                                        d="M121.2,143.68c-1.78,0-3.56.08-5.33,0-3.1-.18-5.08-2.42-4.65-5.42a66.37,66.37,0,0,1,7.62-22.74c1.33-2.42,3.35-2.44,4.69,0a65.79,65.79,0,0,1,7.58,22.45c.52,3.6-1.43,5.64-5.13,5.76-1.59.05-3.19,0-4.78,0Z"
                                                                        transform="translate(-33.74 -6)"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="details_tab2">
                                            <div>
                                                <div class="mainheading">
                                                    <h6>People Sharing:</h6>
                                                </div>
                                                <div class="row gx-2" id="divTourCostPeopleSharing">
                                                    @if ($g_share !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg>+<svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Sharing</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($g_share, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($qt_share !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Quint</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($qt_share, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($qd_share !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Quad</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($qd_share, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($t_share !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Triple</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($t_share, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($d_share !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Double</div>
                                                                <div class="pricesmall">
                                                                    {{ number_format($d_share, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($single !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 212.47 279.47">
                                                                        <path
                                                                            d="M137.73,290c-5-.36-10-.67-14.94-1.1-20.37-1.78-40.4-5.07-59-14.15-7.08-3.45-13.68-7.65-18.58-14a8,8,0,0,1-1.71-4.62c.26-16.09.31-32.2,3.07-48.13,2-11.79,5.65-22.92,14.12-31.9,5.93-6.28,13.2-10.49,21.08-13.72,11.49-4.71,23.54-7.4,35.71-9.6a3.46,3.46,0,0,1,2.54.84c7.06,6.52,15.55,9.5,25,10.27s18.54-.34,26.93-5c2.67-1.48,5-3.6,7.54-5.32a4.05,4.05,0,0,1,2.55-.83c12.43,2.29,24.75,5,36.46,9.92,11.25,4.73,20.83,11.47,26.92,22.4A64.16,64.16,0,0,1,253.3,211c1.29,14.93,1.94,29.92,2.67,44.89a8,8,0,0,1-1.72,4.89c-6.43,8.07-15.21,12.84-24.52,16.68-17.16,7.08-35.23,10-53.6,11.46-4.61.37-9.23.72-13.84,1.08Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                        <path
                                                                            d="M93.61,73.89C93.86,63.42,94.68,53,97.89,43c5.93-18.64,19.06-28.53,38-31.32a86.56,86.56,0,0,1,34.63,1.46C185.71,17,196.27,26.34,200.9,41.22c6.41,20.62,7.58,41.69,1.1,62.54-5.48,17.62-15.9,31.7-33.27,39.31-16.36,7.16-32.22,5.21-46.8-4.91-14.88-10.33-23.1-25.16-26.61-42.6C93.9,88.49,93.69,81.17,92.93,74Z"
                                                                            transform="translate(-43.5 -10.55)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Single</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($single, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($child_with_bed !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 384 512">
                                                                        <path
                                                                            d="M120,72a72,72,0,1,1,72,72A72,72,0,0,1,120,72Zm254.63,1.37a32,32,0,0,0-45.26,0L242.74,160H141.25L54.63,73.37A32,32,0,0,0,9.37,118.63L104,213.25V480a32,32,0,0,0,32,32h16a32,32,0,0,0,32-32V368h16V480a32,32,0,0,0,32,32h16a32,32,0,0,0,32-32V213.25l94.63-94.62A32,32,0,0,0,374.63,73.37Z"
                                                                            transform="translate(0)"></path>
                                                                    </svg>+<svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 189.83 189.83">
                                                                        <path class="cls-1"
                                                                            d="M245,213.92V245H55.17V55.17H245v97.32c-.92,0-1.85-.06-2.77-.06H70.17c-2.41,0-2.41,0-2.41-2.42V86.68h-12V213.84h12v-2.32c0-9.5,0-19,0-28.49,0-1.66.5-2.06,2.1-2.06q80.48.06,161,0c1.68,0,2.05.55,2,2.12-.07,9.5,0,19,0,28.49v2.35ZM113.64,148.07H233.71c.49,0,1,0,1.48,0,1,.08,1.47-.29,1.45-1.35-.08-6.78,0-13.57-.26-20.34-.18-4.3-2.13-8-6.31-9.67a21.31,21.31,0,0,0-7.73-1.36q-47.34-.13-94.69,0c-1.11,0-2.22.07-3.33.16-5.92.5-10.17,4-10.56,9.94C113.27,132.82,113.64,140.29,113.64,148.07ZM71.38,131.74a17.1,17.1,0,0,0,34.2,0,17.1,17.1,0,1,0-34.2,0Z"
                                                                            transform="translate(-55.17 -55.17)">
                                                                        </path>
                                                                        <path
                                                                            d="M245,213.92H232.78v-2.35c0-9.49,0-19,0-28.49,0-1.57-.36-2.12-2-2.12q-80.49.07-161,0c-1.6,0-2.11.4-2.1,2.06.08,9.49,0,19,0,28.49v2.32h-12V86.68h12V150c0,2.42,0,2.42,2.41,2.42H242.23c.92,0,1.85,0,2.77.06Z"
                                                                            transform="translate(-55.17 -55.17)">
                                                                        </path>
                                                                        <path
                                                                            d="M113.64,148.07c0-7.78-.37-15.25.12-22.67.39-5.94,4.64-9.44,10.56-9.94,1.11-.09,2.22-.16,3.33-.16q47.34,0,94.69,0a21.31,21.31,0,0,1,7.73,1.36c4.18,1.67,6.13,5.37,6.31,9.67.29,6.77.18,13.56.26,20.34,0,1.06-.45,1.43-1.45,1.35-.49,0-1,0-1.48,0H113.64Z"
                                                                            transform="translate(-55.17 -55.17)">
                                                                        </path>
                                                                        <path
                                                                            d="M71.38,131.74a17.1,17.1,0,1,1,17.17,17.07A17.2,17.2,0,0,1,71.38,131.74Z"
                                                                            transform="translate(-55.17 -55.17)">
                                                                        </path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Child with Bed</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($child_with_bed, 2) }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($child_no_bed !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 384 512">
                                                                        <path
                                                                            d="M120,72a72,72,0,1,1,72,72A72,72,0,0,1,120,72Zm254.63,1.37a32,32,0,0,0-45.26,0L242.74,160H141.25L54.63,73.37A32,32,0,0,0,9.37,118.63L104,213.25V480a32,32,0,0,0,32,32h16a32,32,0,0,0,32-32V368h16V480a32,32,0,0,0,32,32h16a32,32,0,0,0,32-32V213.25l94.63-94.62A32,32,0,0,0,374.63,73.37Z"
                                                                            transform="translate(0)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Child without Bed</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($child_no_bed, 2) }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($infant !== 0)
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                            <div class="peoplesharebox">
                                                                <div class="peopleshareicon"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 274.25 199.07">
                                                                        <path
                                                                            d="M13,224.05c.72-2.73,1.25-5.53,2.21-8.17C18,208.19,23.78,204.27,32,204.27H63c-1.13-1.46-1.71-2.36-2.43-3.12-7.86-8.24-14.13-17.42-17.3-28.52A43.94,43.94,0,0,1,64.61,122.2a54.6,54.6,0,0,1,26.65-6.7q33.6,0,67.2,0c8.25,0,16.18,1.3,23.1,6.26a24.5,24.5,0,0,1,9.34,12.38q14.7,44.38,29.35,88.81c2.45,7.43,2.54,14.8-3.84,20.22-10.5,8.92-26.5,10.31-34.52-6.34-4.61-9.55-8.74-19.32-12.93-29.06a4.08,4.08,0,0,0-4.42-2.86c-15.62.08-31.23,0-46.85,0-4.74,0-6.08,1.44-6.16,6.29-.1,6.69.07,13.4-.5,20-.9,10.43-8.18,16.76-18.61,16.77q-30.39,0-60.78,0c-9.53,0-16-5.24-18.1-14.53a11,11,0,0,0-.54-1.45Z"
                                                                            transform="translate(-13 -50.6)"></path>
                                                                        <path
                                                                            d="M239.67,50.6a47.59,47.59,0,1,1-47.48,47.56A47.72,47.72,0,0,1,239.67,50.6Z"
                                                                            transform="translate(-13 -50.6)"></path>
                                                                    </svg></div>
                                                                <div class="peoplesharetext">Infant</div>
                                                                <div class="pricesmall">INR
                                                                    {{ number_format($infant, 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane active" id="details_tab3">
                                            <div class="packagehotelarea">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="packagehotelbox">
                                                            <div>
                                                                <div>
                                                                    <div class="packagehotelboximg">
                                                                        @if ($makkahotel && $makkahotel->hotelimage->first())
                                                                            <img src="{{ asset('storage/hotel_photo/' . $makkahotel->hotelimage->first()->hotel_img) }}"
                                                                                alt="Image" title=""
                                                                                border="0">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="packagehotelboxname"
                                                                        style="align-items: center;">
                                                                        <h5><a href="{{ route('hotelDetail', ['id' => $makkahotel->id]) }}"
                                                                                target="_blank">{{ $makkahotel->hotel_name ?? '' }}
                                                                                (Makkah)</a>
                                                                        </h5>
                                                                        <div
                                                                            style="display: table-cell;vertical-align: middle;">
                                                                            <div class="star-rating mt-2">
                                                                                @if (is_numeric($makkahotel->star_rating))
                                                                                    <span class="repeating-stars"
                                                                                        style="display: flex;">
                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                            @if ($i <= $makkahotel->star_rating)
                                                                                                <i
                                                                                                    class="fa fa-star"></i>
                                                                                            @endif
                                                                                        @endfor
                                                                                    </span>
                                                                                @else
                                                                                    <span>{{ $makkahotel->star_rating }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="packagehotelbox">
                                                            <div>
                                                                <div>
                                                                    <div class="packagehotelboximg">
                                                                        @if ($madinahotel && $madinahotel->hotelimage->first())
                                                                            <img src="{{ asset('storage/hotel_photo/' . $madinahotel->hotelimage->first()->hotel_img) }}"
                                                                                alt="Image" title=""
                                                                                border="0">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="packagehotelboxname"
                                                                        style="align-items: center;">
                                                                        <h5><a href="{{ route('hotelDetail', ['id' => $madinahotel->id]) }}"
                                                                                target="_blank">{{ $madinahotel->hotel_name ?? '' }}
                                                                                (Madinah)</a>
                                                                        </h5>
                                                                        <div
                                                                            style="display: table-cell;vertical-align: middle;">
                                                                            <div class="star-rating mt-2">
                                                                                @if (is_numeric($madinahotel->star_rating))
                                                                                    <span class="repeating-stars"
                                                                                        style="display: flex;">
                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                            @if ($i <= $madinahotel->star_rating)
                                                                                                <i
                                                                                                    class="fa fa-star"></i>
                                                                                            @endif
                                                                                        @endfor
                                                                                    </span>
                                                                                @else
                                                                                    <span>{{ $madinahotel->star_rating }}</span>
                                                                                @endif
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
                                        <div role="tabpanel" class="tab-pane" id="details_tab4">
                                            <div class="inclusionicons" id="divIncludes">
                                                <ul id="ulIncludes">
                                                    @foreach ($pkgIncludes as $item)
                                                        @if (isset($allIncludes[$item]))
                                                            <li>
                                                                <div class="text-center">
                                                                    {!! $allIncludes[$item] !!}<br>{{ $item }}
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="details_tab5">
                                            <div class="row">
                                                <div class="col-6 infotxt packagebox" id="">
                                                    <h4>Payment Policy</h4>
                                                    <ul>
                                                        {!! $packages->payment_policy !!}
                                                    </ul>
                                                </div>
                                                <div class="col-6 infotxt packagebox" id="">
                                                    <h4>Important Notes</h4>
                                                    <ul>
                                                        {!! $packages->important_notes !!}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="details_tab7">
                                            <div class="inclusionicons" id="divIncludes">
                                                <ul id="ulIncludes">
                                                    @foreach ($pkgIncludes as $item)
                                                        @if (isset($allIncludes[$item]))
                                                            <li>
                                                                <div class="text-center">
                                                                    {!! $allIncludes[$item] !!}<br>{{ $item }}
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            {{-- <div class="arrive-box"> --}}
                                            <div class="row mt-2">
                                                <div class="col-6 infotxt" id="">
                                                    <div class="packagebox packagehotelbox">
                                                        <h4>Inclusion</h4>
                                                        {!! $packages->inclusion !!}
                                                    </div>
                                                </div>
                                                <div class="col-6 infotxt" id="">
                                                    <div class="packagebox packagehotelbox">
                                                        <h4>Exclusion</h4>
                                                        <ul>
                                                            {!! $packages->exclusion !!}
                                                        </ul>
                                                    </div>
                                                </div>
                                                {{-- </div> --}}
                                            </div>

                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="details_tab8">
                                            <div class="row">
                                                <div class="col-12 infotxt packagebox" id="">
                                                    <h4>Itinerary</h4>
                                                    {!! $packages->itinerary !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="details_tab6">
                                            <div class="row">
                                                <div class="col-12 infotxt packagebox" id="">
                                                    <h4>Cancellation Policy</h4>
                                                    <ul>
                                                        {!! $packages->cancellation_policy !!}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
    @livewire(
        'user.pages.hajj-package-view-modal-component',
        [
            'id' => $packageId,
            'travel_date' => $travel_date,
            'city' => $city_id,
            'airline_id' => $airline_id,
            'flavour_id' => $selectedPackageFlavourId
        ],
        key($packageId . $travel_date . $city_id . $airline_id . $selectedPackageFlavourId)
    )
</div>
@push('extra_js')
    <script>
        document.addEventListener('livewire:initialized', function() {
            window.addEventListener('reload-page', function() {
                setTimeout(() => {
                    location.reload();
                }, 4000);
            });
        });
    </script>
@endpush

@push('extra_css')
    <style>
        .fAWLEZ {
            position: inherit;
        }

        .packageformbox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            padding: 15px 15px;
            border-radius: 6px;
            box-shadow: 0px 4px 10px rgba(246, 111, 104, 0.2);
        }

        .packagehighgalarea h2 {
            font-size: 30px;
            color: #1e1e1e;
            line-height: 30px;
            font-weight: 500;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .packagehighgalarea h3 {
            font-size: 24px;
            color: #1e1e1e;
            line-height: 24px;
            font-weight: 500;
            margin-top: 0px;
            margin-bottom: 5px;
        }

        .packagedetpricebox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            padding: 15px 15px;
            border-radius: 6px;
            margin: 20px 0px;
            box-shadow: 0px 4px 10px rgba(246, 111, 104, 0.2);
        }

        .packagedetpricebox .form-control {
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.2);
        }

        .price {
            font-size: 18px;
            color: #d80000;
            line-height: 18px;
            position: relative;
            bottom: 0px;
            right: 0px;
            background: transparent;
            padding: 0px;
            text-align: left;
        }

        .pricefromtext {
            font-size: 12px;
            color: #2d2d2d;
            line-height: 16px;
            font-weight: 400;
        }

        .downloaditnerybtn {
            padding: 10px 20px;
            font-size: 15px;
            color: #fff;
            text-align: center;
            border: solid 0px #b49164;
            background: #b49164;
            border-radius: 5px;
            transition: 0.4s;
        }

        .downloaditnerybtn:hover,
        .downloaditnerybtn:focus,
        .downloaditnerybtn.focus {
            background: #4A4A4A;
            color: #fff;
            text-decoration: none;
        }

        .primarybtnborder {
            padding: 8px 15px;
            font-size: 14px;
            color: #b49164;
            text-align: center;
            border: solid 1px #b49164;
            background: none;
            border-radius: 5px;
            transition: 0.4s;
        }

        .primarybtnborder:hover,
        .primarybtnborder:focus,
        .primarybtnborder.focus {
            background: #b49164;
            border: solid 1px #b49164;
            color: #ffffff;
            text-decoration: none;
        }


        .packageoverviewbox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            padding: 15px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            min-height: 150px;
            transition: all ease-in 0.4s;
        }

        .packageoverviewbox h6 {
            font-size: 18px;
            color: #b23670;
            line-height: 20px;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .packageoverviewbox svg {
            fill: #f7d0e4;
            width: 60px;
        }

        .packageoverviewbox:hover {
            box-shadow: 0px 4px 10px rgba(246, 111, 104, 0.2);
        }

        .plane-flw {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
            transform: rotate(-45deg);
            color: #be5486;
        }

        .packagehotelarea {
            margin-bottom: 20px;
        }

        .packagehoteldatelabel {
            position: relative;
            background: #2b9dff;
            display: inline-block;
            padding: 2px 7px;
            font-size: 12px;
            color: #fff;
            z-index: 11;
            font-weight: 500;
            text-align: center;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .packagehoteldatelabel:before {
            position: absolute;
            bottom: -7px;
            left: 7px;
            content: '';
            width: 0;
            height: 0;
            border-left: 7px solid #2b9dff;
            border-right: 7px solid transparent;
            border-bottom: 7px solid transparent;
            transform: rotate(0deg);
        }

        .packagehotelbox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            padding: 10px 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            transition: all ease-in 0.4s;
        }

        .packagebox h4 {
            color: #9a774b;
        }

        .packagehotelbox:hover {
            box-shadow: 0px 4px 10px rgba(246, 111, 104, 0.2);
        }

        .packagehotelboximg {
            width: 100%;
            height: 250px;
            border-radius: 5px;
        }

        .packagehotelboximg img {
            width: 100%;
            height: 100%;
            border-radius: 5px;
            object-fit: cover;
            object-position: 50% 50%;
        }

        .packagehotelboxname {
            width: 100%;
            height: 60px;
            display: table;
            padding-left: 10px;
        }

        .packagehotelboxname h5 {
            font-size: 20px;
            color: #1e1e1e;
            line-height: 18px;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 0px;
            display: table-cell;
            vertical-align: middle;
        }

        .packagehotelboxname h5 a {
            color: #1e1e1e;
            text-decoration: none;
        }

        .packagehotelboxname h5 a:hover {
            color: #b49164;
            text-decoration: none;
        }

        .packagehotelboxname h5 span {
            font-size: 13px;
            color: #6d6d6d;
            font-weight: 400;
        }

        .packagehotelcitynights {
            margin: 0px;
            text-align: right;
        }

        .packagehotelcitynights ul {
            margin: 0px 0px;
            padding: 0px 0px;
        }

        .packagehotelcitynights ul li {
            display: inline-block;
            list-style-type: none;
            margin: 0px 0px;
            padding: 20px 15px 0px 15px;
            border-left: solid 1px #efdebf;
            font-size: 13px;
            color: #000;
            line-height: 16px;
            min-height: 60px;
        }

        .packagehotelcitynights ul li:last-child {
            padding: 20px 0px 0px 15px;
        }

        .packagehotelcitynights ul li span {
            color: #b49164;
            font-weight: 600;
        }

        .packagehotelcitynights ul li svg {
            fill: #1e1e1e;
            height: 18px;
            vertical-align: middle;
            margin-right: 2px;
        }

        .mainheading h6 {
            font-size: 16px;
            color: #2b2a29;
            line-height: 18px;
            font-weight: 500;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .peoplesharebox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: center;
            padding: 15px 5px;
            min-height: 100px;
        }

        .peopleshareicon {
            margin: 0px;
            font-size: 14px;
            color: #9a9a9a;
            display: flex;
            justify-content: center;
        }

        .peopleshareicon svg {
            height: 17px;
            fill: #b49164;
        }

        .peoplesharetext {
            font-size: 13px;
            color: #000;
            line-height: 18px;
            margin: 5px 0px;
        }

        .pricesmall {
            font-size: 16px;
            color: #d80000;
            line-height: 16px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .gx-2.row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .gx-2.row [class^="col-"] {
            padding-left: 5px;
            padding-right: 5px;
        }

        .tabnav .nav-tabs {
            border-bottom: 0px solid #dee2e6;
            background: #000;
        }

        .tabnav .nav-tabs>li>a {
            color: #ffffff;
        }

        .tabnav .nav-tabs>li>a.active,
        .tabnav .nav-tabs>li>a.active :focus,
        .tabnav .nav-tabs>li>a.active:hover {
            color: #ffffff;
            background: rgb(180, 145, 100);
            border-bottom: transparent;
        }

        .inclusionicons {
            margin: 0px;
        }

        .inclusionicons ul {
            margin: 0px 0px;
            padding: 0px 0px;
        }

        .inclusionicons ul li {
            list-style-type: none;
            margin: 10px 5px 0px 10px;
            display: inline-block;
            font-size: 14px;
            font-weight: 700;
            color: #7a7b7d;
            line-height: 20px;
            text-align: center;
            position: relative;
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            border-radius: 6px;
            padding: 15px 20px;
        }

        .inclusionicons ul li:first-child {
            margin: 0px 10px 0px 0px;
        }

        .inclusionicons ul li::after {
            content: "\002B";
            font-size: 18px;
            color: #717171;
            position: absolute;
            display: block;
            right: -17px;
            top: 50%;
            margin-top: -9px;
        }

        .inclusionicons ul li:last-child::after {
            content: none;
        }

        .inclusionicons ul li svg {
            height: 50px;
            width: 50px;
            fill: #b49164;
            display: inline-block;
        }

        .inclusionicons ul li svg polygon,
        .inclusionicons ul li svg line,
        .inclusionicons ul li svg circle {
            stroke: #b49164;
            fill: #b49164;
        }

        .inclusionicons ul li svg path {
            stroke: #b49164;
        }

        .select-paln-box {
            position: relative;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .16);
            z-index: 1
        }

        .select-paln-box:after {
            content: "";
            width: 1px;
            height: calc(100% - 2px);
            background: #e2e2e2;
            position: absolute;
            left: 50px;
            top: 1px
        }

        .select-paln-box input[type=radio] {
            width: 0;
            height: 0;
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0
        }

        .select-paln-box .check-mark {
            width: 20px;
            height: 20px;
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            border: 1px solid rgb(180, 145, 100);
            border-radius: 50%;
            z-index: -1
        }

        .paln-label {
            width: 100%;
            position: relative;
            margin-bottom: 0;
            padding: 15px 15px 15px 65px;
            border: 1px solid #e2e2e2;
            border-radius: 10px
        }

        .paln-label p {
            color: rgb(180, 145, 100);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 0;
            line-height: 1.2
        }

        .paln-label span {
            color: #3c49c9;
            font-size: 14px;
            font-weight: 400
        }

        .paln-label .info {
            position: absolute;
            right: 5px;
            bottom: 0;
            color: #44b4f8;
            font-size: 14px;
            font-weight: 400
        }

        .select-paln-box input:checked~.paln-label {
            border: 1px solid rgb(180, 145, 100);
        }

        .select-paln-box input:checked~.paln-label:after {
            content: "";
            width: 25px;
            height: 25px;
            position: absolute;
            right: -10px;
            top: -10px;
            background: url("{{ asset('assets/user/images/plan-check-mark.png') }}") no-repeat
        }

        .select-paln-box input:checked~.check-mark:after {
            content: "";
            width: 12px;
            height: 12px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgb(180, 145, 100);
            border-radius: 50%
        }

        .select-paln-box.payment-system {
            display: inline-block
        }

        .select-paln-box.payment-system:after {
            display: none
        }

        .select-paln-box.payment-system .paln-label {
            padding-left: 15px
        }

        /* package over view */
        .packageoverviewbox {
            background: #fff8f4;
            border: solid 1px #fbe3e1;
            padding: 15px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            min-height: 150px;
            transition: all ease-in 0.4s;
        }

        .packageoverviewbox h6 {
            font-size: 18px;
            color: #9a774b;
            line-height: 20px;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        .packageoverviewbox svg {
            fill: #9a774b;
            width: 60px;
        }

        .packageoverviewbox:hover {
            box-shadow: 0px 4px 10px rgba(246, 111, 104, 0.2);
        }

        .plane-flw {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
            transform: rotate(-45deg);
            color: #9a774b;
        }

        .infotxt {
            color: #000;
            font-size: 15px;
            line-height: 24px;
        }

        .infotxt a {
            color: #000;
            text-decoration: none;
        }

        .infotxt a:hover {
            color: #12086e;
            text-decoration: none;
        }

        .infotxt ul {
            margin: 0px 0px 0px 14px;
            padding: 0px 0px 0px 0px;
            list-style: none;
            /* Remove default bullet */
        }

        .infotxt ul li {
            margin: 0px 0px;
            padding: 5px 0px;
            padding-left: 25px;
            line-height: 24px;
            color: #000;
            text-align: left;
            position: relative;
        }

        .infotxt ul li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 9px;
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M6.854 3.646a.5.5 0 0 1 .707 0l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L10.293 8 6.854 4.354a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endpush
