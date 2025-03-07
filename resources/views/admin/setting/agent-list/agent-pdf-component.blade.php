<!doctype html>
<html lang="en-us">

<head>
    <meta charset="UTF-8" />
    <title>Agent Listing</title>
    <meta name="description" content="">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #4c606a;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h5 {
            text-align: center;
            margin: 10px 0;
            font-size: 18px;
            font-weight: 500;
            line-height: 1.2;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            border: 1px solid #b8cbd4;
        }

        th {
            background-color: #f5f7f8;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .paid {
            color: #28a745;
            font-weight: bold;
        }

        .unpaid {
            color: #dc3545;
            font-weight: bold;
        }

        .no-data {
            color: red;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <h5>Agent List</h5>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Agency</th>
                <th>Name</th>
                <th>City</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Is Paid ?</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($agentData as $agent)
                @php
                    $i++;
                    $paid_status = $agent->is_paid == '0' ? 'unpaid' : 'paid';
                @endphp
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $agent->id }}</td>
                    <td>{{ $agent->agency_name }}</td>
                    <td>{{ $agent->owner_name }}</td>
                    <td>{{ $agent->city }}</td>
                    <td>{{ $agent->mobile }}</td>
                    <td>{{ $agent->email }}</td>
                    <td class="{{ $paid_status }}">
                        {{ $paid_status == 'paid' ? 'Paid' : 'Unpaid' }}
                    </td>
                </tr>
            @endforeach

            @if ($agentData->isEmpty())
                <tr>
                    <td colspan="8" class="no-data">No List Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
