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
        <h4>All Payments List</h4>
    </div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Software Id</th>
                    <th scope="col">Service</th>
                    <th scope="col">Dep City</th>
                    <th scope="col">Agency</th>
                    <th scope="col">Travel Date</th>
                    <th scope="col">Package Type</th>
                    <th scope="col">Name </th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($Agent_Data as $agent_data)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ Helper::appDateFormat($agent_data->created_at) }}</td>
                        <td>{{ $agent_data->booking_id ?? '-' }}</td>
                        <td>{{ $agent_data->servicetype != null ? $agent_data->servicetype->name : '-' }}</td>
                        <td>{{ $agent_data->city != null ? $agent_data->city->city_name : '-' }}</td>
                        <td>{{ $agent_data->agency != null ? $agent_data->agency->agency_name : '-' }}</td>
                        <td>{{ $agent_data->travel_date ?? '-' }}</td>
                        <td>{{ $agent_data->packagetype->package_type ?? '-' }}</td>
                        <td>{{ $agent_data->mehram_name ?? '-' }}</td>
                        <td>{{ $agent_data->tot_cost ?? '-' }}</td>
                        {{-- <td>{{ $agent_data->payment_status == 0 ? 'Pending' : 
                        ($agent_data->payment_status == 1 ? 'Approved' : 
                        ($agent_data->payment_status == 2 ? 'Unclear' : 
                        ($agent_data->payment_status == 3 ? 'Bounce' : 'Not received'))) }}</td> --}}
                    </tr>

                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
