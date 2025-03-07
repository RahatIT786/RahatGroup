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
                                                <h4>Package Master Listing</h4>
                                            </div>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.package') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_title' placeholder="Search Package"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label
                                                            class="form-control-label">{{ __('tablevars.group_name') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_location' placeholder="Search Group Name"
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
                                                        <th width="4%">{{ __('tablevars.package') }}</th>
                                                        <th>{{ __('tablevars.group_name') }}</th>
                                                        <th>{{ __('tablevars.dept_date') }}</th>
                                                        <th>{{ __('tablevars.quint_price') }}</th>
                                                        <th>{{ __('tablevars.quad_price') }}</th>
                                                        <th>{{ __('tablevars.triple_price') }}</th>
                                                        <th>{{ __('tablevars.double_price') }}</th>
                                                        <th>{{ __('tablevars.child_bed_price') }}</th>
                                                        <th>{{ __('tablevars.child_price') }}</th>
                                                        <th>{{ __('tablevars.infant_price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                    <tr>
                                                        <td>1</td>
                                                        <td>15 Days  Gold</td>
                                                        <td>LKO-28OCT-SV-35SEATS-16DAYS</td>
                                                        <td>28-10-2023</td>
                                                        <td>320862.50</td>
                                                        <td>320862.50</td>
                                                        <td>320862.50</td>
                                                        <td>320862.50</td>
                                                        <td>320862.50</td>
                                                        <td>320862.50</td>
                                                        <td>0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>15 Days  Esteem</td>
                                                        <td>LKO-28OCT-SV-35SEATS-16DAYS</td>
                                                        <td>28-10-2023</td>
                                                        <td>319550.00</td>
                                                        <td>319550.00</td>
                                                        <td>319550.00</td>
                                                        <td>319550.00</td>
                                                        <td>319550.00</td>
                                                        <td>319550.00</td>
                                                        <td>0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>15 Days  Silver</td>
                                                        <td>HYD-20NOV-6E-40SEATS-15DAYS-</td>
                                                        <td>28-10-2023</td>
                                                        <td>310652.50</td>
                                                        <td>310652.50</td>
                                                        <td>310652.50</td>
                                                        <td>310652.50</td>
                                                        <td>310652.50</td>
                                                        <td>310652.50</td>
                                                        <td>0.00</td>
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
