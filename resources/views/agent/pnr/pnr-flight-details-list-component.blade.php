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

                                            <div>
                                                <h4>{{ __('tablevars.pnr') }}</h4>
                                                <div class="badge badge-success mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.available') }}</span>
                                                </div>
                                                <div class="badge badge-warning mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.filling') }}
                                                    </span>
                                                </div>
                                                <div class="badge badge-danger mr-2"><span
                                                        class="text-bold text-dark">{{ __('tablevars.sold_out') }}</span>
                                                </div>

                                            </div>
                                            <div>
                                                <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}"
                                                    style="color: white" class="btn btn-warning"><i
                                                        class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.start_date') }}</label>
                                                        <input type="date" class="form-control"
                                                            wire:model='search_title'
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.end_date') }}</label>
                                                        <input type="date" class="form-control"
                                                            wire:model='search_location'
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
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.group_name') }}</th>
                                                        <th>{{ __('tablevars.city') }}</th>
                                                        <th>{{ __('tablevars.airlines') }}</th>
                                                        <th>{{ __('tablevars.dept_date') }}</th>
                                                        <th>{{ __('tablevars.arrival_date') }}</th>
                                                        <th>{{ __('tablevars.total') }} {{ __('tablevars.days') }}
                                                        </th>
                                                        <th>{{ __('tablevars.itinerary') }}</th>
                                                        <th>{{ __('tablevars.air_seats') }}</th>
                                                        <th>{{ __('tablevars.avail_seats') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                    <tr>
                                                        <td>1</td>
                                                        <td>DEL 15APR-6E-40SEATS-20DAYS -SHAWWAL </td>
                                                        <td>Delhi</td>
                                                        <td>INDIGO</td>
                                                        <td>15-04-2024</td>
                                                        <td>05-05-2024</td>
                                                        <td>20</td>
                                                        <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                                        <td>40</td>
                                                        <td>
                                                            <div class="pointer badge badge-success"><span
                                                                    class="text-bold text-dark">50</span></div>
                                                        </td>
                                                        <td>
                                                            <div class="ticket-grp mb-2 has-submenu">
                                                                <button
                                                                    class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="fas fa-cog" data-toggle="tooltip"
                                                                        title="Options"></i></button>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                    style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        class="dropdown-item"
                                                                        data-bs-target="#viewModal"
                                                                        data-toggle="tooltip" title="View">View</a>

                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-bs-toggle="modaltwo"
                                                                        data-bs-target="#editModal"
                                                                        data-toggle="tooltip" title="Edit City">Edit</a>
                                                                    <a class="dropdown-item" href="#">Trash</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>LKO-03APR-SV-40SEATS-21DAYS RAMZAAN SHAWWAL</td>
                                                        <td>Lucknow</td>
                                                        <td>SAUDI AIRLINES </td>
                                                        <td>15-04-2024</td>
                                                        <td>05-05-2024</td>
                                                        <td>21</td>
                                                        <td><a href="#"> <i class="fas fa-eye"></i></a></td>
                                                        <td>40</td>
                                                        <td>
                                                            <div class="pointer badge badge-warning"><span
                                                                    class="text-bold text-dark">10</span></div>
                                                        </td>
                                                        <td>
                                                            <div class="ticket-grp mb-2 has-submenu">
                                                                <button
                                                                    class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"><i
                                                                        class="fas fa-cog" data-toggle="tooltip"
                                                                        title="Options"></i></button>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                    style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        class="dropdown-item"
                                                                        data-bs-target="#viewModal"
                                                                        data-toggle="tooltip" title="View">View</a>

                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-bs-toggle="modaltwo"
                                                                        data-bs-target="#editModal"
                                                                        data-toggle="tooltip" title="Edit City">Edit</a>
                                                                    <a class="dropdown-item" href="#">Trash</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
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
                                                    {{-- @foreach (Helper::getPerPageOptions() as $item) --}}
                                                    <option value="">5</option>
                                                    {{-- <option value="{{ $item }}">{{ $item }}</option> --}}
                                                    {{-- @endforeach --}}
                                                </select>
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
</div>
