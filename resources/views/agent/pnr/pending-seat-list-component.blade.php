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
                                            <h3>{{ __('tablevars.visa') }} {{ __('tablevars.list') }}</h3>
                                        </div>
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label>Choose {{ __('tablevars.city') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control">
                                                            <option value="">Select City</option>
                                                            <option value="2">Delhi</option>
                                                            <option value="4">Mumbai</option>
                                                            <option value="6">Lucknow</option>
                                                            <option value="7">Hyderabad</option>
                                                            <option value="8">Ahmedabad</option>
                                                            <option value="9">Jaipur</option>
                                                            <option value="10">Bangalore</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label>Choose {{ __('tablevars.month') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control">
                                                            <option value="">Select Month</option>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
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
                                                        <th>{{ __('tablevars.dept_date') }}</th>
                                                        <th>{{ __('tablevars.airlines') }}</th>
                                                        <th>{{ __('tablevars.total_seats') }}</th>
                                                        <th>{{ __('tablevars.balance_seats') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                    <tr>
                                                        <td>1</td>
                                                        <td>2024-10-19</td>
                                                        <td>SAUDI AIRLINES</td>
                                                        <td>70 SEATS</td>
                                                        <td>10 Available</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>2024-04-23</td>
                                                        <td>INDIGO</td>
                                                        <td>40 SEATS</td>
                                                        <td>FULL</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>2024-04-22</td>
                                                        <td>SAUDI AIRLINES </td>
                                                        <td>50 SEATS</td>
                                                        <td>40 Available</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>2024-04-18</td>
                                                        <td>INDIGO</td>
                                                        <td>40 SEATS</td>
                                                        <td>17 Available</td>
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

                                    <div class="comman-space pb-0">
                                        <div class="instruct-search-blk mb-0">
                                            <div class="show-filter all-select-blk">
                                                <div class="row gx-2">
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label class="form-control-label">{{ __('tablevars.mobile') }}
                                                            {{ __('tablevars.number') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='search_title' placeholder="Enter mobile Number"
                                                            wire:keyup.debounce.500ms="filterBookings">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-item">
                                                        <label>{{ __('tablevars.departure') }}
                                                            {{ __('tablevars.month') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control">
                                                            <option value="">Select Month</option>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3 align-self-end">
                                                        <a class="btn btn-primary" id="box"
                                                            style="color: white">Search</a>
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
</div>
</div>
