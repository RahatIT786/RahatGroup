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

                                            {{-- <div>
                                                <h4>{{ __('tablevars.pnr') }}</h4>
                                                <div class="badge badge-success mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.available') }}</span>
                                                </div>
                                                <div class="badge badge-warning mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.filling_fast') }}
                                                    </span>
                                                </div>
                                                <div class="badge badge-danger mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.sold_out') }}</span>
                                                </div>

                                            </div> --}}
                                            <div>
                                                <a href="javascript:void(0);" style="color: white"
                                                    class="btn btn-warning" title="Print" wire:click="downloadPnr"><i
                                                        class="fas fa-file-excel"></i> {{ __('tablevars.print') }}</a>
                                            </div>
                                        </div>

                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div>
                                                    <h5>{{ __('tablevars.search') }}</h5>
                                                    <hr />
                                                </div>
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.start_date') }}</label>
                                                        <input type="date" name="start_date" class="form-control"
                                                            wire:model='start_date' wire:change= "filterPnr">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.end_date') }}</label>
                                                        <input type="date" name="end_date" class="form-control"
                                                            wire:model='end_date' wire:change="filterPnr">
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="label-header"
                                                            for="group_name">{{ __('tablevars.group_name') }}</label>
                                                        <input type="text" name="group_name" id="group_name"
                                                            class="form-control" placeholder="Search Group Name"
                                                            wire:model='group_name' wire:keyup="filterPnr"
                                                            autocomplete="off" maxlength="60">

                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="label-header"
                                                            for="search_city">{{ __('tablevars.city') }}</label>
                                                        <input type="text" name="search_city" id="search_city"
                                                            class="form-control" placeholder="Search City Name"
                                                            autocomplete="off" wire:model='search_city'
                                                            wire:keyup="filterPnr" maxlength="11">
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
                                                        <th>{{ __('tablevars.group_name') }}</th>
                                                        <th>{{ __('tablevars.city') }}</th>
                                                        <th>{{ __('tablevars.airlines') }}</th>
                                                        <th>{{ __('tablevars.dept_date') }}</th>
                                                        <th>{{ __('tablevars.arrival_date') }}</th>
                                                        <th>{{ __('tablevars.total') }}
                                                            {{ __('tablevars.days') }}
                                                        </th>
                                                        <th>{{ __('tablevars.itinerary') }}</th>
                                                        <th>{{ __('tablevars.air_seats') }}</th>
                                                        <th>{{ __('tablevars.avail_seats') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($pnrData as $key => $RspnrData)
                                                        @php
                                                            $pax = $RspnrData->seats;
                                                            $availaable_seat = $RspnrData->avai_seats;
                                                            $seatpercent = ($availaable_seat * 100) / $pax;

                                                            $rangeLabels = [
                                                                'available' => [
                                                                    'label' => 'Available',
                                                                    'class' => 'badge-success',
                                                                ],
                                                                'filling_fast' => [
                                                                    'label' => 'Filling Fast',
                                                                    'class' => 'badge-warning',
                                                                ],
                                                                'sold_out' => [
                                                                    'label' => 'Sold Out',
                                                                    'class' => 'badge-danger',
                                                                ],
                                                            ];

                                                            if ($seatpercent < 20) {
                                                                $badgeClass = $rangeLabels['sold_out']['class'];
                                                            } elseif ($seatpercent >= 50) {
                                                                $badgeClass = $rangeLabels['available']['class'];
                                                            } else {
                                                                $badgeClass = $rangeLabels['filling_fast']['class'];
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + $pnrData->firstItem() }}</td>
                                                            <td>{{ $RspnrData->group_name }}</td>
                                                            <td>{{ $RspnrData->city->city_name ?? '-' }}</td>
                                                            <td>{{ $RspnrData->flight->flight_name }}</td>
                                                            <td>{{ Helper::appDateFormat($RspnrData->dept_date) }}</td>
                                                            <td>{{ Helper::appDateFormat($RspnrData->return_date) }}
                                                            </td>
                                                            <td>{{ $RspnrData->days }}</td>
                                                            <td><a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#itineraryModal"
                                                                    wire:click="getItinerary({{ $RspnrData->id }})"> <i
                                                                        class="fas fa-eye"></i></a></td>
                                                            <td>{{ $RspnrData->seats }}</td>
                                                            <td>
                                                                <div class="pointer badge {{ $badgeClass }}">
                                                                    {{ $availaable_seat }}
                                                                </div>
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
                                                                            data-bs-toggle="modal"
                                                                            class="dropdown-item"data-bs-target="#flightModal"
                                                                            wire:click="getModalContent({{ $RspnrData->id }})"
                                                                            data-toggle="tooltip"
                                                                            title="View Details">{{ __('tablevars.view') }}</a>
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
                                                    class="form-control" wire:change='filterPnr'>
                                                    @foreach (Helper::getPerPageOptions() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{ $pnrData->links(data: ['scrollTo' => false]) }}
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

    <!-- Modal for Itinerary -->
    <div wire:ignore.self class="modal fade" id="itineraryModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="eyeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eyeModalLabel">{{ __('tablevars.itinerary') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($itinerary_modal_data)
                                        <div class="col-md-12">
                                            <pre>{{ $itinerary_modal_data->itenary }}</pre>
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

    <!-- Flight View Modal -->
    <div wire:ignore.self class="modal fade" id="flightModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="flightModalLabel">{{ __('tablevars.package_master_information') }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div>
                            <div class="row">
                                @if ($flight_modal_data)
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.pnr_code') }}</strong></label>
                                            <div> {{ $flight_modal_data->pnr_code }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.package_name') }}</strong></label>
                                            <div>
                                                @forelse ($flight_modal_data->packages as $key => $package)
                                                    <span> {{ $package->package_name }},</span>
                                                @empty
                                                    <div colspan="9" align="center" class="text-danger"> No
                                                        Packages Found </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.group_name') }}</strong></label>
                                            <div> {{ $flight_modal_data->group_name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.flight_name') }}</strong></label>
                                            <div> {{ $flight_modal_data->flight->flight_name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.popular_flight') }}</strong></label>
                                            <div>{{ $flight_modal_data->is_popular == 1 ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.departure_city') }}</strong></label>
                                            <div>{{ $flight_modal_data->city->city_name ?? '-' }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.pnr_package_type') }}</strong></label>
                                            <div>{{ $flight_modal_data->pnr_pack_type }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.departure_sector') }}</strong></label>
                                            <div>{{ $flight_modal_data->departuresector->sector_name }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.return_sector') }}</strong></label>
                                            <div>{{ $flight_modal_data->returnsector->sector_name }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.departure_date') }}</strong></label>
                                            <div>{{ Helper::appDateFormat($flight_modal_data->dept_date) }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.return_date') }}</strong></label>
                                            <div>{{ Helper::appDateFormat($flight_modal_data->return_date) }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.departure_time') }}</strong></label>
                                            <div>{{ $flight_modal_data->dept_time }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.return_time') }}</strong></label>
                                            <div>{{ $flight_modal_data->return_time }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.no_of_days') }}</strong></label>
                                            <div>{{ $flight_modal_data->days }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.no_of_seats') }}</strong></label>
                                            <div>{{ $flight_modal_data->seats }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.available_seats') }}</strong></label>
                                            <div>{{ $flight_modal_data->avai_seats }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.package_leader') }}</strong></label>
                                            <div>{{ $flight_modal_data->tour_leader }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.supplier_name') }}</strong></label>
                                            <div>{{ $flight_modal_data->supp_name }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.transport_company_name') }}</strong></label>
                                            <div>{{ $flight_modal_data->transco_name }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.transport_company_phone') }}</strong></label>
                                            <div>{{ $flight_modal_data->mobno_tc }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.adult_price') }}</strong></label>
                                            <div>{{ number_format($flight_modal_data->adult_cost) }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.child_price') }}</strong></label>
                                            <div>{{ number_format($flight_modal_data->child_cost) }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.infant_price') }}</strong></label>
                                            <div>{{ number_format($flight_modal_data->infant_cost) }} </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label><strong>{{ __('tablevars.itinerary') }}</strong></label><br>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#itineraryModal"
                                                wire:click="getItinerary({{ $flight_modal_data->id }})"> <i
                                                    class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
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
