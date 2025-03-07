<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            @include('agent.layouts.sidebar')
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>{{ __('tablevars.all_booking_list') }}</h3>

                                            <div>
                                                {{-- <a class="btn btn-primary" href="{{ route('agent.booking.create') }}"
                                                    class="ticket-btn-grp" title="Add Bookings">New Bookings</a> --}}
                                                <a href="javascript:void(0);" class="btn btn-info" style="color: white;"
                                                    wire:click="exportToExcel" title="Export">
                                                    <i class="fas fa-file-excel"></i> Export
                                                    into excel
                                                </a>
                                                <a href="javascript:void(0);" style="color: white"
                                                    class="btn btn-warning" wire:click="downloadBooking"
                                                    title="Print"><i class="fas fas fa-print"></i>
                                                    {{ __('tablevars.print') }}</a>
                                                <div wire:loading>Loading...</div>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Booking Id</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search Booking Id"
                                                            wire:model='search_booking_id' wire:keyup="filterBookings"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                            maxlength="100">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.travel_date') }}
                                                        </label>
                                                        <input type="date" class="form-control"
                                                            placeholder="Search date" wire:model='' wire:keyup="">
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.passenger_name') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search Name" wire:model='search_name'
                                                            wire:keyup="filterBookings" maxlength="250">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.service_type') }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Service Type" wire:model='' wire:keyup="">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.package_name') }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Service Type" wire:model='' wire:keyup="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    @forelse ($bookings as $key => $booking)
                                                        <tr>
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td style="width: 20%;">
                                                                <span
                                                                    class="text-secondary"><b>{{ Helper::appDateFormat($booking->travel_date) }}</b></span></br>
                                                                <span
                                                                    class="text-info"><b>{{ ucfirst($booking->mehram_name) }}</b></span></br>
                                                                <span><b>{{ $booking->package != null ? $booking->package->name : '-' }}</b></span></br>
                                                                <span>{{ $booking->packagetype != null ? $booking->packagetype->package_type : '' }}</span>
                                                            </td>
                                                            <td style="width: 20%;">
                                                                <b>

                                                                    <span class="text-success">{{ $booking->adult }}
                                                                        Adult ,</span>
                                                                    <span
                                                                        class="text-success">{{ $booking->child_bed + $booking->child }}
                                                                        Child ,</span></br>
                                                                    <span class="text-success">{{ $booking->infant }}
                                                                        Infant</span></br></br>
                                                                    @if ($booking->service_type == 1)
                                                                        <span class="web-badge badge-purple">
                                                                        @else
                                                                            <span class="web-badge badge-warning">
                                                                    @endif
                                                                    {{ $booking->servicetype != null ? $booking->servicetype->name : '-' }}</span></br></br>
                                                                    @if ($booking->service_type == 2)
                                                                        @if ($booking->umrah_type == 1)
                                                                            <span class="web-badge badge-info">Fixed
                                                                                Group Departures</span></br>
                                                                        @else
                                                                            <span class="web-badge badge-info">Land
                                                                                Package</span></br>
                                                                        @endif
                                                                    @endif
                                                                    </span>
                                                            </td>
                                                            <td style="width: 20%;">
                                                                <span><b>Booking Id:</b></span>
                                                                <span>{{ $booking->booking_id }}</span></br>
                                                                <span><b>Booked On: </b></span>
                                                                <span>{{ Helper::appDateFormat($booking->updated_at) }}</span>
                                                            </td>
                                                            @php

                                                                $payments = App\Models\Payment::where(
                                                                    'booking_id',
                                                                    $booking->id,
                                                                )
                                                                    ->where('payment_status', 1)
                                                                    ->get();
                                                                $tot_paid = $payments->sum('amount');
                                                                $balance = round($booking->tot_cost - $tot_paid);

                                                            @endphp

                                                            <td style="width: 20%;">
                                                                <span><b>Total Cost: </b></span></br>
                                                                <span
                                                                    class="text-secondary">{{ Aihut::get('currency') }}
                                                                    {{ number_format($booking->tot_cost, 2) }}
                                                                </span></br>

                                                                <span><b>Total Payment: </b></span></br>
                                                                <span
                                                                    class="text-secondary">{{ Aihut::get('currency') }}
                                                                    {{ number_format(round($tot_paid), 2) }}
                                                                </span></br>
                                                                @if ($booking->full_payment_discount > 0)
                                                                    <span><b>Full Payment Discount: </b></span></br>
                                                                    <span
                                                                        class="text-secondary">{{ Aihut::get('currency') }}
                                                                        {{ number_format(round($booking->full_payment_discount), 2) }}
                                                                    </span></br>
                                                                @endif
                                                                <span><b>Balance Amount: </b></span></br>
                                                                <span
                                                                    class="text-secondary">{{ Aihut::get('currency') }}
                                                                    {{ number_format(round($balance - $booking->full_payment_discount), 2) }}
                                                                </span>

                                                            </td>

                                                            <td>
                                                                @php
                                                                    $statusLabels = [
                                                                        0 => [
                                                                            'label' => 'Pending',
                                                                            'class' => 'badge-primary',
                                                                        ],
                                                                        1 => [
                                                                            'label' => 'Approved',
                                                                            'class' => 'badge-success',
                                                                        ],
                                                                        2 => [
                                                                            'label' => 'Rejected',
                                                                            'class' => 'badge-danger',
                                                                        ],
                                                                        3 => [
                                                                            'label' => 'Cancelled',
                                                                            'class' => 'badge-warning',
                                                                        ],
                                                                        4 => [
                                                                            'label' => 'Suspended',
                                                                            'class' => 'badge-secondary',
                                                                        ],
                                                                        5 => [
                                                                            'label' => 'Under Review',
                                                                            'class' => 'badge-light',
                                                                        ],
                                                                        6 => [
                                                                            'label' => 'Deleted',
                                                                            'class' => 'badge-warning',
                                                                        ],
                                                                        7 => [
                                                                            'label' => 'Waiting List',
                                                                            'class' => 'badge-dark',
                                                                        ],
                                                                    ];

                                                                    $activeLable = [
                                                                        0 => [
                                                                            'label' => 'Inactive',
                                                                            'class' => 'badge-danger',
                                                                        ],
                                                                        1 => [
                                                                            'label' => 'Active',
                                                                            'class' => 'badge-purple',
                                                                        ],
                                                                    ];
                                                                @endphp
                                                                @if (array_key_exists($booking->booking_status, $statusLabels))
                                                                    <span
                                                                        class="web-badge {{ $statusLabels[$booking->booking_status]['class'] }}">
                                                                        {{ $statusLabels[$booking->booking_status]['label'] }}
                                                                    </span></br></br>
                                                                @endif
                                                                @if (array_key_exists($booking->is_active, $activeLable))
                                                                    <span
                                                                        class="web-badge {{ $activeLable[$booking->is_active]['class'] }}">
                                                                        {{ $activeLable[$booking->is_active]['label'] }}
                                                                    </span></br></br>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                <div class="ticket-grp mb-2 has-submenu">
                                                                    <button
                                                                        class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i
                                                                            class="fas fa-cog" data-toggle="tooltip"
                                                                            title="Options"></i></button>
                                                                    <div class="dropdown-menu"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                        <a class="dropdown-item" href="{{ route('agent.bookings.add.pax', ['booking_id' => $booking->id]) }}">Add Passenger Details</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)"data-bs-toggle="modal" data-toggle="tooltip" data-bs-target="#bookingModal" title="View Booking Details" wire:click="getBookingContent({{ $booking->id }})">View Booking Details</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)"data-bs-toggle="modal" data-toggle="tooltip" data-bs-target="#paymentModal" title="View Payments Details" wire:click="getPaymentContent({{ $booking->id }})">View Payments Details</a>
                                                                        @if ($balance - $booking->full_payment_discount > 0)
                                                                            <!-- Show Make Payment link if balance is greater than 0 -->
                                                                            <a class="dropdown-item"
                                                                                @if ($booking->is_active == 1) href="{{ route('agent.bookings.add.payment', ['booking_id' => $booking->id]) }}"
                                                                               @else
                                                                                   href="javascript:void(0)"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#inactiveModal" @endif
                                                                                title="Make Payment">Make Payment
                                                                            </a>
                                                                        @else
                                                                            @if($booking->service_type == 1 || $booking->service_type == 2 ||  $booking->service_type == 20 || $booking->service_type == 21)
                                                                                <a wire:click="downloadVoucher('{{ $booking->id }}')"
                                                                                    class="dropdown-item"
                                                                                    data-toggle="tooltip"
                                                                                    title="Download voucher"
                                                                                    href="javascript:void(0)">Download
                                                                                    voucher</a>
                                                                            @endif
                                                                        @endif


                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" align="center" class="text-danger">
                                                                {{ __('tablevars.no_record') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                                <select name="per_page" id="per_page" wire:model='perPage'
                                                    class="form-control" wire:change='filterBookings'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $bookings->links(data: ['scrollTo' => false]) }}
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
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="inactiveModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-danger" id="editModalLabel">ALERT !!</h2>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row" style="width: 100%">
                                            <div>
                                                <h2 class="text-purple text-center"> Please contact your relationship
                                                    manager to
                                                    reactivate this booking.</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.booking') }}
                        {{ __('tablevars.information') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($booking_modal_data)
                                        <label><strong>Booking Details</strong></label>
                                        <div class="col-lg-12">
                                            <div class="instructor-list flex-fill bg-purple">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Booking Id</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->booking_id ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Service Type</strong></label>
                                                            <div>{{ $booking_modal_data->servicetype->name ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Agency Name</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->agency ? $booking_modal_data->agency->agency_name : '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($booking_modal_data->service_type == 2)
                                            @if ($booking_modal_data->package->umrah_type == 1)
                                                <label><strong>Flight Details</strong></label>
                                                <div class="col-lg-12">
                                                    <div class="instructor-list flex-fill bg-warning">
                                                        <div class="row" style="width: 100%">
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Flight Name</strong></label>
                                                                    <div>
                                                                        {{ $booking_modal_data->pnr->flight->flight_name ?: 'N/A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Flight Code</strong></label>
                                                                    <div>
                                                                        {{ $booking_modal_data->pnr->flight->flight_code ?: 'N/A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Flight Type</strong></label>
                                                                    <div>
                                                                        {{ $booking_modal_data->pnr->flight_type ?: 'N/A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Dept Date & Time</strong></label>
                                                                    <div>
                                                                        {{ $booking_modal_data->pnr->dept_date ? Helper::appDateFormat($booking_modal_data->pnr->dept_date) : 'N/A' }}
                                                                        </br> {{ $booking_modal_data->pnr->dept_time }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Return Date & Time</strong></label>
                                                                    <div>
                                                                        {{ $booking_modal_data->pnr->dept_date ? Helper::appDateFormat($booking_modal_data->pnr->return_date) : 'N/A' }}
                                                                        </br>
                                                                        {{ $booking_modal_data->pnr->return_time }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-4">
                                                                    <label><strong>Baggage Details</strong></label>
                                                                    <div>
                                                                        {!! nl2br($booking_modal_data->pnr->baggage) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label><strong>Flight Itinerary</strong></label>
                                                                    <div>
                                                                        {!! nl2br($booking_modal_data->pnr->itenary) !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        <label><strong>Package Details</strong></label>
                                        <div class="col-lg-12">
                                            <div class="instructor-list flex-fill bg-purple">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Package Name</strong></label>
                                                            <div>{{ optional($booking_modal_data->package)->name ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Package Type</strong></label>
                                                            <div>
                                                                {{ optional($booking_modal_data->packagetype)->package_type ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Sharing Type</strong></label>
                                                            <div>{{ optional($booking_modal_data->sharingtype)->name ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        @if ($booking_modal_data->service_type == 2)
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label><strong>Hotel Details</strong></label>
                                                    {{-- <div>Burj Deafa</div> --}}
                                                </div>
                                            </div>
                                            @foreach ($hotels as $hotel)
                                                <div class="col-6">
                                                    {{-- <div class="mb-4"> --}}
                                                    <div class="col-md-12 col-sm-12">

                                                        <div class="blog grid-blog ">
                                                            <div class="blog-image" style="max-height:400px;">
                                                                <a href="javascript:void(0)"><img class="img-fluid"
                                                                        src="{{ asset('/storage/hotel_photo/' . $hotel->hotelimage[0]->hotel_img) }}"
                                                                        alt="Post Image"></a>
                                                            </div>
                                                            <div class="blog-grid-box">
                                                                <div class="blog-info clearfix">
                                                                    <div class="post-left">
                                                                        <ul>
                                                                            <li><img class="img-fluid"
                                                                                    src="{{ asset('/assets/user/images/icons/icon-23.svg') }}"
                                                                                    alt="">{{ $hotel->hotel_name }}
                                                                            </li>
                                                                            <li><img class="img-fluid"
                                                                                    src="{{ asset('/assets/user/images/icons/icon-star.svg') }}"
                                                                                    alt="">{{ $hotel->star_rating }}
                                                                            </li>
                                                                            <li><img class="img-fluid"
                                                                                    src="{{ asset('/assets/user/images/icons/icon-20.svg') }}"
                                                                                    alt="">{{ $hotel->city->city_name ?? '' }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                </div>
                                            @endforeach
                                            {{-- <div class="col-6">
                                                <div class="mb-4">
                                                    <div class="col-md-12 col-sm-12">

                                                        <div class="blog grid-blog">
                                                            <div class="blog-image">
                                                                <a href="javascript:void(0)"><img class="img-fluid"
                                                                        src="{{ asset('/storage/hotels/c84dee7e-8f99-4bd4-9627-908da7737721.jpg') }}"
                                                                        alt="Post Image"></a>
                                                            </div>
                                                            <div class="blog-grid-box">
                                                                <div class="blog-info clearfix">
                                                                    <div class="post-left">
                                                                        <ul>
                                                                            <li><img class="img-fluid"
                                                                                    src="assets/img/icon/icon-23.svg"
                                                                                    alt="">Burj Deafa</li>
                                                                            <li><img class="img-fluid"
                                                                                    src="assets/img/icon/icon-22.svg"
                                                                                    alt="">3 Stars</li>
                                                                            <li><img class="img-fluid"
                                                                                    src="assets/img/icon/icon-23.svg"
                                                                                    alt="">Makka</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endif

                                        {{-- <label><strong>Passenger Details</strong></label>
                                        <div class="col-lg-12">
                                            <div class="instructor-list flex-fill bg-warning">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Passenger Name</strong></label>
                                                            <div>{{ $booking_modal_data->mehram_name ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Number of Adults</strong></label>
                                                            <div>{{ $booking_modal_data->adult ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Number of Child With Bed</strong></label>
                                                            <div>{{ $booking_modal_data->child_bed ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Number of Child Without Bed</strong></label>
                                                            <div>{{ $booking_modal_data->child ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Number of Infants</strong></label>
                                                            <div>{{ $booking_modal_data->infant ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Total PAX
                                                                    (Adults+Children+Infants)</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->adult + $booking_modal_data->child + $booking_modal_data->child_bed + $booking_modal_data->infant ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Total Beds</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->adult + $booking_modal_data->child_bed ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Contact</strong></label>
                                                            <div>{{ $booking_modal_data->contact ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Email</strong></label>
                                                            <div>{{ $booking_modal_data->email_id ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <label><strong>Passenger Details</strong></label>
                                        <div class="col-lg-12">
                                            <div class="instructor-list flex-fill bg-purple">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Departure City</strong></label>
                                                            <div>{{ $booking_modal_data->city->city_name ?? '---' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Travel Date </strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->travel_date ? Helper::appDateFormat($booking_modal_data->travel_date) : 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Package PNR</strong></label>
                                                            <div>{{ $booking_modal_data->pnr->pnr_code ?? '---' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Package Type</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->packagetype->package_type ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Shairing Type</strong></label>
                                                            <div>{{ $booking_modal_data->sharingtype->name ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Package Days</strong></label>
                                                            <div>{{ $booking_modal_data->days ?: 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <label><strong>Price Details</strong></label>
                                        <div class="col-lg-12">

                                            <div class="instructor-list flex-fill bg-warning">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Total Cost</strong></label>
                                                            <div>{{ number_format($booking_modal_data->tot_cost) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Is Paid</strong></label>
                                                            <div>{{ $booking_modal_data->is_paid = 1 ? 'Yes' : 'No' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-4">
                                                            <label><strong>Cost Breakup</strong></label>
                                                            <div>{!! $booking_modal_data->cost_breackup ?: 'N/A' !!} </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <label><strong>Other Details</strong></label>
                                        <div class="col-lg-12">
                                            <div class="instructor-list flex-fill bg-purple">
                                                <div class="row" style="width: 100%">
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Created Date</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->created_at ? Helper::appDateFormat($booking_modal_data->created_at) : 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-4">
                                                            <label><strong>Updated Date</strong></label>
                                                            <div>
                                                                {{ $booking_modal_data->updated_at ? Helper::appDateFormat($booking_modal_data->updated_at) : 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-4">
                                                            <label><strong>Special Request (If Any)</strong></label>
                                                            <div>{{ $booking_modal_data->special_request ?: 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        loading........
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">{{ __('tablevars.payment_information') }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div>
                            <div class="section-title mt-0">
                                @if (!empty($payments_modal_data) && count($payments_modal_data) != 0)
                                    Booking ID -{{ $payments_modal_data[0]->booking->booking_id }}
                                @endif
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Receipt ID</th>
                                        <th scope="col">Deposite Type</th>
                                        <th scope="col">Amount ( {{ Aihut::get('currency') }} )</th>
                                        <th scope="col">TXN Id</th>
                                        <th scope="col">TXN Date</th>
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 0 @endphp
                                    {{-- @if ($payments_modal_data) --}}
                                    @forelse ($payments_modal_data ?? [] as $payments)
                                        @php $count++; @endphp
                                        <tr>
                                            <th scope="row">{{ $count }}</th>
                                            <td>{{ $payments->receipt_id }}</td>
                                            <td>{{ $payments->deposite_type }}</td>
                                            <td>{{ number_format($payments->amount, 2) }}</td>
                                            <td>{{ $payments->txn_id }}</td>
                                            <td>{{ $payments->txn_date }}</td>
                                            <td>{{ $payments->bank_name }}</td>
                                            <td>
                                                @if ($payments->payment_status == 0)
                                                    <span class="text-danger">
                                                        Pending
                                                    </span>
                                                @elseif($payments->payment_status == 1)
                                                    <span class="text-success">
                                                        Approved
                                                    </span>
                                                @elseif($payments->payment_status == 2)
                                                    <span class="badge badge-danger">
                                                        Unclear
                                                    </span>
                                                @elseif($payments->payment_status == 3)
                                                    <span class="badge badge-warning">
                                                        Bounce
                                                    </span>
                                                @elseif($payments->payment_status == 4)
                                                    <span class="badge badge-success">
                                                        Not received
                                                    </span>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="8" class="text-center text-danger">
                                                <span>
                                                    {{ __('tablevars.no_record') }}
                                                </span>
                                            </td>

                                        </tr>
                                    @endforelse
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
