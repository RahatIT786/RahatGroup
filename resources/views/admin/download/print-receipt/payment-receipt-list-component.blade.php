<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.payment_receipt') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.download') }} {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.printReceipt.index') }}"
                        wire:navigate>{{ __('tablevars.all') }} {{ __('tablevars.payment_receipt') }}
                        {{ __('tablevars.list') }}</a></div>
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
                                <div class="col-3">
                                    <label class="label-header" for="search_booking_id">Booking Id</label>
                                    <input type="text" name="search_booking_id" id="search_booking_id"
                                        class="form-control" wire:model='search_booking_id' wire:keyup="filterBookings"
                                        placeholder="Search Booking Id"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_receipt_id">Receipt Id</label>
                                    <input type="text" name="search_receipt_id" id="search_receipt_id"
                                        class="form-control"wire:model='search_receipt_id' wire:keyup="filterBookings"
                                        placeholder="Search Receipt Id" autocomplete="off">
                                </div>
                                <div class="col-3 mb-2">
                                    <label class="label-header" for="search_start_date">TXN Date</label>
                                    <input type="date" name="search_start_date" id="search_start_date"
                                        class="form-control" autocomplete="off" wire:model='search_start_date'
                                        wire:change="filterBookings">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.payment_receipt') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.receipt_id') }}</th>
                                            <th>{{ __('tablevars.deposite_type') }}</th>
                                            <th>{{ __('tablevars.amount') }} ({{ Aihut::get('currency') }})</th>
                                            <th>{{ __('tablevars.txn_id') }}</th>
                                            <th>{{ __('tablevars.TXN_date') }}</th>
                                            {{-- <th>{{ __('tablevars.created') }}</th> --}}
                                            <th>{{ 'Receipt PDF' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($PaymentReceipt as $key => $payment)
                                            <tr>
                                                <td>{{ $key + $PaymentReceipt->firstItem() }}</td>
                                                <td>{{ $payment->booking != null ? $payment->booking->booking_id : '-' }}</td>
                                                <td>{{ $payment->receipt_id }}</td>
                                                <td>{{ $payment->deposite_type }}</td>
                                                <td>{{ number_format($payment->amount) }}.00</td>
                                                <td>{{ $payment->txn_id }}</td>
                                                <td>{{ $payment->txn_date ? Helper::formatCarbonDate($payment->txn_date) : '' }}
                                                </td>
                                                {{-- <td>
                                                    {{ $payment->created_at ? Helper::formatCarbonDate($payment->created_at) : '' }}
                                                </td> --}}
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fas fa-cog"
                                                                data-toggle="tooltip" title="Options"></i></button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a wire:click="downloadReceipt('{{ $payment->id }}')"
                                                                href="javascript:void(0)" class="dropdown-item"
                                                                data-toggle="tooltip" title="View">View</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" align="center" class="v-msg">
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
                                {{ $PaymentReceipt->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

</div>
