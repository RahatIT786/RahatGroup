<div>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="breadcrumbs mb-4">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="#">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Tickets</span>
                        </span>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="package_search_box">
                        <h4 class="box-title">Search <small>PNR</small></h4>
                        <div class="search_content">
                            <form class="" name="" action="" method="post">
                                <div class="form-row">


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="custom-select form-control" wire:model.live="search_city"
                                                wire:change="changeInput">
                                                <option value="" selected>Select City</option>
                                                @foreach ($cities as $id => $city_name)
                                                    <option value="{{ $id }}">{{ $city_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('dept_city_id')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="custom-select form-control" wire:model.live="search_flight"
                                                wire:keyup="changeInput">
                                                <option value="" selected>Airline</option>
                                                @foreach ($flights as $id => $flight_name)
                                                    <option value="{{ $id }}">{{ $flight_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('flight_id')
                                                <span class="text-red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control w-100" wire:model.live="search_dept_date"
                                                placeholder="Departing Date" type="text" onfocus="(this.type='date')"
                                                onblur="(this.type='text')">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control w-100" wire:model.live="search_return_date"
                                                placeholder="Return Date" type="text" onfocus="(this.type='date')"
                                                onblur="(this.type='text')">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Listings -->
            <div class="row" id="ticket_list">

                @forelse ($pnrs as $pnr)
                    <div class="col-md-12 mb-4">
                        <div class="ticket-box">
                            <div class="row m-0">
                                <div class="col-md-12 p-0">
                                    <form method="get" action="#">
                                        <div class="row m-0">

                                            <div class="col-md-2 p-0">
                                                <img src="{{ asset('storage/flight_image/' . $pnr->flight->flight_logo) }}"
                                                    class="flight-image p-0 w-100"
                                                    alt="{{ $pnr->flight->flight_name }}">
                                                <div class="slbg text-center h-auto"
                                                    style="position: absolute;bottom: 0;left: 0;">
                                                    {{ $pnr->city->city_name }}</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">{{ $pnr->flight->flight_name }}</div>
                                                <div class="flbg text-center">{{ $pnr->pnr_code }}</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">{{ $pnr->departuresector->sector_name }}
                                                </div>
                                                <div class="flbg text-center">{{ $pnr->returnsector->sector_name }}
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">
                                                    <strong>{{ $pnr->dept_date }}</strong>
                                                </div>
                                                <div class="flbg text-center">{{ $pnr->return_date }}
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">{{ $pnr->dept_time }}</div>
                                                <div class="flbg text-center">{{ $pnr->return_time }}</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">Adult Price</div>
                                                <div class="flbg text-center">{{ number_format($pnr->adult_cost, 2) }}
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">Child Price</div>
                                                <div class="flbg text-center">{{ number_format($pnr->child_cost, 2) }}
                                                </div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">Infant Price</div>
                                                <div class="flbg text-center">
                                                    {{ number_format($pnr->infant_cost, 2) }}</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">Available</div>
                                                <div class="flbg text-center">{{ $pnr->avai_seats }} Seat(s)</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <div class="flbg text-center">
                                                    @if ($pnr->avai_seats > 0)
                                                        <select class="flbg custom-select" id="no_seat"
                                                            name="no_seat">
                                                            @for ($i = 1; $i <= $pnr->avai_seats; $i++)
                                                                <option value="{{ $i }}">
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    @else
                                                        <p>0</p>
                                                    @endif

                                                </div>
                                                <div class="flbg text-center">{{ $pnr->days }} Days</div>
                                            </div>
                                            <div class="col-md-1 p-0">
                                                <button type="button" data-toggle="modal" data-target="#ticketModal"
                                                    data-id="{{ $pnr->id }}"
                                                    wire:click="openTicketModal({{ $pnr->id }})"
                                                    style="background-position: 300% 100% !important; margin-left: 10px;"
                                                    class="btn secondary-btn flbg_bttn ml-sm-0" title="Ticket Enquiry"
                                                    tabindex="0"
                                                    name="ticket_enquiry">{{ __('tablevars.enquire') }} </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <p>No Data found.</p>
                    </div>
                @endforelse
            </div>
            @if (count($pnrs) < $totalTickets)
                <div class="text-center my-4">
                    <button class="btn default-btn" wire:click.prevent="loadMore">Load More</button>
                </div>
            @endif
        </div>
    </section>
    @livewire('user-front.pages.ticket-view-modal-component')
</div>

@push('extra_css')
    <style>
        body .fAWLEZ {
            z-index: inherit;
        }

        .package_search_box .box-title {
            color: #ffffff;
            font-size: 16px;
            padding: 8px 15px;
            margin: 0px;
            border-radius: 10px 10px 0px 0px;
            background-image: linear-gradient(to right, #2D6F76, #7E9680) !important;
        }

        .package_search_box .search_content {
            background: #ffffff;
            border: 1px solid #eeeeee;
            padding: 14px;
            position: relative;
            margin-bottom: 15px;
            border-radius: 0px 0px 10px 10px;
        }

        .form-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        .form-row>[class*=col-] {
            padding-right: 5px;
            padding-left: 5px;
        }

        .searchby-section {
            background: #F3F3F3;
        }

        .partner-logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .partner-logo img {
            max-width: 100%;
            max-height: 64px;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .col-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .ticket-box {
            box-shadow: 0px 0px 10px #dad8d8;
            width: 100%;
            height: auto;
            background-color: #ffffff;
            color: #000000;
            padding: 15px;
            border-radius: 15px;
        }

        .m-0 {
            margin: 0 !important;
        }

        .col-md-1 {
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }

        .flight-image {
            height: 90px;
            object-fit: contain;
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            padding: 10px;
        }

        .slbg {
            border: 1px solid #dad8d8;
            width: 100%;
            height: 45px;
            background-color: #f8a02b;
            color: white;
            border-radius: 2px;
            font-size: 12px;
            line-height: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-center {
            text-align: center !important;
        }

        .flbg {
            border: 1px solid #e7e7e7;
            width: 100%;
            height: 45px;
            background-color: #fff;
            color: #606060;
            border-radius: 2px;
            font-size: 12px;
            line-height: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        .ticket-box {
            color: #000000;
        }

        .p-0 {
            padding: 0 !important;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        .flbg_bttn {
            border: 1px solid #e7e7e7;
            padding: 0px;
            width: 100%;
            height: 90px;
            border-radius: 5px;
            text-align: center;
        }

        .secondary-btn {
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: 0;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            background-image: linear-gradient(to right, #2D6F76, #7E9680, #ffa500, #e67717) !important;
            background-size: 300% 100% !important;
        }

        .ml-sm-0 {
            margin-left: 0 !important;
        }

        .custom-select {
            padding: .375rem 1.2rem;
            padding-right: 1.8rem;
            background: #fff url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1024 1024' %3e%3cpath fill='gray' d='M0 307.2c0-6.552 2.499-13.102 7.499-18.101 9.997-9.998 26.206-9.998 36.203 0l442.698 442.698 442.699-442.698c9.997-9.998 26.206-9.998 36.203 0s9.998 26.206 0 36.203l-460.8 460.8c-9.997 9.998-26.206 9.998-36.203 0l-460.8-460.8c-5-5-7.499-11.55-7.499-18.102z'/%3e%3c/svg%3e);
            background-size: 0.8em auto, 100%;
            background-repeat: no-repeat;
            background-position: right .8em top 50%, 0 0;
        }

        img {
            max-width: 100%;
        }
    </style>
@endpush
