<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.vouchers') }}</h1>
            <div class="section-header-button">
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.download') }} {{ __('tablevars.managment') }}</div>
                <div class="breadcrumb-item"><a href="{{ route('admin.vouchers.index') }}"
                        wire:navigate>{{ __('tablevars.vouchers') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.all') }} {{ __('tablevars.vouchers') }}
                    {{ __('tablevars.list') }}</div>
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
                                        placeholder="Search Booking Id" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="search_name">Mehram Name</label>
                                    <input type="text" name="search_name" id="search_name"
                                        class="form-control"wire:model='search_name' wire:keyup="filterBookings"
                                        placeholder="Search Mehram Name" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control" wire:model='start_date' wire:change="filterBookings" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control" wire:model='end_date' wire:change="filterBookings" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.vouchers') }} {{ __('tablevars.list') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tablevars.#') }}</th>
                                            <th>{{ __('tablevars.booking_id') }}</th>
                                            <th>{{ __('tablevars.service') }}</th>
                                            <th>{{ __('tablevars.agency') }}</th>
                                            <th>{{ __('tablevars.travel_date') }}</th>
                                            <th>{{ __('tablevars.meheram_name') }}</th>
                                            <th>{{ __('tablevars.pax') }}</th>
                                            <th class="no-wrap">{{ __('tablevars.total_price') }} ({{ '₹' }})</th>
                                            <th>{{ __('tablevars.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Vouchers as $key => $voucher)
                                        
                                        <tr>
                                            <td>{{ $key + $Vouchers->firstItem() }}</td>
                                            <td>{{ $voucher->bookingId }}</td>
                                            <td>{{ $voucher->name }}</td>
                                            <td>{{ $voucher->agency_name ?? '---' }}</td>
                                            <td>
                                                {{ $voucher->travel_date ? Helper::formatCarbonDate($voucher->travel_date) : '---' }}
                                            </td>
                                            <td>{{ $voucher->mehram_name }}</td>
                                            <td class="no-wrap">
                                                {{ $voucher->adult + $voucher->child + $voucher->child_bed + $voucher->infant }}
                                                <span>( Adults: {{ $voucher->adult }} )</span><br />
                                                <span>( Children: {{ $voucher->child + $voucher->child_bed }} )</span><br />
                                                <span>( Infants: {{ $voucher->infant }} )</span><br />
                                            </td>
                                            <td>
                                                {{ number_format($voucher->tot_cost) }}
                                            </td>
                                            <td>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fas fa-cog"
                                                            data-toggle="tooltip" title="Options"></i></button>
                                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a wire:click="downloadVoucher('{{ $voucher->id }}')"
                                                                class="dropdown-item" data-toggle="tooltip"
                                                                title="Download voucher"
                                                                href="javascript:void(0)">Download voucher</a>
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
                                {{ $Vouchers->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
</div>
