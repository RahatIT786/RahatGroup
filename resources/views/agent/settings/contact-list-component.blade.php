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
                                        <div class="filter-grp ticket-grp d-flex justify-content-between">
                                            <h4>User Contact List</h4>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.name') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_title' placeholder="Search Name"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.email') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_title' placeholder="Search Email"
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
                                                        <th>{{ __('tablevars.name') }}</th>
                                                        <th>{{ __('tablevars.phone') }}</th>
                                                        <th>{{ __('tablevars.email') }}</th>
                                                        <th width="45%">{{ __('tablevars.message') }}</th>
                                                        <th>{{ __('tablevars.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Jyoti Verma</td>
                                                        <td>7856325463</td>
                                                        <td>jyoti@gmail.com</td>
                                                        <td>In publishing and graphic design, Lorem ipsum
                                                            is a
                                                            placeholder text commonly</td>
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
                                                        <td>biswajit</td>
                                                        <td>7526589654</td>
                                                        <td>biswa@gmail.com</td>
                                                        <td>In publishing and graphic design, Lorem ipsum is a
                                                            placeholder text commonly used to demonstrate the visual
                                                            form of a document or a typeface</td>
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
                                                        <td>3</td>
                                                        <td>kunal</td>
                                                        <td>7458963256</td>
                                                        <td>kunal@gmail.com</td>
                                                        <td>In publishing and graphic design, Lorem ipsum is a
                                                            placeholder text commonly used to demonstrate the visual
                                                            form of a document or a typeface</td>
                                                        <td>
                                                            <div class="ticket-grp mb-2 has-submenu">
                                                                <button
                                                                    class="btn btn-primary ticket-btn-grp btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
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
                                                                        data-toggle="tooltip"
                                                                        title="Edit City">Edit</a>
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
