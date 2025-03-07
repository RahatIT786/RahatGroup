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
        font-size: 12px; /* Adjusted font size */
    }

    table th, table td {
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
        <h4>All Payments List</h4>
    </div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Agency Name</th>
                    <th scope="col">Receipt ID</th>
                    <th scope="col">Deposite Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Company</th>
                    <th scope="col">TXN Date</th>
                    <th scope="col">Bank Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($Payment_Data as $payment_data)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $payment_data->booking->booking_id}}</td>
                    <td>{{ $payment_data->booking->agency->agency_name ?? '-' }}</td>
                    <td>{{ $payment_data->receipt_id }}</td>
                    <td>{{ $payment_data->deposite_type }}</td>
                    <td>{{ $payment_data->amount }}</td>
                    <td>{{ $payment_data->company }}</td>
                    <td>{{ Helper::appDateFormat($payment_data->txn_date) }}</td>
                    <td>{{ $payment_data->bank_name }}</td>
                    <td>{{ $payment_data->payment_status == 0 ? 'Pending' :
                        ($payment_data->payment_status == 1 ? 'Approved' :
                        ($payment_data->payment_status == 2 ? 'Unclear' :
                        ($payment_data->payment_status == 3 ? 'Bounce' : 'Not received'))) }}</td>
                </tr>

                @php
                $i ++ ;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
