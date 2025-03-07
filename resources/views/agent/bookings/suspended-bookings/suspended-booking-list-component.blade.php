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
                                            <h3>{{ __('tablevars.suspended_booking_list') }}</h3>
                                            <div>
                                                <a href="javascript:void(0);" class="btn btn-info" style="color: white;"
                                                    wire:click="exportToExcel" title="Export">
                                                    <i class="fas fa-file-excel"></i> Export
                                                    into excel
                                                </a>
                                                <a href="javascript:void(0);" style="color: white"
                                                    class="btn btn-warning" wire:click="downloadBooking"
                                                    title="Print"><i class="fas fa-file-excel"></i>
                                                    {{ __('tablevars.print') }}</a>
                                                <div wire:loading>Loading...</div>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Booking Id</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Search Booking Id"
                                                            wire:model='search_booking_id'
                                                            wire:keyup.debounce.500ms="filterBookings"
                                                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search Name" wire:model='search_name'
                                                            wire:keyup.debounce.500ms="filterBookings">
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
                                                        <th>{{ __('tablevars.service_type') }}</th>
                                                        <th>{{ __('tablevars.name') }}</th>
                                                        <th>{{ __('tablevars.travel_date') }}</th>
                                                        <th>{{ __('tablevars.pax') }}</th>
                                                        <th>{{ __('tablevars.total_cost') }}</th>
                                                        <th>{{ __('tablevars.balance') }}</th>
                                                        <th>{{ __('tablevars.status') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($suspendedbookings as $key => $suspendedbooking)
                                                        @php
                                                            $payments = $suspendedbooking->payment;
                                                            $TotalPayment = 0;
                                                            foreach ($payments as $payment) {
                                                                $TotalPayment += $payment->amount;
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + $suspendedbookings->firstItem() }}</td>
                                                            <td>{{ $suspendedbooking->booking_id }}</td>
                                                            <td>{{ $suspendedbooking->servicetype->name }}</td>
                                                            <td>{{ $suspendedbooking->mehram_name }}</td>
                                                            <td>{{ $suspendedbooking->travel_date ? Helper::appDateFormat($suspendedbooking->travel_date) : 'N/A' }}
                                                            </td>
                                                            <td>{{ $suspendedbooking->adult }}</td>
                                                            <td>{{ number_format($suspendedbooking->tot_cost) }}</td>
                                                            <td>{{ number_format($suspendedbooking->tot_cost - $TotalPayment) }}
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $statusLabels = [
                                                                        4 => [
                                                                            'label' => 'Suspended',
                                                                            'class' => 'badge-info',
                                                                        ],
                                                                    ];
                                                                @endphp
                                                                @if (array_key_exists($suspendedbooking->booking_status, $statusLabels))
                                                                    <div
                                                                        class="pointer badge {{ $statusLabels[$suspendedbooking->booking_status]['class'] }}">
                                                                        {{ $statusLabels[$suspendedbooking->booking_status]['label'] }}
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
                                                                            data-bs-target="#bookingModal"
                                                                            data-toggle="tooltip" title="View"
                                                                            wire:click="getBookingContent({{ $suspendedbooking->id }})">View</a>
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
                                            {{ $suspendedbookings->links(data: ['scrollTo' => false]) }}
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Booking Id</strong></label>
                                                <div> {{ $booking_modal_data->booking_id ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Service Type</strong></label>
                                                <div>{{ $booking_modal_data->servicetype->name ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Agency Name</strong></label>
                                                <div>
                                                    {{ $booking_modal_data->agency ? $booking_modal_data->agency->agency_name : '' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Departure City</strong></label>
                                                <div>{{ $booking_modal_data->city->city_name ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Travel Date </strong></label>
                                                <div>
                                                    {{ $booking_modal_data->travel_date ? Helper::appDateFormat($booking_modal_data->travel_date) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package PNR</strong></label>
                                                <div>{{ $booking_modal_data->pnr->pnr_code ?? '---' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package Type</strong></label>
                                                <div>{{ $booking_modal_data->package_type ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Shairing Type</strong></label>
                                                <div>{{ $booking_modal_data->shairing_type ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Package Days</strong></label>
                                                <div>{{ $booking_modal_data->days ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Passenger Name</strong></label>
                                                <div>{{ $booking_modal_data->mehram_name ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Adults</strong></label>
                                                <div>{{ $booking_modal_data->adult ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Child With Bed</strong></label>
                                                <div>{{ $booking_modal_data->child_bed ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Child Without Bed</strong></label>
                                                <div>{{ $booking_modal_data->child ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Number of Infants</strong></label>
                                                <div>{{ $booking_modal_data->infant ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total PAX (Adults+Children+Infants)</strong></label>
                                                <div>
                                                    {{ $booking_modal_data->adult + $booking_modal_data->child + $booking_modal_data->child_bed + $booking_modal_data->infant ?: 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total Beds</strong></label>
                                                <div>
                                                    {{ $booking_modal_data->adult + $booking_modal_data->child_bed ?: 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Contact</strong></label>
                                                <div>{{ $booking_modal_data->contact ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Email</strong></label>
                                                <div>{{ $booking_modal_data->email_id ?: 'N/A' }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Is Paid</strong></label>
                                                <div>{{ $booking_modal_data->is_paid = 1 ? 'Yes' : 'No' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Total Cost</strong></label>
                                                <div>{{ number_format($booking_modal_data->tot_cost) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Cost Breakup</strong></label>
                                                <div>{{ $booking_modal_data->cost_breackup ?: 'N/A' }} </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label><strong>Created Date</strong></label>
                                                <div>
                                                    {{ $booking_modal_data->created_at ? Helper::appDateFormat($booking_modal_data->created_at) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                                <div>{{ $booking_modal_data->special_request ?: 'N/A' }}</div>
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
</div>
