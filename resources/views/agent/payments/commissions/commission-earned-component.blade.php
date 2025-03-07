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
                                            <h3>{{ __('tablevars.commissions') }} {{ __('tablevars.earned') }}</h3>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('tablevars.name') }}</th>
                                                        <th class="text-center">{{ __('tablevars.booking') }} {{ __('tablevars.details') }}</th>
                                                        <th class="text-center">{{ __('tablevars.package') }} {{ __('tablevars.details') }}</th>
                                                        <th class="text-center">{{ __('tablevars.tot_pax') }}</th>
                                                        <th class="text-center">{{ __('tablevars.commission_rate') }} ({{ Aihut::get('currency') }})</th>
                                                        <th class="text-center">{{ __('tablevars.total') }} ({{ Aihut::get('currency') }}) </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($bookings as $key => $booking)
                                                        <tr>
                                                            <td style="width: 10%;" class="text-center">
                                                                <span class="text-info">
                                                                    <b>{{ ucfirst($booking->mehram_name) }}</b>
                                                                </span></br>
                                                            </td>
                                                            <td style="width: 20%;" class="text-center">
                                                                <span><b>ID:</b></span>
                                                                <span>{{ $booking->booking_id }}</span></br>
                                                                <span><b>On: </b></span>
                                                                <span>{{ Helper::appDateFormat($booking->created_at) }}</span></br>
                                                                <span><b>Dept Date:</b></span>
                                                                <span>{{ Helper::appDateFormat($booking->travel_date) }}</span></br>
                                                            </td>
                                                            <td style="width: 15%;" class="text-center">

                                                                @if ($booking->service_type == 1)
                                                                    <span class="web-badge badge-purple">
                                                                @elseif($booking->service_type == 2)
                                                                    <span class="web-badge badge-warning">
                                                                @elseif($booking->service_type == 3)
                                                                    <span class="web-badge badge-primary">
                                                                @else
                                                                    <span class="web-badge badge-primary">
                                                                @endif
                                                                {{ $booking->servicetype != null ? $booking->servicetype->name : '-' }}</span></br></br>
                                                                <span><b>{{ $booking->package != null ? $booking->package->name : '-' }}</b></span></br>
                                                                <span>{{ $booking->packagetype != null ? $booking->packagetype->package_type : '' }}</span>
                                                            </td>
                                                            {{-- <td style="width: 15%;" class="text-center">
                                                                <span><b>Departure Date:</b></span></br>
                                                                <span>{{ $booking->travel_date ?? '-' }}</span></br>
                                                            </td> --}}
                                                            <td style="width: 10%;" class="text-center">
                                                                <b><span class="text-success">{{ $booking->adult }}
                                                                        Adult</span></br>
                                                                    <span
                                                                        class="text-success">{{ $booking->child_bed + $booking->child }}
                                                                        Child</span></br>
                                                                    <span class="text-success">{{ $booking->infant }}
                                                                        Infant</span></b>
                                                            </td>
                                                            <td style="width: 15%;" class="text-center">
                                                                <b>
                                                                    <span class="text-primary">
                                                                        {{ number_format($commission->adult_commision,2) }} X {{ $booking->adult }}
                                                                    </span></br>
                                                                    <span class="text-primary">
                                                                        {{ number_format($commission->chlid_commision,2) }} X {{ $booking->child_bed + $booking->child }}
                                                                    </span></br>
                                                                    <span class="text-primary">
                                                                        {{ number_format($commission->infant_commision,2) }} X {{ $booking->infant }}
                                                                    </span>
                                                                </b>
                                                            </td>
                                                            <td style="width: 15%;" class="text-center">
                                                                <b>
                                                                    <span class="text-primary">
                                                                       {{ number_format( $booking->adult * $commission->adult_commision + ($booking->child_bed + $booking->child) * $commission->chlid_commision + $booking->infant * $commission->infant_commision, 2 )  }}
                                                                    </span></br>

                                                                </b>
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

                                        <label><strong>Passenger Details</strong></label>
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
                                        </div>

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
                                        @if ($booking_modal_data->service_type == 2)
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label><strong>Hotel Details</strong></label>
                                                    {{-- <div>Burj Deafa</div> --}}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                {{-- <div class="mb-4"> --}}
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
                                                {{-- </div> --}}
                                            </div>
                                            <div class="col-6">
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
                                            </div>
                                        @endif
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
