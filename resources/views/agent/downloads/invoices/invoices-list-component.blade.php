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
                                            <h3>{{ __('tablevars.invoice_list') }}</h3>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.booking_id') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='booking_id' placeholder="Search booking Id"
                                                            wire:keyup.debounce.500ms="filterBookings" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="label-header" for="search_name">Name</label>
                                                        <input type="text" name="search_name" id="search_name"
                                                            class="form-control"wire:model='search_name'
                                                            wire:keyup="filterBookings" placeholder="Search Name"
                                                            autocomplete="off" maxlength="50">
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
                                                        <th>{{ __('tablevars.service') }}</th>
                                                        <th>{{ __('tablevars.agency') }}</th>
                                                        <th>{{ __('tablevars.travel_date') }}</th>
                                                        <th>{{ __('tablevars.meheram_name') }}</th>
                                                        <th>{{ __('tablevars.pax') }}</th>
                                                        <th>{{ __('tablevars.total_price') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($Invoices as $key => $Invoice)
                                                    {{-- {{ dd($Invoice) }} --}}
                                                        <tr>
                                                            <td>{{ $key + $Invoices->firstItem() }}</td>
                                                            <td>{{ $Invoice->booking_id }}</td>
                                                            <td>{{ $Invoice->servicetype->name ?? '' }}</td>
                                                            <td>{{ $Invoice->agency->agency_name ?? '' }}</td>
                                                            <td>{{ $Invoice->travel_date }}</td>
                                                            <td>{{ $Invoice->mehram_name }}</td>
                                                            <td>{{ $Invoice->adult + $Invoice->child + $Invoice->child_bed + $Invoice->infant }}
                                                            </td>
                                                            <td>{{ $Invoice->tot_cost }}</td>
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
                                                                        <a wire:click="downloadInvoice('{{ $Invoice->id }}')"
                                                                            href="javascript:void(0)"
                                                                            class="dropdown-item" data-toggle="tooltip" title="Download Invoice"
                                                                            title="Download
                                                                            Invoice">Download
                                                                            Invoice</a>
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
                                            {{ $Invoices->links(data: ['scrollTo' => false]) }}
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
