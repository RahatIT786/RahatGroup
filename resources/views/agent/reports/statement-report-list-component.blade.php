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
                                            <h3>{{ __('tablevars.statement_report') }}</h3>
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
                                                    <div class="col-3 align-self-end">
                                                        <a class="btn btn-primary" id="box" style="color: white"
                                                            onclick="myFunction()">Search</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comman-space pb-0" id="myDIV" style="display: none;">
                                        <div class="settings-referral-blk course-instruct-blk table-responsive">
                                            <div>
                                                <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                                    style="color: white" class="btn btn-info"><i
                                                        class="fas fa-file-excel"></i> Export
                                                    into excel</a>
                                            </div>
                                            <div class="text-center">
                                                <h4>Statement Report for (Agent ID: )</h4><br>
                                                ( 03 Apr 2024 - 03 Apr 2024 )
                                            </div><br>
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="4%">SL#</th>
                                                        <th>{{ __('tablevars.date') }}</th>
                                                        <th>{{ __('tablevars.booking_id') }}</th>
                                                        <th>{{ __('tablevars.payment_id') }}</th>
                                                        <th>{{ __('tablevars.particulars') }}</th>
                                                        <th>{{ __('tablevars.debit') }}</th>
                                                        <th>{{ __('tablevars.credit') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @forelse ($bookings as $key => $booking) --}}
                                                    <tr>
                                                        <td>1</td>
                                                        <td>12-02-2024</td>
                                                        <td>15725</td>
                                                        <td>DNM2345N</td>
                                                        <td></td>
                                                        <td>800.00</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total : </td>
                                                        <td>800.00</td>
                                                        <td>0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total Balance :</td>
                                                        <td style="background-color: red; color: white">800.00</td>
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
<script>
    function myFunction() {
        document.getElementById("myDIV").style.display = "block";
    }
</script>
</div>
