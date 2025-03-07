<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.statement_report') }}</h1>
            <div class="section-header-button">

            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.statement_report') }}
                    {{ __('tablevars.managment') }}
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.statementReport.index') }}"
                        wire:navigate>{{ __('tablevars.statement_report') }}</a></div>
                <div class="breadcrumb-item">All Statement Report</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label class="label-header" for="search_agency">{{ __('tablevars.agency') }}</label>
                                    <select class="form-control" name='search_agency' id="search_agency"
                                        wire:model="search_agency" required>
                                        <option value="">Agency Name</option>
                                        @foreach ($agent as $id => $agency_name)
                                            <option value="{{ $id }}">{!! $agency_name !!}</option>
                                        @endforeach
                                    </select>
                                    @error('search_agency')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        placeholder="Search Booking Id" autocomplete="off" wire:model="start_date"
                                        required>
                                    @error('start_date')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label class="label-header" for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        placeholder="Search Name" autocomplete="off" wire:model="end_date" required>
                                    @error('end_date')
                                        <span class="v-msg">{{ $message }}</span>
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
                                <h4>Statement Report List</h4>
                                <div>
                                    {{-- <a href="{{ asset('/storage/sample_pdf/Agents-Accounts-Detail.xls') }}"
                                        style="color: white" class="btn btn-info"><i class="fas fa-file-excel"></i>
                                        Export
                                        to excel</a> --}}
                                    <a href="javascript:void(0);" class="btn btn-info" style="color: white;"
                                        wire:click="download">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                </div>
                            </div>
                            <div class="text-center">
                                <h4>Statement Report for {{ $agencyData->agency_name ?? '' }}</h4><br>
                                ( {{ $start_date }} - {{ $end_date }} )
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
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
                                                        {{ $bookings->agency->city }} {{ $bookings->agency->mobile }}
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        {{ number_format($bookings->tot_cost, 2) }}</td>
                                                    <td></td>
                                                </tr>
                                                @foreach ($bookings->payment as $payment)
                                                    <tr>
                                                        <td>{{ Helper::formatCarbonDate($payment->txn_date) }} </td>
                                                        <td>{{ $bookings->booking_id }}</td>
                                                        <td>{{ $payment->receipt_id }}</td>
                                                        <td>{{ $payment->deposite_type }}</td>
                                                        <td></td>
                                                        <td>{{ number_format($payment->amount , 2) }}  {{ $bookings->full_payment_discount > 0 ? "+". $bookings->full_payment_discount .' (full payment discount)' : ''}} </td>
                                                    </tr>
                                                    @php
                                                        $total_credit += $payment->amount + $bookings->full_payment_discount;
                                                    @endphp
                                                @endforeach
                                                @php
                                                    $total_debit += $bookings->tot_cost;
                                                @endphp
                                                <tr>
                                                    <td colspan="6" style="background-color: #dee2e6: height:50%;">
                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center"><span class="v-msg">No
                                                            Records
                                                            Found</span> </td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td colspan="4"></td>
                                                <td>Balance</td>
                                                <td class="text-white" style="background-color: red; ">
                                                    {{ number_format($total_debit - $total_credit, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="d-flex flex-row justify-content-between align-items-center table-pagination">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="font-weight-bold mr-3 flex-shrink-0">{{ __('tablevars.per_page') }}</span>
                                    <select name="per_page" id="per_page" class="form-control">
                                        @foreach (\App\Helpers\Helper::getPerPageOptions() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
