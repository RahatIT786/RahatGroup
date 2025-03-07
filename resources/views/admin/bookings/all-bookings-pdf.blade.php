<style>
    @font-face {
        font-family: 'Nunito';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Nunito-Regular.ttf') }}') format('truetype');
    }

    body {
        font-family: 'Nunito', sans-serif;
    }

    .card {

        background-color: #fff;
        font-family: 'Nunito', sans-serif;
    }

    .card-header {
        text-align: center;
    }

    .card-body {
        padding: 16px;
    }

    .section-title {
        margin-top: 0;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Nunito', sans-serif;
        font-size: 12px;
        /* Adjusted font size */
    }

    table th,
    table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table th {
        background-color: #f9f9f9;
    }
</style>

<div class="card">
    <div class="card-header">
        <h4>All Booking List</h4>
    </div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pax</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Travel Date</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @if (!empty($Booking_Data) && $Booking_Data->count())
                    @foreach ($Booking_Data as $booking_data)
                        @php
                            $totalPaymentAmount = $booking_data->payment
                                ->where('is_paid', 1)
                                ->where('payment_status', 1)
                                ->sum('amount');
                        @endphp
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $booking_data->booking_id }}</td>
                            <td>{{ $booking_data->mehram_name ?? '-' }}</td>
                            <td>{{ $booking_data->adult + $booking_data->child_bed + $booking_data->child + $booking_data->infant }}
                            </td>
                            <td>{{ $booking_data->agency != null ? $booking_data->agency->agency_name : '-' }}</td>
                            <td>{{ $booking_data->travel_date != null ? Helper::appDateFormat($booking_data->travel_date) : 'N/A' }}
                            </td>
                            <td>{{ number_format($booking_data->tot_cost) }}</td>
                            <td>{{ number_format($booking_data->tot_cost - $totalPaymentAmount) }}</td>
                            <td>{{ $booking_data->booking_status == 0
                                ? 'Pending'
                                : ($booking_data->booking_status == 1
                                    ? 'Approved'
                                    : ($booking_data->booking_status == 2
                                        ? 'Rejected'
                                        : ($booking_data->booking_status == 3
                                            ? 'Cancelled'
                                            : ($booking_data->booking_status == 4
                                                ? 'Suspended'
                                                : ($booking_data->booking_status == 5
                                                    ? 'Under Review'
                                                    : ($booking_data->booking_status == 6
                                                        ? 'Deleted'
                                                        : ($booking_data->booking_status == 7
                                                            ? 'Waiting List'
                                                            : 'Not received'))))))) }}
                            </td>
                        </tr>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center;">No cancelled bookings found.</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
