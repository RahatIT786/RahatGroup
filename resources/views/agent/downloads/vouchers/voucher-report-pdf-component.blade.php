<style type="text/css">
    body {
        font-family: sans-serif;
        font-size: 14px;
    }

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

    ul {
        margin: 0px 0px 0px 14px;
        padding: 0px 0px 0px 0px;
        /* Remove default bullet */
    }

    ul li {
        margin: 0px 0px;
        padding: 5px 0px;
        line-height: 20px;
        color: #000;
        text-align: left;
        position: relative;
    }
</style>

<body>
    <table width="100%" style="margin:0px;font-family:sans-serif;  ;width:100%;margin-bottom:2px;text-align:left; "
        cellpadding="0px" ; cellspacing="0px">
        <tr>
            <td style="width:70%;border:0px;border-bottom:1px solid #000000;">
                <h1
                    style="padding:0px;text-align:left;font-family:sans-serif;font-weight:bold;margin:0;margin-bottom: 5px;color: #264e8a;">
                    {{ $agency }}</h1>
                <p style="text-align:left;font-family:sans-serif;padding-left:0px;margin:0;margin-bottom: 5px;">Website
                    ::
                    {{ $agency_website }} Email:: {{ $agency_mail }} </p>
                <p style="text-align:left;font-family:sans-serif;padding:0px;margin:0;margin-bottom: 5px;">Tel :
                    {{ $agency_tel }} ,</p>
                <p style="text-align:left;font-family:sans-serif;padding:0px;margin:0;margin-bottom: 5px;">
                    {{ $agency_city }} </p>
            </td>
            <td style="width:30%;border:0px;text-align:right;border-bottom:1px solid #000000;">
                <p style="padding:0px;font-family:sans-serif;font-weight:bold;margin:0;">Booking ID: {{ $booking_id }}
                </p>
                <p>{{ $meheram_name }}</p>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="5" cellpadding="5"
        style="font-family: sans-serif;border-collapse:collapse;margin-top:15px;border: none;" cellspacing="0px"
        cellpadding="0px" ;>
        <tr>
            <td style="width:75%;">
                <table width="97%" cellspacing="5" cellpadding="5"
                    style="border: 1px solid #b8cbd4;border-collapse:collapse;text-align:left;" cellspacing="0px"
                    cellpadding="0px" ;>
                    <tbody>
                        <tr>
                            <th
                                style="padding:2px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:13px;color:#4c606a;">
                                Package Name :</th>
                            <td style="padding:2px;width:60% ;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $package_name }}</td>
                        </tr>
                        <tr>
                            <th
                                style="padding:2px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:13px;color:#4c606a;">
                                Group Name:</th>
                            <td
                                style="padding:2px;width:60% ;border: 1px solid #b8cbd4;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $group_name }}</td>
                        </tr>
                        <tr>
                            <th
                                style="padding:2px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:13px;color:#4c606a;">
                                PAX:
                            </th>
                            <td style="padding:2px;width:60% ;border: 1px solid #b8cbd4;color:#4c606a;font-size:14px;">
                                {{ $no_of_person }} (Adults: {{ $adult }} Child: {{ $childbed }} Child no
                                bed:
                                {{ $children }} Infant:
                                {{ $infant }})
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="padding:2px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:13px;color:#4c606a;">
                                Tour Leader:</th>
                            <td
                                style="padding:2px;width:60% ;border: 1px solid #b8cbd4;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $tour_leader }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width:25%;">
                <img src="data:image/png;base64,{{ $qrcode }}" alt="QR Code" style="height:140px;width:100%;" />

            </td>
        </tr>
    </table>

    @if ($showFlightInfo)
        <table width="100%" cellspacing="5" cellpadding="5"
            style="border-collapse:collapse;margin-top:15px;border: none;" cellspacing="0px" cellpadding="0px">
            <tbody>
                <tr>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Flight PNR
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Departure City
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Airlines
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:25%;">
                        Departure Date
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Time
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Return Date
                    </th>
                    <th
                        style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                        Time
                    </th>
                </tr>
                <tr>
                    <th style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;"
                        scope="row">
                        {{ $flight_pnr }}
                    </th>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $departure_cityname }}</td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $airlines }}</td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ Helper::formatCarbonDate($dept_date) }}</td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $dept_time }}:00
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ Helper::formatCarbonDate($return_date) }}
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $return_time }}:00
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
    <table style="margin:0px;font-family:sans-serif;margin-top:15px;text-align:left;width:100%;" cellpadding="0px"
        cellspacing="0px">
        <tbody>
            <tr>
                <td
                    style="border:0px;font-family:sans-serif;font-size:17px;background: #ffa500;color:#000000; text-align:left;">
                    <pre style="font-family:sans-serif;padding:0px;margin:0px;"><strong>{!! $itenary !!}</strong></pre>
                </td>
            </tr>
        </tbody>
    </table>
    <table width="100%" cellspacing="5" cellpadding="5" style="border-collapse:collapse;margin-top:15px;border: none;"
        cellspacing="0px" cellpadding="0px">
        <tbody>
            <tr>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;text-align: center;width:15%;">
                    City</th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;text-align: center;width:15%;">
                    Hotel</th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;text-align: center;width:15%;">
                    Distance</th>
            </tr>
            <tr>
                <th style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;" scope="row">
                    Makka
                </th>
                <td style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                    {{ $makka_hotel }}</td>
                <td style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                    {{ $makka_distance }} Mtrs</td>
            </tr>
            <tr>
                <th style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;" scope="row">
                    Madina
                </th>
                <td style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                    {{ $madina_hotel }}</td>
                <td style="padding:6px;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                    {{ $madina_distance }} Mtrs</td>
            </tr>
        </tbody>
    </table>
    </br>
    <h1 style="font-size:20px;background: #ffa500;color:#000000; ">Inclusions</h1>
    <table width="100%" cellspacing="5" cellpadding="5"
        style="border-collapse:collapse;margin-top:15px;border: none;">
        <thead>
            <tr>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Ticket</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Visa</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Stay</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Food</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Laundry</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Zamzam</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Transfers</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Ziyarat</th>
                <th
                    style="padding:6px; border: 1px solid #b8cbd4;background-color:#000;color:#fff;text-align: center;width:15%;">
                    Welcome Kit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Ticket'] }}</td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Visa'] }}
                </td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Stay'] }}
                </td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Food'] }}
                </td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Laundry'] }}</td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Zamzam'] }}</td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Transfers'] }}</td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Ziyarat'] }}</td>
                <td style="padding:6px;border: 1px solid #b8cbd4;text-align:center;color:#4c606a;">
                    {{ $services['Welcome Kit'] }}</td>
            </tr>
        </tbody>
    </table>
    </br>
    {{-- <h1 style="font-size:20px;background: #ffa500;color:#000000; background: #ffa500;color:#000000; ">
        Exclusions</h1> --}}
    <div>Service Type :: {{ $service_type }} | Package Type :: {{ $package_type }}</div>
    <div>Sharing Type :: {{ $sharingtype }} |Total Bed ::{{ $total_bed }} & Total Pax :: {{ $total_pax }}
    </div>
    </br>
    <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1 style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;">IMPORTANT NOTES
        </h1>
        <div>
            <ul>{!! $page_description !!}</ul>
        </div>
    </div>
    <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1 style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;">Package Overview
        </h1>
        <table style="width:100%;">
            <tr>
                <td valign="top" style="width:33.3333%;">
                    <p style="font-size:17px;color:#11752f;margin-bottom:0px;">Flight & Transport</p>
                    <div style="font-size:14px;">
                        <ul>{!! $flight_transport !!}</ul>
                    </div>
                </td>
                <td valign="top" style="width:33.3333%;">
                    <p style="font-size:17px;color:#11752f;margin-bottom:0px;">Meals</p>
                    <div style="font-size:14px;">
                        <ul>{!! $meals !!}</ul>
                    </div>
                </td>
                <td valign="top" style="width:33.3333%;">
                    <p style="font-size:17px;color:#11752f;margin-bottom:0px;">Visa & Taxes</p>
                    <div style="font-size:14px;">
                        <ul>{!! $visa_taxes !!}</ul>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1
            style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;border:red 1px solid;margin:0px;">
            Inclusions /
            Exclusions</h1>
        <table style="width:100%;">
            <tr>
                <td valign="top" style="width:50%;">
                    <p style="font-size:17px;color:#11752f;margin-bottom:0px;margin-top:0px;">Inclusions</p>
                    <div>
                        <ul>{!! $inclusion !!}</ul>
                    </div>
                </td>
                <td valign="top" style="width:50%;">
                    <p style="font-size:17px;color:#11752f;margin-bottom:0px;margin-top:0px;">Exclusions</p>
                    <div>
                        <ul>{!! $exclusion !!}</ul>
                    </div>
                </td>
            </tr>
        </table>
    </div> --}}
    <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1 style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;">Itinerary</h1>
        <div>{!! $itinerary !!}</div>
    </div>
    <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1 style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;">Payment Policy /
            Important Notes
        </h1>
        <p style="font-size:17px;margin-bottom:0px;margin-top:0px;">
        <ul>{!! $payment_policy !!}</ul>
        </p>
        <p style="font-size:17px;margin-bottom:0px;margin-top:0px;">
        <ul>{!! $important_notes !!}</ul>
        </p>
    </div>
    <div style="border: 1px solid #e4e4e4;margin-bottom:20px;">
        <h1 style="font-size:20px;background: #ffa500;color:#000000;margin-top:0px;margin-bottom:0px;">Cancellation
            Policy</h1>
        <div>
            <ul>{!! $cancellation_policy !!}</ul>
        </div>
    </div>
</body>
