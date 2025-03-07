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
                                            <h3>{{ __('tablevars.print_receipt') }} {{ __('tablevars.list') }}</h3>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.booking_id') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='booking_id' placeholder="Search booking Id"
                                                            wire:keyup.debounce.500ms="filterBookings"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.receiptid') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='receipt_id' placeholder="Search Receipy Id"
                                                            wire:keyup.debounce.500ms="filterBookings"
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
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.booking_id') }}</th>
                                                        <th>{{ __('tablevars.receipt_id') }}</th>
                                                        <th>{{ __('tablevars.deposite_type') }}</th>
                                                        <th>{{ __('tablevars.amount') }}</th>
                                                        <th>{{ __('tablevars.txn_id') }}</th>
                                                        <th>{{ __('tablevars.TXN_date') }}</th>
                                                        <th>{{ __('tablevars.created') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($PrintReceipts as $key => $PrintReceipt)
                                                        <tr>
                                                            <td>{{ $key + $PrintReceipts->firstItem() }}</td>
                                                            <td>{{ $PrintReceipt->booking->booking_id }}</td>
                                                            <td>{{ $PrintReceipt->receipt_id }}</td>
                                                            <td>{{ $PrintReceipt->deposite_type }}</td>
                                                            <td>{{ number_format($PrintReceipt->amount, 2) }}</td>
                                                            <td>{{ $PrintReceipt->txn_id }}</td>
                                                            <td>{{ App\Helpers\Helper::getCanonicalDate($PrintReceipt->txn_date) }}
                                                            </td>
                                                            <td>{{ App\Helpers\Helper::getCanonicalDate($PrintReceipt->created_at) }}
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
                                                                        <a class="dropdown-item"
                                                                            wire:click="downloadReceipt('{{ $PrintReceipt->id }}')"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="tooltip"
                                                                            title="Print">{{ __('tablevars.print') }}</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="12" align="center" class="text-danger">
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
                                                <select name="per_page" id="per_page"
                                                    class="form-control"wire:model='perPage'
                                                    wire:change='filterBookings'>
                                                    @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $PrintReceipts->links(data: ['scrollTo' => false]) }}
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
</div>
</div>
