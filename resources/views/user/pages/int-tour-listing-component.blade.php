<div>
    <main class="cAJbgc shortinnerheader" style="margin-top: 0px;">
        <section id="inner_banner"
            style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
            <div class="container">
            </div>
        </section>
        <section class="listing-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="filter-sec shadow filter-box-package">
                            <div class="filter-title">
                                <div class="fl-title filter-result">
                                    {{ count($tours) }} packages
                                </div>
                                <span class="fl-txt">Filter</span>
                                <button href="javascript:void(0);" class="fl-btn"><i class="fa fa-undo"></i>
                                    Reset</button>
                            </div>
                            <div class="form-packagesearch">
                                <div class="filter_type">
                                    <input type="search" class="form-control" name="search"
                                        placeholder="Search by Package Name" autocomplete="off"
                                        wire:model='search_tours' wire:keyup="changeInput">
                                </div>
                            </div>
                            <div class="fl-checkbox fl-checkbox_list1 filter_heightauto">
                                <div class="fl-title">Number of Nights</div>
                                <div class="filter-height">
                                    @foreach ($selectedFlavourNights as $k => $night)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input filtercheckbox filter-nn"
                                                id="inlineChecknight{{ $k }}" value="{{ $night }}"
                                                autocomplete="off" wire:change="changeInput"
                                                wire:model="selectedNights">
                                            <label class="custom-control-label"
                                                for="inlineChecknight{{ $k }}">{{ $night }}
                                                Nights</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                                <div class="fl-title">Category</div>
                                <div class="filter-height">
                                    @foreach ($filter_themes as $theme_id => $theme_name)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input filtercheckbox filter-nn"
                                                id="Checktheme{{ $theme_id }}" value="{{ $theme_id }}"
                                                autocomplete="off" wire:model="selectedThemes"
                                                wire:change="changeInput">
                                            <label class="custom-control-label"
                                                for="Checktheme{{ $theme_id }}">{{ $theme_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="fl-checkbox fl-checkbox_list2 filter_heightauto">
                                <div class="fl-title">Destination</div>
                                <div class="filter-height">
                                    @foreach ($filter_destinations as $destionation_id => $destination_name)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input filtercheckbox filter-nn"
                                                id="CheckDestination{{ $destionation_id }}"
                                                value="{{ $destionation_id }}" autocomplete="off"
                                                wire:model="selectedDestinations"wire:change="changeInput">
                                            <label class="custom-control-label"
                                                for="CheckDestination{{ $destionation_id }}">{{ $destination_name }}</label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                        <div>
                            @forelse($tours as $key => $tour)
                                <div class="fl-list-show">
                                    <div class="fl-list-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="fl-img liting-img">
                                                    <a href="{{ route('intTourDetails', $tour->slug) }}">
                                                        <img src="{{ asset('storage/domestic_tour_image/' . $tour->tourImages[0]->tour_img) }}"
                                                            title="" border="0">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-box">
                                                    <span class="listbox-title">
                                                        <a
                                                            href{{ route('intTourDetails', $tour->slug) }}">{{ $tour->name }}</a>
                                                    </span>
                                                    <div class="list-detail-inner">
                                                        <span><strong> {{ $selectedFlavourNights[$key] + 1 }}
                                                                <span>Days</span>, {{ $selectedFlavourNights[$key] }}
                                                                <span>Nights</span></strong></span>
                                                    </div>
                                                    {{-- Destinations --}}
                                                    <div class="list-detail">
                                                        <span class="list-detail-width">
                                                            <strong>Destinations -</strong>
                                                            @php
                                                                $destination_name = [];
                                                                $destination_ids = explode(',', $tour->destination);
                                                                foreach ($destinations as $destination) {
                                                                    if (in_array($destination->id, $destination_ids)) {
                                                                        $destination_name[] = $destination->name;
                                                                    }
                                                                }

                                                                $include_ids = explode(',', $tour->includes);
                                                            @endphp
                                                            <span class="italic">
                                                                {{ implode(',', $destination_name) }}</span>

                                                        </span>
                                                        {{-- Includes --}}
                                                        <span class="list-detail-included">
                                                            <strong>Included -</strong>
                                                            @foreach ($include_ids as $include_id)
                                                                @if ($include_id == 1)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Hotel">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/hotel.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 2)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Breakfast & Dinner"> <span
                                                                            class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/breakfast-&-dinner.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 3)
                                                                    <span class="inclusion-list-item mr-0 "
                                                                        title="Welcome Drink">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/welcome-drink.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 4)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Intercity Transfer">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/intercity-transfers.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 5)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Activity">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/activity.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 6)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Sightseeing">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/sightseeing.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 7)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Guided Tours">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/guided-tours.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 8)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Bonfire">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/bonfire.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 9)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Pool Party">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/pool-party.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                                @if ($include_id == 10)
                                                                    <span class="inclusion-list-item mr-0"
                                                                        title="Speed Boat">
                                                                        <span class="inclusion-icon">
                                                                            <img
                                                                                src="{{ asset('assets/user-front/images/inclusion/speed-boat.png') }}">
                                                                        </span>
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </span>

                                                        @php
                                                            $theme_names = [];
                                                            $theme_ids = explode(',', $tour->categories);
                                                            foreach ($themes as $theme) {
                                                                if (in_array($theme->id, $theme_ids)) {
                                                                    $theme_names[] = $theme->cat_name;
                                                                }
                                                            }
                                                            // dd($themes);
                                                        @endphp
                                                        <span class="list-detail-themes">
                                                            <strong>Themes -</strong>
                                                            <span> {{ implode(',', $theme_names) }}</span>
                                                        </span>
                                                    </div>

                                                    <div class="detail-right">
                                                        {{-- <div class="dropdown selectroom_cls-box">
                                                            <label class="labeltxt labeltxtright_align"
                                                                for="rooms">Category :</label>
                                                            <select
                                                                wire:change="selectedflavour($event.target.value, {{ $key }})"
                                                                name="hotelTypeElement_274"
                                                                class="sltcat form-control select_box_wth">
                                                                @foreach ($flavour[$key] as $details)
                                                                    <option value="{{ $details['tour_type_id'] }}">
                                                                        {{ $details['tour_type_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                        <div class="dropdown selectroom_cls-box">
                                                            <label class="labeltxt labeltxtright_align"
                                                                for="rooms">Category :</label>
                                                            <select
                                                                wire:change="selectedflavour($event.target.value, {{ $key }})"
                                                                name="hotelTypeElement_274"
                                                                class="sltcat form-control select_box_wth">
                                                                @foreach ($flavour[$key] as $details)
                                                                    <option value="{{ $details['tour_type_id'] }}"
                                                                        data-key={{ $key }}
                                                                        {{ !empty($selectedTourTypes) && $selectedTourTypes == $details['tour_type_id'] ? 'selected' : '' }}>
                                                                        {{ $details['tour_type_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dt-1 mobilestartfrm">Starting from</div>
                                                        <div class="dt-2 mobile_price">
                                                            <strong>
                                                                <span>₹</span>
                                                                <span class="pkgprice_html_274 changedPrice_274">
                                                                    {{ number_format($selectedFlavourPrice[$key], 2) }}</span>
                                                            </strong>
                                                        </div>
                                                        <div class="dt-txt mobileperson">
                                                            <div class="dt-txt mobileperson">
                                                                Per Person
                                                            </div>
                                                        </div>
                                                        <div class="sharelist">
                                                            <div class="mt-2">
                                                                <div class="bbb">
                                                                    <a class="mdr svmdr detail_link detailbtn-mobile detail_link_274"
                                                                        href="{{ route('intTourDetails', $tour->slug) }}">View
                                                                        Details</a>
                                                                    <a id="estinamtebtnid"
                                                                        class="estimate-btn sendRateEnuiryPackagetour"
                                                                        href="javascript:void(0);">Get offer</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No tours Found</p>
                            @endforelse
                        </div>
                        @if (session('international_tour'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="color: #1d6119;border: 1px solid #1d6119;">
                                {!! session('international_tour') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="color: #1d6119;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <!-- Contact Form -->
                            <div class="col-md-12">
                                <h4>Lets help you plan your trip </h4>
                                <div class="well well-sm contactus">
                                    <form wire:submit.prevent='save'>
                                        <div class="row">
                                            <div class="col-sm-3 col-xl-2 col-2">
                                                <div class="form-group">
                                                    <select
                                                        class="custom-select form-control @error('title')  validation-border @enderror"
                                                        name="title " id="title" wire:model.live="title">
                                                        <option value="" selected>Choose</option>
                                                        <option value="1">Mr.</option>
                                                        <option value="2">Mrs</option>
                                                        <option value="3">Miss</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-5 col-8">
                                                <div class="form-group">
                                                    <input type="text" name="f_name" id="f_name"
                                                        class="form-control  @error('f_name')  validation-border @enderror"
                                                        placeholder="First Name" wire:model.live="f_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-5 col-8">
                                                <div class="form-group">
                                                    <input type="text" name="l_name" id="l_name"
                                                        class="form-control  @error('l_name')  validation-border @enderror"
                                                        placeholder="Last Name" wire:model.live="l_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control  @error('mob_num')  validation-border @enderror"
                                                        placeholder="Mobile" name="mob_num" id="mob_num"
                                                        maxlength="10" wire:model.live="mob_num">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="email_id" id="email_id"
                                                        class="form-control @error('email_id')  validation-border @enderror"
                                                        placeholder="Email Address" wire:model.live="email_id">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-xl-3 col-3">
                                                <div class="form-group">
                                                    <div class=" date bindcalendar">
                                                        <input type="date"
                                                            class="form-control  @error('travel_date')  validation-border @enderror"
                                                            name="travel_date" id="travel_date"
                                                            wire:model.live="travel_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-xl-3 col-3">
                                                <div class="form-group">
                                                    <input type="text" name="destination" id="destination"
                                                        class="form-control  @error('destination')  validation-border @enderror"
                                                        placeholder="Destination" wire:model.live="destination">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xl-2 col-2">
                                                <div class="form-group">
                                                    <select
                                                        class="custom-select form-control @error('adults')  validation-border @enderror"
                                                        name="adults " id="adults" wire:model.live="adults">
                                                        <option value="" selected>Select Adults</option>
                                                        @for ($i = 1; $i <= 50; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xl-2 col-2">
                                                <div class="form-group">
                                                    <select
                                                        class="custom-select form-control @error('children')  validation-border @enderror"
                                                        name="children " id="children" wire:model.live="children">
                                                        <option value="" selected>Select Children</option>
                                                        @for ($i = 1; $i <= 50; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xl-2 col-2">
                                                <div class="form-group">
                                                    <select
                                                        class="custom-select form-control @error('infants')  validation-border @enderror"
                                                        name="infants " id="infants" wire:model.live="infants">
                                                        <option value="" selected>Select Infants</option>
                                                        @for ($i = 1; $i <= 50; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea class="form-control @error('remarks')  validation-border @enderror" name="remarks" id="remarks"
                                                        placeholder="Remarks" wire:model.live="remarks" style="height: 100px"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6"
                                                style="display: flex;align-items:flex-start;">
                                                <input type="text" wire:model="userInput"
                                                    class="form-control @error('userInput')  validation-border @enderror"
                                                    placeholder="Enter CAPTCHA">
                                                <img src="data:image/jpeg;base64,{{ $captchaImage }}"
                                                    alt="Captcha Image">
                                                <button wire:click="generateCaptcha" type="button"> <i
                                                        class="fa fa-refresh"></i></button>
                                            </div>
                                            <div class="col-md-12" style="text-align:right;">
                                                <button type="submit" class="submit-btn">Request a
                                                    callback</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
