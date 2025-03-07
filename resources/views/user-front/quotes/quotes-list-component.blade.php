<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div
                                            class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                            <h3>{{ __('tablevars.request') }} {{ __('tablevars.list') }}</h3>

                                            <div>
                                                <a class="btn btn-primary" href="{{ route('customer.quotes.create') }}"
                                                    class="ticket-btn-grp" title="Add Request">{{ __('tablevars.new') }}
                                                    {{ __('tablevars.request') }}</a>

                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label class="form-control-label">{{ __('tablevars.request') }}
                                                            {{ __('tablevars.id') }}</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search Booking Id"
                                                            wire:model='search_request_id' wire:keyup="filterBookings"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                            maxlength="100">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.travel_date') }}
                                                        </label>
                                                        <input type="date" class="form-control"
                                                            placeholder="Search date" wire:model='search_travel_date'
                                                            wire:change="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.passenger_name') }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Passenger Name" wire:model='search_name'
                                                            wire:keyup="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.service_type') }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Service Type" wire:model='search_service_type'
                                                            wire:keyup="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item mb-2">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.package_name') }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package Name" wire:model='search_package_name'
                                                            wire:keyup="filterBookings">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comman-space pb-0">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                {{-- <thead>
                                                    <tr>
                                                        <th>{{ __('tablevars.#') }}</th>
                                                        <th>{{ __('tablevars.request') }} {{ __('tablevars.id') }}
                                                        </th>
                                                        <th>{{ __('tablevars.raised') }} {{ __('tablevars.date') }}
                                                        </th>
                                                        <th>{{ __('tablevars.service') }} {{ __('tablevars.type') }}
                                                        </th>
                                                        <th>{{ __('tablevars.package') }}</th>
                                                        <th>{{ __('tablevars.package') }} {{ __('tablevars.type') }}
                                                        </th>
                                                        <th>{{ __('tablevars.total_cost') }} (₹)</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead> --}}
                                                <tbody>
                                                    @forelse ($quotes as $key => $quote)
                                                        <tr>
                                                            <td style="width: 20%;">
                                                                <span
                                                                    class="text-secondary"><b>{{ Helper::appDateFormat($quote->travel_date) }}</b></span></br>
                                                                <span
                                                                    class="text-info"><b>{{ ucfirst($quote->mehram_name) }}</b></span></br>
                                                                <span><b>{{ $quote->package != null ? $quote->package->name : '-' }}</b></span></br>
                                                                <span>{{ $quote->packagetype != null ? $quote->packagetype->package_type : '' }}</span>
                                                            </td>

                                                            <td style="width: 20%;">
                                                                <b>

                                                                    <span class="text-success">{{ $quote->adult }}
                                                                        Adult ,</span>
                                                                    <span
                                                                        class="text-success">{{ $quote->child_bed + $quote->child }}
                                                                        Child ,</span></br>
                                                                    <span class="text-success">{{ $quote->infant }}
                                                                        Infant</span></br></br>
                                                                    @if ($quote->service_type == 1)
                                                                        <span class="web-badge badge-purple">
                                                                        @else
                                                                            <span class="web-badge badge-warning">
                                                                    @endif
                                                                    {{ $quote->servicetype != null ? $quote->servicetype->name : '-' }}</span></br></br>
                                                                    @if ($quote->service_type == 2)
                                                                        @if ($quote->package->umrah_type == 1)
                                                                            <span
                                                                                class="web-badge badge-info">FixedGroup
                                                                                Package</span></br>
                                                                        @else
                                                                            <span class="web-badge badge-info">Land
                                                                                Package</span></br>
                                                                        @endif
                                                                    @endif
                                                                    </span>
                                                            </td>
                                                            <td style="width: 20%;">
                                                                <span><b>Request Id:</b></span>
                                                                <span>{{ $quote->request_id }}</span></br>
                                                                <span><b>Raised On: </b></span>
                                                                <span>{{ Helper::appDateFormat($quote->created_at) }}</span>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <span><b>Total Cost: </b></span></br>
                                                                <span>{{ Aihut::get('currency') }}
                                                                    {{ number_format($quote->tot_cost, 2) }}</span>
                                                            </td>
                                                            <td style="width: 25%;">
                                                                @if ($quote->negotiation_status == '')
                                                                    <span
                                                                        class="web-badge badge-primary">Requested</span>
                                                                @elseif ($quote->negotiation_status == 0)
                                                                    <span
                                                                        class="web-badge badge-warning text-dark">Negotiations
                                                                        are in progress</span>
                                                                @elseif ($quote->negotiation_status == 1)
                                                                    <span
                                                                        class="web-badge badge-success text-dark">Negotiations
                                                                        Approved</span>
                                                                @else
                                                                    <span class="web-badge badge-danger ">Negotiations
                                                                        Rejected</span>
                                                                @endif

                                                            </td>
                                                            <td style="width: 10%;">
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
                                                                            href="javascript:void(0)"data-bs-toggle="modal"
                                                                            data-toggle="tooltip"
                                                                            data-bs-target="#requestModal"
                                                                            title="View Request Details"
                                                                            wire:click="getRequestContent({{ $quote->id }})">View
                                                                            Request Details</a>

                                                                        {{-- @if ($quote->negotiation_status == '')
                                                                            <a class="dropdown-item"
                                                                                href="javascript:void(0);"data-bs-toggle="modal"
                                                                                data-toggle="tooltip"
                                                                                data-bs-target="#negotiate_modal"
                                                                                title="Negotiate"
                                                                                wire:click="getTotCost({{ $quote->id }})">{{ __('tablevars.Negotiate') }}</a>
                                                                        @endif --}}
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('customer.quotes.details', ['quote_id' => $quote->id]) }}"
                                                                            title="Make Payment">Make Payment</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('customer.quotes.edit', ['quote_id' => $quote->id]) }}"
                                                                            title="Edit">Edit</a>
                                                                        <a href="javascript:void(0)"
                                                                            class="dropdown-item text-danger"
                                                                            wire:click="isDelete({{ $quote->id }})"
                                                                            title="Trash">{{ __('tablevars.trash') }}</a>
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
                                            {{ $quotes->links(data: ['scrollTo' => false]) }}
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
    <div wire:ignore.self class="modal fade" id="requestModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tablevars.request') }}
                        {{ __('tablevars.information') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($request_modal_data)
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>{{ __('tablevars.request') }}
                                                        {{ __('tablevars.id') }}</strong></label>
                                                <div> {{ $request_modal_data->request_id ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Service Type</strong></label>
                                                <div>{{ $request_modal_data->servicetype->name ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Departure City</strong></label>
                                                <div>{{ $request_modal_data->city->city_name ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Travel Date </strong></label>
                                                <div>
                                                    {{ $request_modal_data->travel_date ? Helper::appDateFormat($request_modal_data->travel_date) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package PNR</strong></label>
                                                <div>{{ $request_modal_data->pnr->pnr_code ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package Type</strong></label>
                                                <div>{{ $request_modal_data->packagetype->package_type ?: 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Shairing Type</strong></label>
                                                <div>{{ $request_modal_data->sharingtype->name ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package Days</strong></label>
                                                <div>{{ $request_modal_data->days ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Passenger Name</strong></label>
                                                <div>{{ $request_modal_data->mehram_name ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Adults</strong></label>
                                                <div>{{ $request_modal_data->adult ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Child With Bed</strong></label>
                                                <div>{{ $request_modal_data->child_bed ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Child Without Bed</strong></label>
                                                <div>{{ $request_modal_data->child ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Infants</strong></label>
                                                <div>{{ $request_modal_data->infant ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total PAX (Adults+Children+Infants)</strong></label>
                                                <div>
                                                    {{ $request_modal_data->adult + $request_modal_data->child + $request_modal_data->child_bed + $request_modal_data->infant ?: 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total Beds</strong></label>
                                                <div>
                                                    {{ $request_modal_data->adult + $request_modal_data->child_bed ?: 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Contact</strong></label>
                                                <div>{{ $request_modal_data->contact ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Email</strong></label>
                                                <div>{{ $request_modal_data->email_id ?: 'N/A' }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Is Paid</strong></label>
                                                <div>{{ $request_modal_data->is_paid = 1 ? 'Yes' : 'No' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total Cost</strong></label>
                                                <div>{{ number_format($request_modal_data->tot_cost, 2) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Created Date</strong></label>
                                                <div>
                                                    {{ $request_modal_data->created_at ? Helper::appDateFormat($request_modal_data->created_at) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label><strong>Cost Breakup</strong></label>
                                                <div>{!! $request_modal_data->cost_breackup ?: 'N/A' !!} </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Updated Date</strong></label>
                                                <div>
                                                    {{ $request_modal_data->updated_at ? Helper::appDateFormat($request_modal_data->updated_at) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label><strong>Special Request (If Any)</strong></label>
                                                <div>{{ $request_modal_data->special_request ?: 'N/A' }}</div>
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
    {{-- <div wire:ignore.self class="modal fade" id="negotiate_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Negotiate</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($tot_cost)
                                        <div class="form-group">
                                            <label>Quoted Fare <span class="text-danger">*</span></label>
                                            <span>{{ number_format($tot_cost, 2) }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Negotiate Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="negotiate" value="{{ $negotiate_amount }}"
                                                class="form-control" wire:model="negotiate_amount" maxlength="9"
                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" title="Update" data-bs-dismiss="modal"
                        wire:click='negotiatedAmount'>Update</button>
                    <button type="button" class="btn btn-dark" title="Close"
                        data-bs-dismiss="modal">{{ __('tablevars.close') }}</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>
