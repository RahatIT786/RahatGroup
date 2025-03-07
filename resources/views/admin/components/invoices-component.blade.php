<div class="card">
    <div class="card-header">
        <h4>Invoices</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.invoices.index') }}" target="_blank" class="btn btn-danger">View More <i
                    class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive table-invoice">
            <table class="table table-striped">
                <tr>
                    {{-- <th>Booking ID</th>
                    <th>Date</th>
                    <th>Mehram</th>
                    <th>PAX</th>
                    <th>Total</th>
                    <th>Action</th> --}}
                    {{-- <th>{{ __('tablevars.#') }}</th> --}}
                    <th>{{ __('tablevars.booking_id') }}</th>
                    <th>{{ __('tablevars.service') }}</th>
                    <th>{{ __('tablevars.agency') }}</th>
                    <th>{{ __('tablevars.meheram_name') }}</th>
                    {{-- <th>{{ __('tablevars.travel_date') }}</th> --}}
                    <th>{{ __('tablevars.pax') }}</th>
                    <th>{{ __('tablevars.total_price') }}</th>
                    <th>{{ __('tablevars.action') }}</th>
                </tr>
                @forelse ($invoices as $key=>$invoice)
                    {{-- <tr>
                        <td>BK652301</td>
                        <td>20-07-2022</td>
                        <td>Yusuf Ali</td>
                        <td>2</td>
                        <td>₹ 72,000.00</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr> --}}
                    <tr>
                        {{-- <td>{{ $key + 1 }}</td> --}}
                        <td>{{ $invoice->booking_id }}</td>
                        <td>{{ $invoice->servicetype->name ?? '---' }}</td>
                        <td>{{ $invoice->agency ? $invoice->agency->agency_name : '' }}</td>
                        <td>{{ $invoice->mehram_name }}</td>
                        {{-- <td>
                            @if ($invoice->service_type == '1' || $invoice->service_type == '7' || $invoice->service_type == '9' || $invoice->service_type == '4' || $invoice->service_type == '5' || $invoice->service_type == '3' || $invoice->service_type == '14' || $invoice->service_type == '15' || $invoice->service_type == '16' || $invoice->service_type == '17' || $invoice->service_type == '18' || $invoice->service_type == '19')
                                {{ $invoice->travel_date ? Helper::formatCarbonDate($invoice->travel_date) : '' }}
                            @endif
                            @if ($invoice->service_type == '13')
                                {{ $invoice->checkin_date ? Helper::formatCarbonDate($invoice->checkin_date) : '' }}
                            @endif
                            @if ($invoice->service_type == '12')
                                {{ $invoice->visa_date ? Helper::formatCarbonDate($invoice->visa_date) : '' }}
                            @endif
                        </td> --}}
                        <td>
                            {{ $invoice->adult + $invoice->child + $invoice->child_bed + $invoice->infant }}
                        </td>
                        <td>
                            {{ number_format($invoice->tot_cost) }}
                        </td>
                        <td>
                            <a href="{{ route('admin.downloadInvoice', $invoice->id) }}" class="btn btn-primary"><i
                                    class="fas fa-download"></i>&nbsp; Invoice</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No invoices found.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
