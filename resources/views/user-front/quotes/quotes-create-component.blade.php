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
                                            <h3 class="m-0">{{ __('tablevars.create') }}
                                                {{ __('tablevars.request') }}</h3>
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
                                                @if ($service_type_id == 2)
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Umrah Type<span class="text-danger">*</span></label>
                                                            <select class="form-select"
                                                                wire:change="packageDetialsChange"
                                                                wire:model="umrah_type_id" name="umrah_type_id">
                                                                <option value="">Select a Umrah Type</option>
                                                                <option value="1">Fixed Group Departures</option>
                                                                <option value="2">Umrah Land Package</option>
                                                            </select>
                                                            @error('umrah_type_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @elseif($service_type_id == 26)
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Hajj Kits<span class="text-danger">*</span></label>
                                                            <select class="form-select"
                                                                wire:model="hajj_kit_id" name="hajj_kit_id">
                                                                <option value="">Select Hajj Kits</option>
                                                                @foreach ($hajj_kits as $hajj_kit) 
                                                                <option value="{{ $hajj_kit->name }}">
                                                                    {{ $hajj_kit->name }}
                                                                </option>
                                                            @endforeach
                                                            </select>
                                                            @error('hajj_kit_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @elseif($service_type_id == 27)
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Services<span class="text-danger">*</span></label>
                                                            <select class="form-select" wire:model="service_value"
                                                                name="service_value">
                                                                <option value="">Select Service</option>
                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->name }}">
                                                                        {{ $service->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('service_value')
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
                        </div>
                        @if ($service_type_id != 12 && $service_type_id != 22 && $service_type_id != 23 && $service_type_id != 24 && $service_type_id != 25 && $service_type_id != 26 && $service_type_id != 27  ) 
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4>  @if (($service_type_id == 2 && $umrah_type_id == 1) || $service_type_id == 20)
                                                {{  __('tablevars.package_pnr_details') }}
                                            @else
                                                {{  __('tablevars.package_details') }}
                                            @endif<span
                                                    class="text-danger">*</span>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- umrah --}}
                                                {{-- Check if it's for Hajj --}}
                                                @if (($service_type_id == 2 && $umrah_type_id == 1) || $service_type_id == 20)
                                                    {{-- Departure city --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.departure_city') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" wire:model="city_id"
                                                                wire:change="getPnrList" name="city_id">
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.departure_city') }}</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Departure month --}}
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
                                                                        {{ $val }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('month_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- PNR --}}
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
                                                                            ({{ $pnr->dept_date }}) -
                                                                            {{ $pnr->flight->flight_name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pnr_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Days --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package_days') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter number of days for the package"
                                                                name="pkg_days" wire:model='pkg_days'
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                                maxlength="3" readonly>
                                                            @error('pkg_days')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Name --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select"
                                                                wire:model.defer='pkg_name_id_umrah'
                                                                wire:change='getPkgTypeUmrah'
                                                                name="pkg_name_id_umrah">
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.name') }}</option>
                                                                @if ($packageMaster)
                                                                    @foreach ($packageMaster as $pkg)
                                                                        <option value="{{ $pkg->id }}">
                                                                            {{ $pkg->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_name_id_umrah')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.type') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="pkg_type_id"
                                                                wire:model='pkg_type_id_umrah'
                                                                wire:change='getsharingTypeUmrah'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @if ($packageType)
                                                                    @foreach ($packageType as $key => $package_type)
                                                                        <option
                                                                            value="{{ $package_type->packageType->id }}">
                                                                            {{ $package_type->packageType->package_type }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_type_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Sharing Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.sharing') }}
                                                                {{ __('tablevars.type') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="sharing_type_id"
                                                                wire:model='sharing_type_id_umrah'
                                                                wire:change='getPackageRatesUmrah'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.sharing') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @foreach ($sharingType as $sharing_type)
                                                                    <option value="{{ $sharing_type->id }}">
                                                                        {{ $sharing_type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error($service_type_id == 2 || $service_type_id == 20 ? 'sharing_type_id_umrah' :
                                                                'sharing_type_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @elseif (($service_type_id == 2 && $umrah_type_id == 2) || ($service_type_id == 20))
                                                    {{-- Travel Date --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.travel_date') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                name="travel_date" wire:model='travel_date'>
                                                            @error('travel_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Name --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" wire:model='pkg_name_id_hajj'
                                                                wire:change='getPkgTypeHajj' name="pkg_name_id_hajj">
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.name') }}</option>
                                                                @if ($packageMaster)
                                                                    @foreach ($packageMaster as $pkg)
                                                                        <option value="{{ $pkg->id }}">
                                                                            {{ $pkg->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_name_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.type') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="pkg_type_id"
                                                                wire:model='pkg_type_id_hajj'
                                                                wire:change='getsharingTypeHajj'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @if ($packageType)
                                                                    @foreach ($packageType as $key => $package_type)
                                                                        <option
                                                                            value="{{ $package_type->packageType->id }}">
                                                                            {{ $package_type->packageType->package_type }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_type_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Sharing Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.sharing') }}
                                                                {{ __('tablevars.type') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="sharing_type_id"
                                                                wire:model='sharing_type_id_hajj'
                                                                wire:change='getPackageRatesHajj'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.sharing') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @foreach ($sharingType as $sharing_type)
                                                                    <option value="{{ $sharing_type->id }}">
                                                                        {{ $sharing_type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('sharing_type_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Days --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package_days') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter number of days for the package"
                                                                name="pkg_days" wire:model='pkg_days'
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                                maxlength="3">
                                                            @error('pkg_days_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- Travel Date --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.travel_date') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                name="travel_date" wire:model='travel_date'>
                                                            @error('travel_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Name --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.name') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" wire:model='pkg_name_id_hajj'
                                                                wire:change='getPkgTypeHajj' name="pkg_name_id_hajj">
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.name') }}</option>
                                                                @if ($packageMaster)
                                                                    @foreach ($packageMaster as $pkg)
                                                                        <option value="{{ $pkg->id }}">
                                                                            {{ $pkg->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_name_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package') }}
                                                                {{ __('tablevars.type') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="pkg_type_id"
                                                                wire:model='pkg_type_id_hajj'
                                                                wire:change='getsharingTypeHajj'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.package') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @if ($packageType)
                                                                    @foreach ($packageType as $key => $package_type)
                                                                        <option
                                                                            value="{{ $package_type->packageType->id }}">
                                                                            {{ $package_type->packageType->package_type }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pkg_type_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Sharing Type --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.sharing') }}
                                                                {{ __('tablevars.type') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select" name="sharing_type_id"
                                                                wire:model='sharing_type_id_hajj'
                                                                wire:change='getPackageRatesHajj'>
                                                                <option value="">{{ __('tablevars.select') }}
                                                                    {{ __('tablevars.sharing') }}
                                                                    {{ __('tablevars.type') }}</option>
                                                                @foreach ($sharingType as $sharing_type)
                                                                    <option value="{{ $sharing_type->id }}">
                                                                        {{ $sharing_type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('sharing_type_id_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Package Days --}}
                                                    <div class="col-3 mb-4">
                                                        <div class="form-group">
                                                            <label>{{ __('tablevars.package_days') }}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter number of days for the package"
                                                                name="pkg_days" wire:model='pkg_days_hajj'
                                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                                maxlength="3">
                                                            @error('pkg_days_hajj')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-4">
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
                        @endif
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
                                                        <span class="v-msg">{{ $message }}</span>
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
                                                    @if ($service_type_id != 12 && $service_type_id != 22 && $service_type_id != 23 && $service_type_id != 24 && $service_type_id != 25 && $service_type_id != 26 && $service_type_id != 27  ) 
                                                        <span class="text-danger">NOTE : Infant Seat is Not Counted in
                                                            Airlines Bookings</span>
                                                    @endif
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
                                         @if ($service_type_id == 12 || $service_type_id == 22 || $service_type_id == 23 || $service_type_id == 24 || $service_type_id == 25 || $service_type_id == 26 || $service_type_id == 27  ) 
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label>Service Details</label>
                                                    <textarea name="service_details" wire:model='service_details' class="form-control"
                                                        placeholder="Enter Service Details" style="height: 150px;">{!! $service_details !!}</textarea>
                                                    @error('service_details')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-4 mb-4">
                                                    <div class="form-group">
                                                        <label data-toggle="tooltip">Total PAX
                                                            (Adults+Children+Infants)<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Auto calculated" wire:model='total_pax'
                                                            readonly>

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
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($service_type_id != 12 && $service_type_id != 22 && $service_type_id != 23 && $service_type_id != 24 && $service_type_id != 25 && $service_type_id != 26 && $service_type_id != 27  ) 
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
                                                        <label>Total Cost</label>
                                                        <input name="tot_cost" type="text" class="form-control"
                                                            placeholder="Enter Total Cost"
                                                            value={{ number_format($tot_cost, 2) }} disabled>
                                                        @error('tot_cost')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <div class="form-group">
                                                        <label>Cost Breakup</label>
                                                        <textarea name="cost_breakup" class="form-control" placeholder="Enter Cost Breakup" style="height: 150px;" disabled>{!! $cost_breakup !!}</textarea>
                                                        @error('cost_breakup')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <div class="form-group">
                                                        <label>Special Request (If Any)</label>
                                                        <textarea name="special_request" class="form-control" placeholder="Enter Any Special Request"
                                                            wire:model='special_request' style="height: 150px;"></textarea>
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
                        @else
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
                                                        <label>Total Cost</label>
                                                        <input name="tot_cost" type="text" class="form-control"
                                                            placeholder="Enter Total Cost" wire:model='tot_cost'
                                                            value="" onkeypress="return isNumeric(event)">
                                                        @error('tot_cost')
                                                            <span class="text-danger">{{ $message }}</span>
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
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
