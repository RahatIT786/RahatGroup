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
                                            <h3>{{ __('tablevars.statement_report') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-3">
                                                    <label class="label-header"
                                                        for="search_agency">{{ __('tablevars.agency') }}</label>
                                                    <select class="form-control" name='search_agency' id="search_agency"
                                                        wire:model="search_agency" required>
                                                        <option value="">Agency Name</option>
                                                        @foreach ($agent as $id => $agency_name)
                                                            <option value="{{ $id }}">{!! $agency_name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('search_agency')
                                                        <span class="v-msg text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-3">
                                                    <label class="label-header" for="start_date">Start Date</label>
                                                    <input type="date" name="start_date" id="start_date"
                                                        class="form-control" placeholder="Search Booking Id"
                                                        autocomplete="off" wire:model="start_date" required>
                                                    @error('start_date')
                                                        <span class="v-msg text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <label class="label-header" for="end_date">End Date</label>
                                                    <input type="date" name="end_date" id="end_date"
                                                        class="form-control" placeholder="Search Name"
                                                        autocomplete="off" wire:model="end_date" required>
                                                    @error('end_date')
                                                        <span class="v-msg text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-3 align-self-end">
                                                    <a class="btn btn-primary" id="box" style="color: white"
                                                        wire:click="statementReportData">Search</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($is_div == 1)
                                        <div class="card" id="myDIV">

                                            <div class="card-header d-flex justify-content-between">

                                                <div class="ms-auto">

                                                    <a href="javascript:void(0);" class="btn btn-info"
                                                        style="color: white;" wire:click="download">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <h4>Statement Report for {{ $agencyData->agency_name ?? '' }}</h4>
                                                    <br>
                                                    ( {{ $start_date }} - {{ $end_date }} )
                                                </div>
                                            </div>
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>

                                                        <th>Date</th>
                                                        <th>Booking ID</th>
                                                        <th>Payment ID</th>
                                                        <th>Particulars</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total_debit = 0;
                                                        $total_credit = 0;
                                                    @endphp
                                                    @forelse ($agentBookings as $bookings)
                                                        <tr>
                                                            <td>{{ Helper::formatCarbonDate($bookings->created_at) }}
                                                            </td>
                                                            <td>{{ $bookings->booking_id }}
                                                            </td>
                                                            <td>
                                                                {{ $bookings->agency->agency_name }}
                                                                {{ $bookings->agency->city }}
                                                                {{ $bookings->agency->mobile }}
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                {{ number_format($bookings->tot_cost, 2) }}</td>
                                                            <td></td>
                                                        </tr>
                                                        @foreach ($bookings->payment as $payment)
                                                            <tr>
                                                                <td>{{ Helper::formatCarbonDate($payment->txn_date) }}
                                                                </td>
                                                                <td>{{ $bookings->booking_id }}</td>
                                                                <td>{{ $payment->receipt_id }}</td>
                                                                <td>{{ $payment->deposite_type }}</td>
                                                                <td></td>
                                                                <td>{{ number_format($payment->amount, 2) }}</td>
                                                            </tr>
                                                            @php
                                                                $total_credit += $payment->amount;
                                                            @endphp
                                                        @endforeach
                                                        @php
                                                            $total_debit += $bookings->tot_cost;
                                                        @endphp
                                                        <tr>
                                                            <td colspan="6"
                                                                style="background-color: #dee2e6: height:50%;">
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" align="center" class="text-danger"><span
                                                                    class="v-msg">No
                                                                    Records
                                                                    Found</span> </td>
                                                        </tr>
                                                    @endforelse
                                                    <tr>
                                                        <td colspan="4" align="right">Total : </td>
                                                        <td> {{ number_format($total_debit, 2) }}</td>
                                                        <td>{{ number_format($tot_cost, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td>Balance</td>
                                                        <td class="text-white" style="background-color: red; ">
                                                            {{ number_format($total_debit - $total_credit, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                </div>
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
<!-- <script>
    function myFunction() {
        document.getElementById("myDIV").style.display = "block";
    }
</script> -->
</div>
