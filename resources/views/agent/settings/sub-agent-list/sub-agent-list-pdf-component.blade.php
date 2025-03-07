<!doctype html>
<html lang="en-us">

<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
    <title>Sub Agent Listing</title>
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
        Sub Agent List</h5>
    <table width="100%" cellspacing="5" cellpadding="5"
        style="border: 1px solid #b8cbd4;border-collapse: collapse;text-align:left;" cellspacing="0px" cellpadding="0px"
        ;>
        <thead>
            <tr>
                <th
                    style="padding:3px;text-align:center;width:5%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;height:30px;">
                    #</th>
                <!-- <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Agency Code</th> -->
                <!-- <th
                    style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Agency</th> -->
                <th
                    style="padding:3px;text-align:center;width:15%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Sub Agent Name</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    City</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Mobile</th>
                <th
                    style="padding:3px;text-align:center;width:25%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Email</th>
                {{-- <th
                    style="padding:3px;text-align:center;width:5%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Is Paid</th> --}}
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($subAgentData as $agent)
                @php
                    $i++;
                    // $paid_status =
                    //     $agent->is_paid == '0'
                    //         ? "<span class='redcolor'>Unpaid</span>"
                    //         : "<span class='greencolor'>Paid</span>";
                @endphp
                <tr>
                    <td
                        style="color:#4c606a;width:5%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;height:25px;">
                        {{ $i }}
                    </td>
                    <!-- <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->agent_id }}
                    </td> -->
                    <!-- <td
                        style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->agency->agency_name }}
                    </td> -->
                    <td
                        style="color:#4c606a;width:15%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->name }}
                    </td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->city }}
                    </td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->phone }}
                    </td>
                    <td
                        style="color:#4c606a;width:25%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $agent->email }}
                    </td>
                    {{-- <td
                        style="color:#4c606a;width:5%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {!! $paid_status !!}
                    </td> --}}
                </tr>
            @endforeach

            @if ($subAgentData->isEmpty())
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
