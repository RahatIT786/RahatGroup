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
                                            <h3>Deleted Bookings List</h3>
                                            {{-- <div class="ticket-btn-grp">
                                                <a href="{{ route('agent.booking.create') }}">New Bookings</a>
                                            </div> --}}
                                            <div>
                                                {{-- <div class="ticket-btn-grp">
                                                    <a href="{{ route('agent.booking.create') }}">New Bookings</a>
                                                </div> --}}
                                                {{-- <a class="btn btn-primary" href="{{ route('agent.booking.create') }}" class="ticket-btn-grp">New Bookings</a> --}}
                                                <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                                    style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i> Export
                                                    into excel</a>
                                                <a href="{{ asset('/storage/sample_pdf/my-pdf-voucher.pdf') }}" style="color: white"
                                                    class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Booking Id</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search Booking Id"
                                                            wire:model='search_location'
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Name"
                                                            wire:model='search_name'
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    {{-- <div class="col-md-2 col-lg-2 col-item">
                                                        <label for="status" class="form-control-label">Status</label>
                                                        <select class="form-select" name="sellist1"
                                                            wire:model='search_status' wire:state="search_status"
                                                            wire:change="filterBookings">
                                                            <option value="">All</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div> --}}
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
                                                        <th>Booking Id</th>
                                                        <th class="no-wrap">Service Type</th>
                                                        <th>Name</th>
                                                        <th>Total Cost</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                        <tr>
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td>1</td>
                                                            <td>1000</td>
                                                            <td class="no-wrap">
                                                                Umrah
                                                            </td>
                                                            <td>ABDUL RAZZAK</td>
                                                            <td>582,000.00</td>
                                                            <td>
                                                                {{-- @if ($booking->is_active) --}}
                                                                    <span class="badge badge-danger info-low">Deleted</span>
                                                                {{-- @else --}}
                                                                    {{-- <span class="badge badge-danger info-high">Inactive</span> --}}
                                                                {{-- @endif --}}
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
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td>2</td>
                                                            <td>1000</td>
                                                            <td class="no-wrap">
                                                                Umrah
                                                            </td>
                                                            <td>ABDUL RAZZAK</td>
                                                            <td>582,000.00</td>
                                                            <td>
                                                                {{-- @if ($booking->is_active) --}}
                                                                    {{-- <span class="badge badge-danger info-low">Active</span> --}}
                                                                {{-- @else --}}
                                                                    <span class="badge badge-danger info-low">Deleted</span>
                                                                {{-- @endif --}}
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
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td>3</td>
                                                            <td>1000</td>
                                                            <td class="no-wrap">
                                                                Umrah
                                                            </td>
                                                            <td>ABDUL RAZZAK</td>
                                                            <td>582,000.00</td>
                                                            <td>
                                                                {{-- @if ($booking->is_active) --}}
                                                                    {{-- <span class="badge badge-danger info-low">Active</span> --}}
                                                                {{-- @else --}}
                                                                    <span class="badge badge-danger info-low">Deleted</span>
                                                                {{-- @endif --}}
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
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td>4</td>
                                                            <td>1000</td>
                                                            <td class="no-wrap">
                                                                Umrah
                                                            </td>
                                                            <td>ABDUL RAZZAK</td>
                                                            <td>582,000.00</td>
                                                            <td>
                                                                {{-- @if ($booking->is_active) --}}
                                                                    <span class="badge badge-danger info-low">Deleted</span>
                                                                {{-- @else --}}
                                                                    {{-- <span class="badge badge-danger info-high">Inactive</span> --}}
                                                                {{-- @endif --}}
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
                                                            {{-- <td>{{ $key + $bookings->firstItem() }}</td> --}}
                                                            <td>5</td>
                                                            <td>1000</td>
                                                            <td class="no-wrap">
                                                                Umrah
                                                            </td>
                                                            <td>ABDUL RAZZAK</td>
                                                            <td>582,000.00</td>
                                                            <td>
                                                                {{-- @if ($booking->is_active) --}}
                                                                    <span class="badge badge-danger info-low">Deleted</span>
                                                                {{-- @else --}}
                                                                    {{-- <span class="badge badge-danger info-high">Inactive</span> --}}
                                                                {{-- @endif --}}
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
                                                    {{-- @empty --}}
                                                        {{-- <tr>
                                                            <td colspan="7" align="center">No Records Found...</td>
                                                        </tr> --}}
                                                    {{-- @endforelse --}}
                                                    {{-- <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1051</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$1200</td>
                                                        <td>Mastercard</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#2061</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-medium">Pending</span></td>
                                                        <td>$1100</td>
                                                        <td>Visa</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1021</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-high">Cancel</span></td>
                                                        <td>$1200</td>
                                                        <td>Visa</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1051</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$1500</td>
                                                        <td>Mastercard</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1061</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$2200</td>
                                                        <td>Visa</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#2061</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$3200</td>
                                                        <td>Mastercard</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1161</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$1400</td>
                                                        <td>Visa</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#3061</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-low">Paid</span></td>
                                                        <td>$1300</td>
                                                        <td>Mastercard</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check instruct-check-list">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="option1" />
                                                            </div>
                                                        </td>
                                                        <td><a href="view-invoice.html">#1061</a></td>
                                                        <td>10-05-20</td>
                                                        <td><span class="badge badge-danger info-high">Cancel</span></td>
                                                        <td>$1200</td>
                                                        <td>Mastercard</td>
                                                        <td>
                                                            <a href="javascript:void(0);"><i
                                                                    class="feather-more-vertical"></i></a>
                                                        </td>
                                                    </tr> --}}
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
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- {{ $bookings->links(data: ['scrollTo' => false]) }} --}}
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
