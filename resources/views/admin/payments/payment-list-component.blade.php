<div class="main-content">
    <div wire:loading>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; top: 0px; left:0px; z-index:9999; width: 100%; height:100%; opacity:.75;">
            <div class="la-ball-fussion la-3x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.payment') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.payment') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}"
                        wire:navigate>{{ __('tablevars.payment') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.payment') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_start_date">{{ __('tablevars.start_date') }}</label>
                                    <input type="date" name="search_start_date" id="search_start_date"
                                        class="form-control" placeholder="Search Booking Id" autocomplete="off"
                                        wire:model='search_start_date' wire:change="filterPayments">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_end_date">{{ __('tablevars.end_date') }}</label>
                                    <input type="date" name="search_end_date" id="search_end_date"
                                        class="form-control" placeholder="Search Name"
                                        autocomplete="off"wire:model='search_end_date' wire:change="filterPayments">
                                </div> --}}
                                <div class="col-6 mb-2">
                                    <label class="label-header"
                                        for="search_bookingid">{{ __('tablevars.booking_id') }}</label>
                                    <input type="text" name="search_bookingid" id="search_bookingid"
                                        class="form-control" placeholder="Search Booking Id" autocomplete="off"
                                        wire:model='search_booking_id' wire:keyup="filterPayments">
                                </div>
                                <div class="col-6 mb-2">
                                    <label class="label-header"
                                        for="search_name">{{ __('tablevars.agency_name') }}</label>
                                    <input type="text" name="search_name" id="search_name" class="form-control"
                                        placeholder="Search Name" autocomplete="off" wire:model='search_name'
                                        wire:keyup="filterPayments">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_recepitid">{{ __('tablevars.receiptid') }}</label>
                                    <input type="text" name="search_recepitid" id="search_recepitid"
                                        class="form-control" placeholder="Search Receipt Id" autocomplete="off"
                                        wire:model='search_receipt_id' wire:keyup="filterPayments">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header"
                                        for="search_txn_no">{{ __('tablevars.txn_no') }}</label>
                                    <input type="text" name="search_txn_no" id="search_txn_no" class="form-control"
                                        placeholder="Search TXN No" autocomplete="off"wire:model='search_txn_id'
                                        wire:keyup="filterPayments">
                                </div>
                                <div class="col-4 mb-2">
                                    <label class="label-header" for="status">{{ __('Status') }}</label>
                                    <select name="status" id="status" class="form-control" wire:model="status" wire:change="filterPayments">
                                        <option value="">Select Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.payment') }} {{ __('tablevars.list') }}</h4>

                            <div>
                                <a href="{{ route('admin.payment.create') }}" class="btn btn-primary"
                                    wire:navigate>{{ __('tablevars.add') }} {{ __('tablevars.new') }}</a>
                                <a href="javascript:void(0);" class="btn btn-info" style="color: white;"
                                    wire:click="exportToExcel">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                                <a href="javascript:void(0);" style="color: white" class="btn btn-warning"
                                    wire:click="download"><i class="fas fa-print"></i>Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.receiptid') }}</th>
                                            <th>{{ __('tablevars.agency_name') }}</th>
                                            <th>{{ __('tablevars.deposite_type') }}</th>
                                            <th>{{ __('tablevars.amount') }} ( {{ Aihut::get('currency') }} )</th>
                                            <th>{{ __('tablevars.txn_no') }}</th>
                                            <th>{{__('tablevars.bank_name')}}</th>
                                            <th>{{ __('tablevars.TXN_date') }}</th>
                                            <th>{{ __('tablevars.status') }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($AllPayments as $key => $AllPayment)
                                            <tr>
                                                <td>{{ $key + $AllPayments->firstItem() }} </td>
                                                <td> <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#bookingModal"
                                                        wire:click="getBookingContent({{ $AllPayment->booking_id ?? '' }})">{{ $AllPayment->booking->booking_id ?? '' }}</a>
                                                </td>
                                                <td>{{ $AllPayment->receipt_id }}</td>
                                                <td>{!! $AllPayment->booking->agency->agency_name ?? 'website' !!}</td>
                                                <td>{{ $AllPayment->deposite_type }}</td>
                                                <td>{{ Helper::properDecimals($AllPayment->amount) }}</td>
                                                <td>{{ $AllPayment->txn_id }}</td>
                                                <td>{{ $AllPayment->bank_name }}</td>
                                                <td style="white-space: nowrap;">
                                                    {{ Helper::getCanonicalDate($AllPayment->txn_date) }}</td>
                                                <td>
                                                    @php
                                                        $statusLabels = [
                                                            0 => ['label' => 'Pending', 'class' => 'badge-info'],
                                                            1 => ['label' => 'Approved', 'class' => 'badge-primary'],
                                                            2 => ['label' => 'Unclear', 'class' => 'badge-danger'],
                                                            3 => ['label' => 'Bounce', 'class' => 'badge-warning'],
                                                            4 => [
                                                                'label' => 'Not received',
                                                                'class' => 'badge-secondary',
                                                            ],
                                                        ];
                                                    @endphp
                                                    @if (array_key_exists($AllPayment->payment_status, $statusLabels))
                                                        <div
                                                            class="badge {{ $statusLabels[$AllPayment->payment_status]['class'] }}">
                                                            {{ $statusLabels[$AllPayment->payment_status]['label'] }}
                                                        </div>
                                                    @endif
                                                </td>

                                                {{-- <td>
                                                    <!-- Check if the payment is offline -->
                                                    @if ($AllPayment->is_offline)
                                                        <button wire:click="isDelete({{ $AllPayment->id }})" class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td> --}}

                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; right: 0px; will-change: transform;">
                                                            {{-- @if ($AllPayment->payment_status == 0)
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item text-primary"
                                                                    wire:click='isApprove({{ $AllPayment->id }})'>{{ __('tablevars.approve') }}</a>
                                                            @endif --}}
                                                            {{-- <a class="dropdown-item"
                                                                href="javascript:void(0)"data-bs-toggle="modal"
                                                                data-bs-target="#bookingModal"
                                                                wire:click="getBookingContent({{ $AllPayment->booking_id }})">Booking Details</a>   --}}
                                                            {{-- <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#bookingModal"
                                                                data-toggle="tooltip" title="Booking Details"
                                                                wire:click="getBookingContent({{ $AllPayment->booking_id }})">Booking
                                                                Details</a> --}}
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                class="dropdown-item" data-bs-target="#viewModal"
                                                                data-toggle="tooltip" title="View"
                                                                wire:click="getPaymentContent({{ $AllPayment->id }})">View</a>


                                                            @if ($AllPayment->payment_status == 0)
                                                                <!-- Show Edit button only if payment_status is 0 (Pending) -->
                                                                <a href="{{ route('admin.payment.edit', $AllPayment->id) }}"
                                                                    class="dropdown-item">Edit</a>
                                                            @endif


                                                            {{-- <a class="dropdown-item"
                                                                href="{{ route('admin.payment.edit', $AllPayment->id) }}">Edit</a> --}}

                                                            @if ($AllPayment->payment_status == 0)
                                                                <!-- Show delete button only if payment_status is 0 (Pending) -->
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item text-primary"
                                                                    wire:click='isApprove({{ $AllPayment->id }})'>{{ __('tablevars.approve') }}</a>
                                                                <a href="javascript:void(0)"
                                                                    class="dropdown-item text-danger"
                                                                    wire:click='isDelete({{ $AllPayment->id }})'>{{ __('tablevars.trash') }}</a>
                                                            @endif
                                                            {{-- <a href="javascript:void(0)"
                                                                class="dropdown-item text-danger"
                                                                wire:click='isDelete({{ $AllPayment->id }})'>{{ __('tablevars.trash') }}</a> --}}
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
                                        wire:change='filterPayments'>

                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{ $AllPayments->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Payment Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @if ($payments_modal_data)
                        <table class="table table-striped">
                            <tr>
                                <th>Booking Id</th>
                                <td>{{ $payments_modal_data->booking->booking_id ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Balance Amount*</th>
                                <td>{{ number_format($balance, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Deposit Type</th>
                                <td>{{ $payments_modal_data->deposite_type }}</td>
                            </tr>
                            <tr>
                                <th>Cheque no. or Txn No</th>
                                <td>{{ $payments_modal_data->txn_id }}</td>
                            </tr>
                            <tr>
                                <th>Company Name</th>
                                <td>{{ $payments_modal_data->company ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Beneficiary Bank Name</th>
                                <td>{{ $payments_modal_data->bank_name }}</td>
                            </tr>
                            <tr>
                                <th>Beneficiary Bank Account Number</th>
                                <td>{{ $payments_modal_data->bank_account_no }}</td>
                            </tr>
                            <tr>
                                <th>Person Name</th>
                                <td>{{ $payments_modal_data->personal_name }}</td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <td>{{ $payments_modal_data->comment }}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>{{ $payments_modal_data->amount }}</td>
                            </tr>
                            <tr>
                                <th>Is Paid</th>
                                <td>{{ $payments_modal_data->is_paid == 1 ? 'YES' : 'NO' }}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td style="white-space: nowrap;">
                                    {{ Helper::getCanonicalDate($payments_modal_data->txn_date) }}</td>

                            </tr>
                        </table>
                    @else
                        loading........
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
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
                        {{-- <div class="card-header">
                        <h4>Flush</h4>
                    </div> --}}
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    @if ($booking_modal_data)
                                        @if (!empty($booking_modal_data->booking_id))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Booking Id</label>
                                                    <div> {{ $booking_modal_data->booking_id }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Reqeust Id</label>
                                                    <div> {{ $booking_modal_data->request_id }}</div>
                                                </div>
                                            </div>
                                        @endif
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
                                                    {{ $booking_modal_data->agency ? $booking_modal_data->agency->agency_name : 'website' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departure City</label>
                                                <div>
                                                    {{ $booking_modal_data->city ? $booking_modal_data->city->city_name : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Travel Date </label>
                                                <div>{{ Helper::formatCarbonDate($booking_modal_data->travel_date) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package PNR</label>
                                                <div>
                                                    {{ $booking_modal_data->pnr ? $booking_modal_data->pnr->pnr_code : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package Name</label>
                                                <div>{{ $booking_modal_data->package->name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Package Type</label>
                                                <div>{{ $booking_modal_data->packagetype->package_type }}</div>
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
                                                <div>{{ $booking_modal_data->days }}</div>
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
                                                <div>{{ $booking_modal_data->adult }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Child With Bed</label>
                                                <div>{{ $booking_modal_data->child_bed }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Child Without Bed</label>
                                                <div>{{ $booking_modal_data->child }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number of Infants</label>
                                                <div>{{ $booking_modal_data->infant }}</div>
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
                                                <div>₹ {{ Helper::properDecimals($booking_modal_data->tot_cost) }}
                                                </div>
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
                                                <div>{{ Helper::appDateFormat($booking_modal_data->created_at) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Updated Date</label>
                                                <div>{{ Helper::appDateFormat($booking_modal_data->updated_at) }}</div>
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
            {{-- <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div> --}}

        </div>
    </div>
    <style>
        .table-responsive{
            min-height: 250px;
        }
    </style>

</div>
