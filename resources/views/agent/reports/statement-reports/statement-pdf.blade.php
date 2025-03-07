<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statement Report</title>
    <style>
        @font-face {
            font-family: 'Nunito';
            src: url('{{ asset('path/to/fonts/Nunito-Regular.woff2') }}') format('woff2'),
                url('{{ asset('path/to/fonts/Nunito-Regular.woff') }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Nunito';
            src: url('{{ asset('path/to/fonts/Nunito-Bold.woff2') }}') format('woff2'),
                url('{{ asset('path/to/fonts/Nunito-Bold.woff') }}') format('woff');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 0.8em;
            /* Reduced by 50% */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Nunito', sans-serif;
            font-size: 0.8em;
            /* Reduced by 50% */
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .bg-red {
            background-color: red;
            color: white;
        }

        .bg-gray {
            background-color: #ffffff;
            height: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-white {
            color: white;
        }

        /* Set the font size for tbody elements */
        tbody {
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <div class="card" id="myDIV">
        <div class="text-center">
            <h4>Statement Report for {{ $agency->agency_name ?? '' }}</h4><br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
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
                                <td>{{ \Helper::formatCarbonDate($bookings->created_at) }}</td>
                                <td>{{ $bookings->booking_id }}</td>
                                <td>
                                    {{ $bookings->agency->agency_name }}<br>
                                    {{ $bookings->agency->city }}<br>
                                    {{ $bookings->agency->mobile }}
                                </td>
                                <td></td>
                                <td>{{ number_format($bookings->tot_cost, 2) }}</td>
                                <td></td>
                            </tr>
                            @foreach ($bookings->payment as $payment)
                                <tr>
                                    <td>{{ \Helper::formatCarbonDate($payment->txn_date) }}</td>
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
                                <td colspan="6" class="bg-gray"></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center"><span>No Records Found</span></td>
                            </tr>
                        @endforelse

                        <tr>
                            <td colspan="4"></td>
                            <td>Total Debit</td>
                            <td>{{ number_format($total_debit, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td>Total Credit</td>
                            <td>{{ number_format($total_credit, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td>Balance</td>
                            <td class="bg-red">{{ number_format($total_debit - $total_credit, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
