{{-- Close your eyes. Count to one. That is how long forever feels. --}}
{{-- In work, do what you enjoy. --}}
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.booking') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.booking') }} {{ __('tablevars.management') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
                        wire:navigate>{{ __('tablevars.booking') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.booking') }}</h4>
                            <a href="{{ route('admin.booking.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left"></i> &nbsp;{{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.agency_name') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="agency_id" wire:model="agency_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.agency_name') }}</option>
                                            @foreach ($agencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->agency_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('agency_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.service_type') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control " wire:change="packageDetialsChange"
                                            wire:model="service_type" name="service_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.service_type') }}</option>
                                            @foreach ($serviceType as $servicetype)
                                                <option value="{{ $servicetype->id }}">{{ $servicetype->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_type')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
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
                            <h4>{{ __('tablevars.package_pnr_details') }}<span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- umrah --}}
                                @if ($service_type == 2 && $booking->package->umrah_type == 1)

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.departure_city') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="city_id" wire:change="getPnrList"
                                                name="city_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.departure_city') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.departure_month') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="month_id" wire:change="getPnrList"
                                                name="dept_month_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.departure_month') }}</option>
                                                @foreach ($months as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('month_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.pkg_pnr') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model='pnr_id' wire:change='getPkgDays'
                                                name="pnr_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.date') }}</option>
                                                @if ($pnrList)
                                                    @foreach ($pnrList as $pnr)
                                                        <option value="{{ $pnr->id }}">{{ $pnr->pnr_code }}
                                                            Seats-{{ $pnr->avai_seats }} ({{ $pnr->dept_date }})-
                                                            {{ $pnr->supp_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('pnr_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package') }} {{ __('tablevars.name') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model='pkg_name_id'
                                                wire:change='getTotalPkgPrice' name="pkg_id" disabled>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.package') }} {{ __('tablevars.name') }}
                                                </option>
                                                @foreach ($packageMaster as $pkg)
                                                    <option value="{{ $pkg->id }}">{{ $pkg->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pkg_name_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package') }} {{ __('tablevars.type') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="pkg_type_id" wire:model='pkg_type_id'
                                                disabled>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.package') }} {{ __('tablevars.type') }}
                                                </option>
                                                @if ($packageType)
                                                    @foreach ($packageType as $key => $package_type)
                                                        <option value="{{ $package_type->id }}">
                                                            {{ $package_type->package_type }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('pkg_type_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.sharing') }} {{ __('tablevars.type') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="sharing_type"
                                                wire:model='sharing_type_id'>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.sharing') }} {{ __('tablevars.type') }}
                                                </option>
                                                @foreach ($sharingType as $sharing_type)
                                                    <option value="{{ $sharing_type->id }}">
                                                        {{ $sharing_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sharing_type_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package') }} {{ __('tablevars.days') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" readonly wire:model='pkg_days'
                                                name="pkg_days">
                                        </div>
                                    </div>
                                    {{-- Groups Tickets --}}
                                @elseif($service_type == 11)
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.departure_city') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="city_id"
                                                wire:change="getPnrList" name="city_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.departure_city') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.departure_month') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="month_id"
                                                wire:change="getPnrList" name="dept_month_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.departure_month') }}</option>
                                                @foreach ($months as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.pkg_pnr') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model='pnr_id' wire:change='getPkgDays'
                                                name="pnr_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.date') }}</option>
                                                @if ($pnrList)
                                                    @foreach ($pnrList as $pnr)
                                                        <option value="{{ $pnr->id }}">{{ $pnr->pnr_code }}
                                                            Seats-{{ $pnr->avai_seats }} ({{ $pnr->dept_date }})-
                                                            {{ $pnr->supp_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    {{-- Only visas --}}
                                @elseif($service_type == 12)
                                    <div class="col-3">
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
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.travel_date') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="travel_date"
                                                wire:model='travel_date' required>
                                        </div>
                                    </div>
                                    <div class="col-3">
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
                                        </div>
                                    </div>
                                @elseif($service_type == 13)
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.hotel') }} {{ __('tablevars.name') }}<span
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
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>check in<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" wire:model='checkin_date'
                                                wire:change='getDateDiffDays' name="hotel_checkin">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>check out<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" wire:model='checkout_date'
                                                wire:change='getDateDiffDays' name="hotel_checkout">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Number of Nights<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" readonly
                                                wire:model='number_of_nights'name="number_nights">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Number of Rooms<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="number_rooms"
                                                wire:model='number_rooms'>
                                        </div>
                                    </div>
                                    {{-- Others --}}
                                @else
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.departure_city') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="city_id" wire:model="city_id">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.departure_city') }}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.travel_date') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control " name="travel_date"
                                                wire:model='travel_date'>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package') }} {{ __('tablevars.name') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" wire:model='pkg_name_id'
                                                wire:change='getTotalPkgPrice' name="pkg_id" disabled>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.package') }} {{ __('tablevars.name') }}
                                                </option>
                                                @foreach ($packageMaster as $pkg)
                                                    <option value="{{ $pkg->id }}">{{ $pkg->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pkg_name_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package') }} {{ __('tablevars.type') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" name="pkg_type_id" wire:model='pkg_type_id'
                                                disabled>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.package') }} {{ __('tablevars.type') }}
                                                </option>
                                                @foreach ($packageType as $package_type)
                                                    <option value="{{ $package_type->id }}">
                                                        {{ $package_type->package_type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pkg_type_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.sharing') }} {{ __('tablevars.type') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" name="sharing_type_id"
                                                wire:model='sharing_type_id'>
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.sharing') }} {{ __('tablevars.type') }}
                                                </option>
                                                @foreach ($sharingType as $sharing_type)
                                                    <option value="{{ $sharing_type->id }}">
                                                        {{ $sharing_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.package_days') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter number of days for the package" name="pkg_days"
                                                wire:model='pkg_days'>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label>{{ __('tablevars.flight_details') }}</label><span
                                                class="text-danger">*</span>
                                            <textarea name="flight_details" class="form-control" placeholder="Enter flight details" wire:model='flight_details'></textarea>
                                            @error('flight_details')
                                                <span class="v-msg-500">{{ $message }}</span>
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
                            <h4>{{ __('tablevars.passenger_details') }}<span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.passenger_name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter customer's name" wire:model='pax_name'>
                                        @error('pax_name')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Number of Adults<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter number of adults" wire:model='adult_count'
                                            wire:keyup='getAllCounts'>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Number of Child With Bed</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Number of child with bed" wire:model='cwb_count'
                                            wire:keyup='getAllCounts'>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Number of Child Without Bed</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Number of child without bed" wire:model='cwob_count'
                                            wire:keyup='getAllCounts'>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Number of Infants</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter number of infants" wire:model='infant_count'
                                            wire:keyup='getAllCounts'>
                                        <span class="text-danger">NOTE : Infant Seat is Not Counted in Airlines
                                            Bookings</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter customer's email" wire:model='email_id'>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Contact Number<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control"placeholder="Enter customer's contact number"
                                            wire:model='contact' maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label data-toggle="tooltip">Total PAX (Adults+Children+Infants)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Auto calculated"
                                            wire:model='total_pax' readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Total Beds<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Auto calculated"
                                            readonly wire:model='total_beds'>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Total AIRLINES Seats (Adults+Children)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Auto calculated"
                                            readonly wire:model='total_seats'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        Footer Card
                    </div> --}}
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
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Total Cost<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Total Cost"
                                            wire:model='tot_cost'>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Cost Breakup</label><span class="text-danger">*</span>
                                        <textarea name="cost_breakup" class="form-control" placeholder="Enter Cost Breakup" wire:model='cost_breakup'></textarea>
                                        @error('cost_breakup')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Special Request (If Any)</label><span class="text-danger">*</span>
                                        <textarea name="special_request" class="form-control" placeholder="Enter Any Special Request"
                                            wire:model='special_request'></textarea>
                                        @error('special_request')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.booking') }} {{ __('tablevars.status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="booking_status_id"
                                            wire:model="booking_status_id">
                                            <option value="">{{ __('tablevars.select') }}
                                                {{ __('tablevars.booking') }} {{ __('tablevars.status') }}</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                            <option value="3">Cancelled</option>
                                            <option value="4">Suspended</option>
                                            <option value="5">Under Review</option>
                                            <option value="6">Deleted</option>
                                        </select>

                                    </div>

                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <label>{{ __('tablevars.status') }} {{ __('tablevars.desc') }}</label>
                                        <textarea name="special_request" class="form-control" placeholder="Enter Status Description"
                                            wire:model='status_desc'></textarea>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <Span><b> Created At</b> : {{ $created_at }}</Span>
                                </div>

                                <div class="col-12">
                                    <Span><b> Updated At</b> :{{ $updated_at }}</Span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary">{{ __('tablevars.update') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
</div>
</section>
</div>
