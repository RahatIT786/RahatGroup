<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="settings-widget profile-details">
                                    <div class="settings-menu p-0">
                                        <div class="profile-heading">
                                            <h3 class="m-0">Add Bookings</h3>
                                        </div>
                                        <div class="checkout-form personal-address add-course-info">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.service_type') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" wire:change="packageDetialsChange"
                                                            wire:model="service_type_id" name="service_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.service_type') }}</option>
                                                            @foreach ($serviceType as $service_type)
                                                                <option value="{{ $service_type->id }}">
                                                                    {{ $service_type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('service_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>{{ __('tablevars.package_pnr_details') }}<span class="text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- umrah --}}
                                            @if ($service_type_id == 2 || $service_type_id == 6 || $service_type_id == 8 || $service_type_id == 10)
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.departure_city') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model="city_id"
                                                            wire:change="getPnrList" name="city_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.departure_city') }}</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">
                                                                    {{ $city->city_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.departure_month') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model="month_id"
                                                            name="dept_month_id" wire:change="getPnrList">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.departure_month') }}</option>
                                                            @foreach ($months as $key => $val)
                                                                <option value="{{ $key }}">
                                                                    {{ $val }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('month_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.pkg_pnr') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model='pnr_id'
                                                            wire:change='getPkgDays' name="pnr_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.date') }}</option>
                                                            @if ($pnrList)
                                                                @foreach ($pnrList as $pnr)
                                                                    <option value="{{ $pnr->id }}">
                                                                        {{ $pnr->pnr_code }}
                                                                        Seats-{{ $pnr->avai_seats }}
                                                                        ({{ $pnr->dept_date }})
                                                                        - {{ $pnr->supp_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('pnr_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.package') }}
                                                            {{ __('tablevars.name') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" wire:model='pkg_name_id'
                                                            wire:change='getTotalPkgPrice' name="pkg_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.package') }}
                                                                {{ __('tablevars.name') }}</option>
                                                            @foreach ($packageMaster as $pkg)
                                                                <option value="{{ $pkg->id }}">
                                                                    {{ $pkg->package_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('pkg_name_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.package') }}
                                                            {{ __('tablevars.type') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="pkg_type_id"
                                                            wire:model='pkg_type_id'>
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.package') }}
                                                                {{ __('tablevars.type') }}</option>
                                                            @foreach ($packageType as $package_type)
                                                                <option value="{{ $package_type->package_type }}">
                                                                    {{ $package_type->package_type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('pkg_type_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.sharing') }}
                                                            {{ __('tablevars.type') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="sharing_type"
                                                            wire:model='sharing_type'>
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.sharing') }}
                                                                {{ __('tablevars.type') }}</option>
                                                            @foreach ($sharingType as $sharing_type)
                                                                <option value="{{ $sharing_type->id }}">
                                                                    {{ $sharing_type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('sharing_type_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.package') }}
                                                            {{ __('tablevars.days') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" readonly disabled
                                                            wire:model='pkg_days' name="pkg_days"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                            maxlength="3">
                                                    </div>
                                                </div>
                                            @elseif($service_type_id == 11)
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.departure_city') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" wire:model="city_id"
                                                            wire:change="getPnrList" name="city_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.departure_city') }}</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">
                                                                    {{ $city->city_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.departure_month') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" wire:model="month_id"
                                                            wire:change="getPnrList" name="dept_month_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.departure_month') }}</option>
                                                            @foreach ($months as $key => $val)
                                                                <option value="{{ $key }}">
                                                                    {{ $val }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('month_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.pkg_pnr') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" wire:model='pnr_id'
                                                            wire:change='getPkgDays' name="pnr_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.date') }}</option>
                                                            @if ($pnrList)
                                                                @foreach ($pnrList as $pnr)
                                                                    <option value="{{ $pnr->id }}">
                                                                        {{ $pnr->pnr_code }}
                                                                        Seats-{{ $pnr->avai_seats }}
                                                                        ({{ $pnr->dept_date }})-
                                                                        {{ $pnr->supp_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('pnr_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Only visas --}}
                                            @elseif($service_type_id == 12)
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.country') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" wire:model='country_id'
                                                            wire:change='getVisaType' name="country_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.country') }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->countryname }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.travel_date') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="travel_date"
                                                            wire:model='travel_date'>
                                                        @error('travel_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.visa') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="visa_type_id"
                                                            wire:model='visa_type_id'>
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.visa') }}</option>
                                                            @if ($visaCat)
                                                                @foreach ($visaCat as $visa_cat)
                                                                    <option value="{{ $visa_cat->id }}">
                                                                        {{ $visa_cat->visa_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('visa_type_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @elseif($service_type_id == 13)
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.hotel') }}
                                                            {{ __('tablevars.name') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" wire:model='hotel_id'
                                                            wire:change='getVisaType' name="hotel_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.hotel') }}</option>
                                                            @foreach ($hotels as $hotel)
                                                                <option value="{{ $hotel->id }}">
                                                                    {{ $hotel->hotel_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('hotel_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>check in<span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control"
                                                            wire:model='checkin_date' wire:change='getDateDiffDays'
                                                            name="hotel_checkin">
                                                        @error('checkin_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>check out<span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control"
                                                            wire:model='checkout_date' wire:change='getDateDiffDays'
                                                            name="hotel_checkout">
                                                        @error('checkout_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>Number of Nights<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" readonly
                                                            wire:model='number_of_nights'name="number_nights"
                                                            maxlength='3'>
                                                        @error('number_of_nights')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>Number of Rooms<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="number_rooms" wire:model='number_rooms'
                                                            maxlength='3'>
                                                        @error('number_rooms')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Others --}}
                                            @else
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.departure_city') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control select" name="city_id"
                                                            wire:model="city_id">
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.departure_city') }}</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">
                                                                    {{ $city->city_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.travel_date') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control "
                                                            name="travel_date" model="travel_date"
                                                            wire:model='travel_date'>
                                                        @error('travel_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.package') }}
                                                            {{ __('tablevars.type') }}<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="pkg_type_ids"
                                                            wire:model='pkg_type_ids'>
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.package') }}
                                                                {{ __('tablevars.type') }}
                                                            </option>
                                                            @foreach ($packageType as $package_type)
                                                                <option value="{{ $package_type->package_type }}">
                                                                    {{ $package_type->package_type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('pkg_type_ids')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.sharing') }}
                                                            {{ __('tablevars.type') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="sharing_type_id"
                                                            wire:model='sharing_type_id'>
                                                            <option value="">{{ __('tablevars.select') }}
                                                                {{ __('tablevars.sharing') }}
                                                                {{ __('tablevars.type') }}
                                                            </option>
                                                            @foreach ($sharingType as $sharing_type)
                                                                <option value="{{ $sharing_type->id }}">
                                                                    {{ $sharing_type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('sharing_type_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.package_days') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter number of days for the package"
                                                            name="pkg_days" wire:model='pkg_days'
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                            maxlength="3">
                                                        @error('pkg_days')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-9 mb-4">
                                                    <div class="form-group">
                                                        <label>{{ __('tablevars.flight_details') }}</label><span
                                                            class="text-danger">*</span>
                                                        <textarea name="flight_details" class="form-control" placeholder="Enter flight details" wire:model='flight_details'></textarea>
                                                        @error('flight_details')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>{{ __('tablevars.passenger_details') }}<span class="text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 mb-4">
                                                <div class="form-group">
                                                    <label>{{ __('tablevars.passenger_name') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter customer's name" wire:model='pax_name'
                                                        maxlength='40'>
                                                    @error('pax_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <div class="form-group">
                                                    <label>Number of Adults<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter number of adults" wire:model='adult_count'
                                                        wire:keyup='getAllCounts'
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        maxlength='3'>
                                                    @error('adult_count')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <div class="form-group">
                                                    <label>Number of Child With Bed</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Number of child with bed"
                                                        wire:model='cwb_count'
                                                        wire:keyup='getAllCounts'onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        maxlength='3'>
                                                </div>
                                            </div>
                                            <div class="col-3 mb-4">
                                                <div class="form-group">
                                                    <label>Number of Child Without Bed</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Number of child without bed"
                                                        wire:model='cwob_count'
                                                        wire:keyup='getAllCounts'onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        maxlength='3'>
                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label>Number of Infants</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter number of infants"
                                                        wire:model='infant_count' wire:keyup='getAllCounts'
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        maxlength='3'>
                                                    <span class="text-danger">NOTE : Infant Seat is Not Counted in
                                                        Airlines
                                                        Bookings</span>
                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label>Email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter customer's email" wire:model='email_id'
                                                        maxlength='50'>
                                                    @error('email_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label>Contact Number<span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"placeholder="Enter customer's contact number"
                                                        wire:model='contact'
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        maxlength="10">
                                                    @error('contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label data-toggle="tooltip">Total PAX
                                                        (Adults+Children+Infants)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Auto calculated" wire:model='total_pax' readonly>

                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label>Total Beds<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Auto calculated" wire:model='total_beds'
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <div class="form-group">
                                                    <label>Total AIRLINES Seats (Adults+Children)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Auto calculated" wire:model='total_seats'
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4>User Cost Details<span class="text-danger">*</span></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 mb-4">
                                                <div class="form-group">
                                                    <label>Total Cost<span class="text-danger">*</span></label>
                                                    <input name="tot_cost" type="text" class="form-control" placeholder="Enter Total Cost" wire:model='tot_cost' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength='7'>
                                                    @error('tot_cost')
                                                        <span class="v-msg">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label>Cost Breakup</label><span class="text-danger">*</span>
                                                    <textarea name="cost_breakup" class="form-control" placeholder="Enter Cost Breakup" wire:model='cost_breakup'></textarea>
                                                    @error('cost_breakup')
                                                        <span class="v-msg">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label>Special Request (If Any)</label>
                                                    <textarea name="special_request" class="form-control" placeholder="Enter Any Special Request" wire:model='special_request'></textarea>
                                                    @error('special_request')
                                                        <span class="v-msg">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="update-profile">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
