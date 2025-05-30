<div class="main-content">
    {{-- <div wire:loading>
        <div  style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> --}}
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.negotiated_request') }} </h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.booking') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.booking.index') }}"
                        wire:navigate>{{ __('tablevars.booking') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.negotiated_request') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.negotiated_request') }} {{ __('tablevars.list') }}</h4>

                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.request') }} {{ __('tablevars.id') }}</th>
                                            <th>{{ __('tablevars.raised') }} {{ __('tablevars.date') }}</th>
                                            <th>{{ __('tablevars.request') }} {{ __('tablevars.type') }}</th>
                                            <th>{{ __('tablevars.agency_name') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th> {{ __('tablevars.total_cost') }} ({{ Aihut::get('currency') }})</th>
                                            <th>{{ __('tablevars.negotiation_amount') }}
                                                ({{ Aihut::get('currency') }}) </th>
                                            <th>{{ __('tablevars.negotiation_status') }}</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($quotes as $key => $quote)
                                            @php
                                                $totalPaymentAmount = $quote->payment
                                                    ->where('is_paid', 1)
                                                    ->where('payment_status', 1)
                                                    ->sum('amount');

                                                $balance = $quote->tot_cost - $totalPaymentAmount;

                                            @endphp

                                            <tr>
                                                <td>{{ $key + $quotes->firstItem() }}</td>
                                                <td>{{ $quote->request_id }}</td>
                                                <td>{{ Helper::appDateFormat($quote->created_at) }}</td>
                                                <td>{{ $quote->servicetype->name }}
                                                    @if ($quote->service_type == 2)
                                                        @if ($quote->package->umrah_type == 1)
                                                            (FixedGroup)
                                                        @else
                                                            ( Land )
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{!! $quote->agency ? $quote->agency->agency_name : '-' !!}</td>
                                                <td>
                                                    {{ $quote->travel_date ? Helper::formatCarbonDate($quote->travel_date) : '-' }}

                                                </td>
                                                <td>
                                                    {{ number_format($quote->tot_cost, 2) }}

                                                </td>
                                                <td>
                                                    {{ number_format($quote->negotiated_cost, 2) }}


                                                </td>
                                                <td>
                                                    @php
                                                        $statusLabels = [
                                                            0 => ['label' => 'Pending', 'class' => 'badge-info'],
                                                            1 => ['label' => 'Approved', 'class' => 'badge-primary'],
                                                            2 => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                                        ];
                                                    @endphp
                                                    @if (array_key_exists($quote->negotiation_status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$quote->negotiation_status]['class'] }}">
                                                            {{ $statusLabels[$quote->negotiation_status]['label'] }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @if ($quote->negotiation_status != 1 && $quote->negotiation_status != 2)
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item text-primary"
                                                                    wire:click='isApprove({{ $quote->id }})'>{{ __('tablevars.approve') }}
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item text-danger"
                                                                    wire:click='isReject({{ $quote->id }})'>{{ __('tablevars.reject') }}
                                                                </a>
                                                            @endif
                                                            @if ($quote->negotiation_status != 1)
                                                                <a href="javascript:void(0)" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#negotiateModal"
                                                                    wire:click='reNegotiate({{ $quote->id }})'>{{ __('tablevars.negotiate') }}
                                                                </a>
                                                            {{-- @else
                                                            <a href="javascript:void(0)" class="dropdown-item"
                                                                    >Negotiations over
                                                                </a> --}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" align="center" class="v-msg">
                                                    {{ __('tablevars.no_record') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control"wire:model='perPage'
                                        wire:change='filterBookings'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $quotes->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.booking') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($booking_modal_data)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Booking Id</label>
                                                <div> {{ $booking_modal_data->booking_id }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service Type</label>
                                                <div>{{ $booking_modal_data->servicetype->name }}</div>
                                                <!-- Add Service Type -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Agency Name</label>
                                                <div>
                                                    {{ $booking_modal_data->agency ? $booking_modal_data->agency->agency_name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departure City</label>
                                                <div>
                                                    {{ $booking_modal_data->city_id != null ? $booking_modal_data->city->city_name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Travel Date </label>
                                                <div>
                                                    {{ $booking_modal_data->travel_date != null ? $booking_modal_data->travel_date : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package PNR</label>
                                                <div>
                                                    {{ $booking_modal_data->pnr_id != null ? $booking_modal_data->pnr->pnr_code : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package Name</label>
                                                <div>
                                                    {{ $booking_modal_data->package_name != null ? $booking_modal_data->package_name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package Type</label>
                                                <div>
                                                    {{ $booking_modal_data->package_type != null ? $booking_modal_data->package_type : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sharing Type</label>
                                                <div>
                                                    {{ $booking_modal_data->shairing_type != null ? $booking_modal_data->sharingtype->name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package Days</label>
                                                <div>
                                                    {{ $booking_modal_data->days != null ? $booking_modal_data->days : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Passenger Name</label>
                                                <div>{{ $booking_modal_data->mehram_name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Adults</label>
                                                <div>
                                                    {{ $booking_modal_data->adult != null ? $booking_modal_data->adult : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Child With Bed</label>
                                                <div>
                                                    {{ $booking_modal_data->child_bed != null ? $booking_modal_data->child_bed : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Child Without Bed</label>
                                                <div>
                                                    {{ $booking_modal_data->child != null ? $booking_modal_data->child : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Infants</label>
                                                <div>
                                                    {{ $booking_modal_data->infant != null ? $booking_modal_data->infant : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total PAX (Adults+Children+Infants)</label>
                                                <div>
                                                    {{ $booking_modal_data->adult + $booking_modal_data->child + $booking_modal_data->child_bed + $booking_modal_data->infant }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Beds</label>
                                                <div>
                                                    {{ $booking_modal_data->adult + $booking_modal_data->child_bed }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <div>{{ $booking_modal_data->contact }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div>{{ $booking_modal_data->email_id }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Is Paid</label>
                                                <div>{{ $booking_modal_data->is_paid == 1 ? 'Yes' : 'No' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Cost</label>
                                                <div>{{ $booking_modal_data->tot_cost }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cost Breakup</label>
                                                <div>{{ $booking_modal_data->cost_breackup }} </div>
                                                <!-- Add Cost Breakup -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Created Date</label>
                                                <div>
                                                    {{ Helper::getCanonicalDateTime($booking_modal_data->created_at) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Updated Date</label>
                                                <div>
                                                    {{ Helper::getCanonicalDateTime($booking_modal_data->updated_at) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Special Request (If Any)</label>
                                                <div>{{ $booking_modal_data->special_request }}</div>
                                                <!-- Add Special Request -->
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="paymentsModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 85% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.payment') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            {{-- @if (!empty($payments_modal_data) && count($payments_modal_data) > 0) --}}
                            <div class="section-title mt-0">
                                @if (!empty($payments_modal_data) && count($payments_modal_data) != 0)
                                    Booking ID -{{ $payments_modal_data[0]->booking_id }}
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

                            {{-- @endif --}}
                        </div>
                    </div>
                </div>

                {{-- <div class="modal-body">
                    <div class="card">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- Make Payment modal --}}
    <div wire:ignore.self class="modal fade" id="paymentsStatusModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 85% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('tablevars.payment') }}
                        {{ __('tablevars.details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <span>{{ __('tablevars.booking') }} {{ __('tablevars.id') }}
                                        :{{ $booking_id }}</span>
                                </div>
                            </div class="col-2">
                            <span>{{ __('tablevars.total') }} {{ __('tablevars.amount') }}
                                :{{ $total_amount }}</span>
                        </div>

                    </div>


                    <div class="section-title mt-0">
                        @if (!empty($payments_modal_data) && count($payments_modal_data) != 0)
                            Booking ID -{{ $payments_modal_data[0]->booking_id }}
                        @endif
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Receipt ID</th>
                                <th scope="col">Deposite Type</th>
                                <th scope="col">TXN Id</th>
                                <th scope="col">TXN Date</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Amount ( {{ Aihut::get('currency') }} )</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                                $TotalPayment = 0;
                                $TotalAmount = 0;
                            @endphp
                            @forelse ($payments_modal_status as $payments)
                                @php
                                    $count++;
                                    if ($payments->payment_status == 1 && $payments->is_paid == 1) {
                                        $TotalPayment += $payments->amount;
                                    }

                                @endphp
                                <tr>
                                    <th scope="row">{{ $count }}</th>
                                    <td>{{ $payments->receipt_id }}</td>
                                    <td>{{ $payments->deposite_type }}</td>
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
                                    <td>{{ number_format($payments->amount, 2) }}</td>
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

                            <tr>
                                <td colspan="7" style="text-align:right;">Remaining Amount</td>
                                <td>{{ number_format($total_amount_int - $TotalPayment, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <form wire:submit.prevent="paymentSave">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-12 col-form-label" style="color:red;">Note :
                                Please enter an amount and click on proceed to make payment for this booking.</label>
                        </div>
                        <div class="form-group row">
                            <label for="payment_amount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Enter Amount"
                                    name="payment_amount" id="payment_amount" onkeypress="return numbersonly(event);"
                                    required wire:model='payment_amount'>
                                <input type="hidden" class="form-control" name="booking_id" id="booking_id"
                                    value="'.$rows['booking_id'].'">
                            </div>
                            <button type="submit" name="btn_payment"
                                class="btn btn-primary mb-2 col-sm-3">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="negotiateModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Re Negotitate Amount</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="label-header" for="negotiate_amount">Negotitate Amount</label>
                                        <input type="text" name="negotiate_amount" id="negotiate_amount"
                                            class="form-control"wire:model='re_negotiate_amount'
                                            wire:keyup="filterBookings" placeholder="Enter new amount"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='updateNegotiate'>Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
