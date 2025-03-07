<!doctype html>
<html lang="en-us">

<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
    <title>All Booking List</title>
    <meta name="description" content="">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        table.page_header {
            width: 100%;
            border: none;
            border-bottom: solid 1px #000;
        }

        table.page_footer {
            width: 100%;
            background-color: #DDDDFF;
            border-top: solid 1mm #AAAADD;
            padding: 1mm
        }

        h1 {
            color: #000033
        }

        h2 {
            color: #000055
        }

        h3 {
            color: #000077
        }

        div.standard {
            width: 100%;
        }
    </style>
</head>

<body>
    <h5
        style="color:#4c606a;text-align:center;font-family:Helvetica Neue ;margin: 10px 0;font-size: 14px;margin-top: 10px;margin-bottom: 10px;font-weight: 500;line-height: 1.1">
        ALL BOOKING LIST</h5>
    <table width="100%" cellspacing="5" cellpadding="5"
        style="border: 1px solid #b8cbd4;border-collapse: collapse;text-align:left;" cellspacing="0px" cellpadding="0px"
        ;>
        <thead>
            <tr>
                <th
                    style="padding:3px;text-align:center;width:5%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;height:30px;">
                    #</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Booking ID</th>
                <th
                    style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Name</th>
                <th
                    style="padding:3px;text-align:center;width:15%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Pax</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Agent</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Travel Date</th>
                <th
                    style="padding:3px;text-align:center;width:25%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Total Cost</th>
                <th
                    style="padding:3px;text-align:center;width:25%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Balance</th>
                <th
                    style="padding:3px;text-align:center;width:25%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Status</th>
            </tr>
        </thead>
        <tbody>

            {{-- @php
                $i = 1;
            @endphp
            @foreach ($bookingData as $booking)
                @php
                    $totalPaymentAmount = $booking->payment->sum('amount');
                @endphp --}}

            @php
                $i = 0;
            @endphp
            @foreach ($bookingData as $booking)
                @php
                    $i++;
                    $totalPaymentAmount = $booking->payment->sum('amount') + $booking->full_payment_discount;
                @endphp
                <tr>
                    <td
                        style="color:#4c606a;width:5%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;height:25px;">
                        {{ $i }}
                    </td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->booking_id ?? '-' }}
                    </td>
                    <td
                        style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->mehram_name ?? '-' }}
                    </td>
                    <td
                        style="color:#4c606a;width:15%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->adult + $booking->child_bed + $booking->child + $booking->infant ?? '-' }}
                    </td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->agency->agency_name ?? '-' }}
                    </td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->travel_date != null ? Helper::appDateFormat($booking->travel_date) : 'N/A' }}
                    </td>
                    <td
                        style="color:#4c606a;width:25%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ number_format($booking->tot_cost) }}
                    </td>
                    <td
                        style="color:#4c606a;width:25%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ number_format($booking->tot_cost - $totalPaymentAmount) }}
                    </td>
                    <td
                        style="color:#4c606a;width:25%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $booking->booking_status == 0 ? 'Pending' : 
                        ($booking->booking_status == 1 ? 'Approved' : 
                        ($booking->booking_status == 2 ? 'Rejected' : 
                        ($booking->booking_status == 3 ? 'Cancelled' :
                        ($booking->booking_status == 4 ? 'Suspended' :
                        ($booking->booking_status == 5 ? 'Under Review' :
                        ($booking->booking_status == 6 ? 'Deleted' :
                        ($booking->booking_status == 7 ? 'Waiting List' : 'Not received'))))))) }}

                        {{-- @php
                        $statusText = [
                            0 => ['text' => 'Pending', 'color' => 'red'],
                            1 => ['text' => 'Approved', 'color' => 'green'],
                            2 => ['text' => 'Rejected', 'color' => '#60d4ec'],
                            3 => ['text' => 'Cancelled', 'color' => '#ec60d6'],
                            4 => ['text' => 'Suspended', 'color' => 'orange'],
                            5 => ['text' => 'Under Review', 'color' => '#9f3794'],
                            6 => ['text' => 'Deleted', 'color' => '#9d3219'],
                            7 => ['text' => 'Waiting List', 'color' => 'dark'],
                        ];
                    @endphp
                    @if (array_key_exists($booking->booking_status, $statusText))
                        <div
                            class="pointer badge {{ $statusText[$booking->booking_status]['color'] }}">
                            {{ $statusText[$booking->booking_status]['text'] }}
                        </div>
                    @endif --}}

                    </td>

                </tr>
            @endforeach

            @if ($bookingData->isEmpty())
                <tr>
                    <td colspan="8"
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:right;padding-top:15px;color:red;">
                        No List Found
                    </td>
                </tr>
            @endif
        </tbody>

    </table>
</body>

</html>
