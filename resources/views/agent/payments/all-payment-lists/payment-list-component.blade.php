<div class="page-content">
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

                                            <div>
                                                <a href="{{ route('agent.bookings.index') }}">
                                                    {{ __('tablevars.all') }} {{ __('tablevars.booking') }}
                                                    <span style="color: red">({{ $bookingcount }})</span>
                                                </a>
                                                <h3>{{ __('tablevars.all') }} {{ __('tablevars.payment') }}
                                                    {{ __('tablevars.list') }}</h3>
                                            </div>
                                            <div>
                                                {{-- <a class="btn btn-primary" href="{{ route('agent.payment.create') }}"
                                                    class="ticket-btn-grp" title="Add Bookings">New Payment</a> --}}
                                                <a href="javascript:void(0);" style="color: white" class="btn btn-info"
                                                    wire:click="exportToExcel"><i class="fas fa-file-excel"></i> Export
                                                    to excel</a>
                                                <a href="javascript:void(0);" style="color: white"
                                                    class="btn btn-warning" wire:click="download"><i
                                                        class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-3 mb-2">
                                                        <label class="label-header"
                                                            for="search_start_date">{{ __('tablevars.start_date') }}</label>
                                                        <input type="date" name="search_start_date"
                                                            id="search_start_date" class="form-control"
                                                            placeholder="Search Booking Id" autocomplete="off"
                                                            wire:model='search_start_date' wire:change="filterPayments">
                                                    </div>
                                                    <div class="col-3 mb-2">
                                                        <label class="label-header"
                                                            for="search_end_date">{{ __('tablevars.end_date') }}</label>
                                                        <input type="date" name="search_end_date"
                                                            id="search_end_date" class="form-control"
                                                            placeholder="Search Name"
                                                            autocomplete="off"wire:model='search_end_date'
                                                            wire:change="filterPayments">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.booking_id') }}</label>
                                                        <input type="text" class="form-control" name="booking_id"
                                                            wire:model='booking_id' placeholder="Search booking Id"
                                                            wire:keyup.debounce.500ms="filterPayments"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.receiptid') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_receiptid'
                                                            placeholder="Search receipt id"
                                                            wire:keyup.debounce.500ms="filterPayments"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('tablevars.#') }}</th>
                                                        <th>{{ __('tablevars.booking_id') }}</th>
                                                        <th>{{ __('tablevars.receiptid') }}</th>
                                                        <th>{{ __('tablevars.deposite_type') }}</th>
                                                        <th>{{ __('tablevars.amount') }}</th>
                                                        {{-- <th>{{ __('tablevars.company_name') }}</th> --}}
                                                        <th>{{ __('tablevars.txn_no') }}</th>
                                                        <th>{{ __('tablevars.txn_date') }}</th>
                                                        <th>{{ __('tablevars.bank') }} {{ __('tablevars.name') }}</th>
                                                        <th>{{ __('tablevars.status') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($payments as $key => $payment)
                                                        <tr>
                                                            <td>{{ $key + $payments->firstItem() }}</td>
                                                            <td>{{ $payment->booking->booking_id }}</td>
                                                            <td>{{ $payment->receipt_id }}</td>
                                                            <td>{{ $payment->deposite_type }}</td>
                                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                                            {{-- <td>{{ $payment->company }}</td> --}}
                                                            <td>{{ $payment->txn_id == null ? '-' : $payment->txn_id }}
                                                            </td>
                                                            <!-- <td>{{ App\Helpers\Helper::getCanonicalDate($payment->txn_date) }}</td> -->
                                                            <td>{{ Helper::appDateFormat($payment->txn_date) }}</td>
                                                            <td>{{ $payment->bank_name }}</td>
                                                            <td>
                                                                @php
                                                                    $statusLabels = [
                                                                        0 => [
                                                                            'label' => 'Pending',
                                                                            'class' => 'badge-info',
                                                                        ],
                                                                        1 => [
                                                                            'label' => 'Approved',
                                                                            'class' => 'badge-primary',
                                                                        ],
                                                                        2 => [
                                                                            'label' => 'Unclear',
                                                                            'class' => 'badge-danger',
                                                                        ],
                                                                        3 => [
                                                                            'label' => 'Bounce',
                                                                            'class' => 'badge-warning',
                                                                        ],
                                                                        4 => [
                                                                            'label' => 'Not received',
                                                                            'class' => 'badge-success',
                                                                        ],
                                                                    ];
                                                                @endphp
                                                                @if (array_key_exists($payment->payment_status, $statusLabels))
                                                                    <div
                                                                        class="pointer badge {{ $statusLabels[$payment->payment_status]['class'] }}">
                                                                        {{ $statusLabels[$payment->payment_status]['label'] }}
                                                                    </div>
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
                                                                        <a href="javascript:void(0)"
                                                                            data-bs-toggle="modal" class="dropdown-item"
                                                                            data-bs-target="#paymentModal"
                                                                            data-toggle="tooltip" title="View"
                                                                            wire:click="getPaymentContent({{ $payment->id }})">View</a>
                                                                        <a wire:click="downloadReceipt('{{ $payment->id }}')"
                                                                            class="dropdown-item"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip"
                                                                            title="Print">{{ __('tablevars.print') }}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="10" align="center" class="text-danger">
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
                                                    class="form-control" wire:change='filterPayments'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $payments->links(data: ['scrollTo' => false]) }}
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
    <!-- View Modal -->
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
                            <div class="row">
                                @if ($payments_modal_data)
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.booking_id') }}</strong></label>
                                            <div> {{ $payments_modal_data->booking->booking_id }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.balance') }}
                                                    {{ __('tablevars.amount') }}</strong></label>
                                            <div>₹ {{ number_format($balance, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.deposite_type') }}</strong>
                                                <div> {{ $payments_modal_data->deposite_type }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.check_txn') }}</strong></label>
                                            <div> {{ $payments_modal_data->txn_id }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.beneficiary') }}
                                                    {{ __('tablevars.bank_name') }}</strong></label>
                                            <div> {{ $payments_modal_data->bank_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.beneficiary_bank_account_no') }}</strong></label>
                                            <div> {{ $payments_modal_data->bank_account_no }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.person_name') }}</strong></label>
                                            <div> {{ $payments_modal_data->personal_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.comments') }}</strong></label>
                                            <div> {{ $payments_modal_data->comment }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.amount') }}</strong></label>
                                            <div>₹ {{ number_format($payments_modal_data->amount, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.is_paid') }}</strong></label>
                                            <div> {{ $payments_modal_data->is_paid == 1 ? 'Paid' : 'Unpaid' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.transaction_dt') }}</strong></label>
                                            <div> {{ Helper::formatCarbonDate($payments_modal_data->txn_date) }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.payment_status') }}</strong></label>
                                            <div>
                                                @if ($payments_modal_data->payment_status == 0)
                                                    Pending
                                                @elseif ($payments_modal_data->payment_status == 1)
                                                    Approved
                                                @elseif ($payments_modal_data->payment_status == 2)
                                                    Unclear
                                                @elseif ($payments_modal_data->payment_status == 3)
                                                    Bounce
                                                @else
                                                    Unknown Status
                                                @endif
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
