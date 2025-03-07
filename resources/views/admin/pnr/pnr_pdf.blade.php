<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td{
            font-size: small;
            padding: 8px;
        }
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h2>PNR List</h2>
    <table>
        <tr>
            <th>Group Name</th>
            <th>City</th>
            <th>Airlines</th>
            <th>Dept Date</th>
            <th>Seats</th>
            <th>Available Seats</th>
        </tr>
        @foreach ($pnrData as $pnr)
            <tr>
                <td>{{ $pnr->group_name ?? '-' }}</td>
                <td>{{ $pnr->city->city_name ?? '-' }}</td>
                <td>{{ $pnr->flight->flight_name ?? '-' }}</td>
                <td>{{ Helper::appDateFormat($pnr->dept_date) ?? '-' }}</td>
                <td>{{ $pnr->seats ?? '-' }}</td>
                <td>{{ $pnr->avai_seats ?? '-' }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
