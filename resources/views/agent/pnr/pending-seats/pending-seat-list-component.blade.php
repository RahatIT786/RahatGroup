<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="settings-widget">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space pb-0">
                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>{{ __('tablevars.pendingseat_list') }}</h3>
                            </div>
                            <div class="instruct-search-blk mb-0">
                                <div class="show-filter all-select-blk">
                                    <div class="row gx-2">
                                        <div class="col-md-3 col-lg-3 col-item">
                                            <label>{{ __('tablevars.select') }} {{ __('tablevars.city') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="city_id" wire:change="changeInput">
                                                <option value="">{{ __('tablevars.city') }}</option>
                                                @foreach ($cityData as $id => $city_name)
                                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-item">
                                            <label>{{ __('tablevars.select') }} {{ __('tablevars.month') }}
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" wire:model="month" wire:change="changeInput">
                                                <option value="">{{ __('tablevars.select') }}
                                                    {{ __('tablevars.month') }}
                                                </option>
                                                @for ($month = 1; $month <= 12; $month++)
                                                    <option value="{{ $month }}">
                                                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('month')
                                                <span class="v-msg">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-3 align-self-end">
                                            <a class="btn btn-primary" id="box" style="color: white"
                                                wire:click="pendingSeatData">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="tak-instruct-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Departure Date</th>
                                                        <th>Airline</th>
                                                        <th>Total Seats</th>
                                                        <th>Balance Seats</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($pendingSeat && $pendingSeat->count())
                                                        @foreach ($pendingSeat as $key => $pendingseats)
                                                            <tr>
                                                                <td>{{ $key + $pendingSeat->firstItem() }}</td>

                                                                <td><i class="fa fa-calendar text-info"></i>
                                                                    {{ \App\Helpers\Helper::appDateFormat($pendingseats->dept_date) }}
                                                                </td>
                                                                {{-- <td><img src="{{ asset('img/flight1.png') }}" alt width="24px" height="24px"/> {{ $pendingseats->flight->flight_name ??'' }}</td> --}}

                                                                <td> <img
                                                                        src="{{ asset('storage/flight_image/' . $pendingseats->flight->flight_logo) }}"
                                                                        width="24px" height="24px" />
                                                                    {{ $pendingseats->flight->flight_name ?? '' }}</td>
                                                                <td><span
                                                                        class="bg-lign-info p-2 px-3 d-inline-block rounded-4 text-white shadow-sm hover-btn"><img
                                                                            src="{{ asset('img/seat.svg') }}" alt
                                                                            width="24px" height="24px" />
                                                                        {{ $pendingseats->seats }}</span></td>
                                                                <td>
                                                                    @php
                                                                        $bgColor = '';
                                                                        if ($pendingseats->avai_seats < 5) {
                                                                            $bgColor = 'bg-success';
                                                                        } elseif (
                                                                            $pendingseats->avai_seats ==
                                                                            $pendingseats->seats
                                                                        ) {
                                                                            $bgColor = 'bg-danger';
                                                                        } else {
                                                                            $bgColor = 'bg-warning'; // Default color if none of the conditions match
                                                                        }
                                                                    @endphp
                                                                    <span
                                                                        class="p-2 px-3 d-inline-block rounded-4 text-white shadow-sm hover-btn {{ $bgColor }}">
                                                                        <img src="{{ asset('img/seat.svg') }}" alt
                                                                            width="24px" height="24px" />
                                                                        {{ $pendingseats->avai_seats }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6" align="center" class="text-danger"><span
                                                                    class="v-msg">No
                                                                    Records
                                                                    Found</span> </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            {{ $pendingSeat->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </tbody>
                            </table>
                        </div>
                        {{-- <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>{{ __('tablevars.pendingseat_list') }}</h3>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label>{{ __('tablevars.select') }} {{ __('tablevars.city') }}
                                                            <span class="text-danger">*</span></label>
                                                            <select class="form-control" wire:model="city_id" wire:change="changeInput">
                                                                <option value="">{{ __('tablevars.city') }}</option>
                                                                @foreach ($cityData as $id => $city_name)
                                                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @error('city_id')
                                                            <span class="v-msg">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label>{{ __('tablevars.select') }} {{ __('tablevars.month') }}
                                                            <span class="text-danger">*</span></label>
                                                            <select class="form-control" wire:model="month" wire:change="changeInput">
                                                                <option value="">{{ __('tablevars.select') }} {{ __('tablevars.month') }}</option>
                                                                @for ($month = 1; $month <= 12; $month++)
                                                                    <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                                                                @endfor
                                                            </select>
                                                        @error('month')
                                                            <span class="v-msg">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3 align-self-end">
                                                        <a class="btn btn-primary" id="box" style="color: white"
                                                            wire:click="pendingSeatData">Search</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                        {{-- biswajita --}}
                        {{-- <table class="table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Departure Date</th>
                                            <th scope="col">Airline</th>
                                            <th scope="col">Total Seats</th>
                                            <th scope="col">Balance Seats</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pendingSeat && $pendingSeat->count())
                                            @foreach ($pendingSeat as $key => $pendingseats)
                                                <tr>
                                                    <td>{{ $key + $pendingSeat->firstItem() }}</td>
                                                    <td>{{ \App\Helpers\Helper::appDateFormat($pendingseats->dept_date) }}
                                                    </td>
                                                    <td>{{ $pendingseats->flightdetails->flight_name ??'' }}</td>
                                                    <td>{{ $pendingseats->seats }}</td>
                                                    <td>{{ $pendingseats->avai_seats }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" align="center" class="text-danger"><span class="v-msg">No
                                                    Records
                                                    Found</span> </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $pendingSeat->links() }}
                            </div>
                        </div>
                    </div>
                </div> --}}


                        <div class="instruct-search-blk mb-0">
                            <div class="show-filter all-select-blk">
                                <div class="row gx-2">
                                    <div class="col-md-3 col-lg-3 col-item">
                                        <label class="form-control-label">{{ __('tablevars.mobile') }}
                                            {{ __('tablevars.number') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model='search_title'
                                            placeholder="Enter mobile Number"
                                            wire:keyup.debounce.500ms="filterBookings">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-item">
                                        <label>{{ __('tablevars.departure') }}
                                            {{ __('tablevars.month') }} <span class="text-danger">*</span></label>
                                        <select class="form-control">
                                            <option value="">Select Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-3 align-self-end">
                                        <a class="btn btn-primary" id="box" style="color: white">Send SMS</a>
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

@push('extra_css')
    <style>
        .bg-lign-info {
            background: #94befb;
        }

        .bg-success {
            background: #28a745;
        }

        /* Green color */
        .hover-btn {
            transition: all ease 0.4s;
            transform: scale(0.8);
        }

        .hover-btn:hover {
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.7);
            cursor: pointer;
            transform: scale(1);
        }
    </style>
@endpush
