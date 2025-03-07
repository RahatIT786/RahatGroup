<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AIHUT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        @font-face {
            font-family: 'impact';
            src: url('{{ public_path('fonts/impact.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        img {
            max-width: 100%;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, 'sans-serif';
            font-size: 16px;
            line-height: 1.2;
        }

        table {
            border-collapse: collapse;
        }

        table th {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div
        style="width:100%; margin:0 auto; padding: 0 0px;background:url({{ $package_center_bottom }});background-position:bottom center;background-repeat: no-repeat;background-size: contain;">
        <img src="{{ $package_image_top }}" width="100%"
            style="position: absolute;left:0px;top:0px;width:100%;z-index:-1;" />
        <!-- Additional content goes here -->
        <table style="width:95%;margin:0 auto;">
            <tbody>
                <tr>
                    <td valign="top" height="180px" width="80%" style="padding-top:20px;">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td valign="top" width="100px"><img src="{{ $logo }}"
                                            style="width:100px;" width="90px" alt="logo" /></td>
                                    <td valign="middle" style="padding-left:20px;">
                                        <div
                                            style="font-size:26px;font-weight:bold;font-family:'impact', sans-serif;text-transform:uppercase;color:#f1e797;text-shadow:2px 2px 0px rgba(0,0,0,0.7);">
                                            All India Hajj & Umrah Tours PVT. LTD.</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td height="180px" width="20%"></td>
                </tr>
            </tbody>
        </table>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;" cellpadding="10px" cellspacing="0">
            <thead style="background:#92cddc; border: 1px solid #000000;">
                <tr>
                    <th rowspan="2" style="border: 1px solid #000000;width:16.666%;">VOUCHER NO</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:16.666%;">GROUP NO</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:16.666%;">SUB AGENT NAME</th>
                    <th colspan="2" style="border: 1px solid #000000;width:16.666%;">NO. OF PAX</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:16.666%;">TOUR LEADER</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:16.666%;">CONTACT NO</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #000000;">ADULT</th>
                    <th style="border: 1px solid #000000;">CHILD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $voucher_no }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $group_no }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $subagent_name }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $adult }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $child_bed }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $tour_leader }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $contact_no }}</strong></td>
                </tr>
            </tbody>
        </table>
        <div style="font-size:20px;font-weight:700;padding-left:50px;padding-top:8px;padding-bottom:8px;">FLIGHT
            INFORMATION</div>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;" cellpadding="5px" cellspacing="0">
            <thead style="background:#92cddc; border: 1px solid #000000;text-align:left;">
                <tr>
                    <th style="border: 1px solid #000000;width:12.5%;">FROM</th>
                    <th style="border: 1px solid #000000;width:12.5%;">TO</th>
                    <th style="border: 1px solid #000000;width:12.5%;">DATE</th>
                    <th style="border: 1px solid #000000;width:12.5%;">ETD</th>
                    <th style="border: 1px solid #000000;width:12.5%;">ETA</th>
                    <th style="border: 1px solid #000000;width:12.5%;">CARRIER</th>
                    <th style="border: 1px solid #000000;width:12.5%;">FLIGHT NO.</th>
                    <th style="border: 1px solid #000000;width:12.5%;">REMARKS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ substr($departuresector, 0, 3) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ str_replace('-', '', substr($departuresector, 4)) }}</strong>
                    </td>

                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($departuredate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $departuretime }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $carrier }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $flightcode }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ substr($returnsector, 0, 3) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ str_replace('-', '', substr($returnsector, 4)) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($returndate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $returntime }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $carrier }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $flightcode }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                </tr>
            </tbody>
        </table>
        <div style="font-size:20px;font-weight:700;padding-left:50px;padding-top:8px;padding-bottom:8px;">HOTEL
            ACCOMODATION</div>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;" cellpadding="10px" cellspacing="0">
            <thead style="background:#92cddc; border: 1px solid #000000;">
                <tr>
                    <th rowspan="2" style="border: 1px solid #000000;width:20%;">CITY</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:20%;">HOTEL</th>
                    <th colspan="2" style="border: 1px solid #000000;width:20%;">DATE</th>
                    <th colspan="4" style="border: 1px solid #000000;width:20%;">TYPR ROOM</th>
                    <th rowspan="2" style="border: 1px solid #000000;width:20%;">RESV NO</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #000000;">IN</th>
                    <th style="border: 1px solid #000000;">OUT</th>
                    <th style="border: 1px solid #000000;">DBL</th>
                    <th style="border: 1px solid #000000;">TRPL</th>
                    <th style="border: 1px solid #000000;">QUAD</th>
                    <th style="border: 1px solid #000000;">SINGLE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MAKKAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $makka_hotel }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($departuredate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($makkaCheckOutDate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MADINAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $madina_hotel }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($makkaCheckOutDate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($returndate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                    <td style="border: 1px solid #000000;text-align:center;"></td>
                </tr>
            </tbody>
        </table>
        <div style="font-size:20px;font-weight:700;padding-left:50px;padding-top:8px;padding-bottom:8px;">TRANSPORT
        </div>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;" cellpadding="5px" cellspacing="0">
            <thead style="background:#92cddc; border: 1px solid #000000;text-align:left;">
                <tr>
                    <th style="border: 1px solid #000000;width:14.28%;">DATE</th>
                    <th style="border: 1px solid #000000;width:14.28%;">FROM</th>
                    <th style="border: 1px solid #000000;width:14.28%;">TO</th>
                    <th style="border: 1px solid #000000;width:14.28%;">TIME</th>
                    <th style="border: 1px solid #000000;width:14.28%;">TOTAL</th>
                    <th style="border: 1px solid #000000;width:14.28%;">TOTAL BUS</th>
                    <th style="border: 1px solid #000000;width:14.28%;">BUS COMPANY</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($departuredate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>AIRPORT JEDDAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MAKKAH/ BURJ DEAFAH/WAHA
                            DEAFAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $departuretime }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>BASMA</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate(\Carbon\Carbon::parse($departuredate)->addDays(3)) }}</strong>

                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MAKKAH/ BURJ DEAFAH/WAHA
                            DEAFAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>JURANA + MAKKAH ZIARAH</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>0800</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>BASMA</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($makkaCheckOutDate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MAKKAH/ BURJ DEAFAH/WAHA
                            DEAFAH</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MADINAH +MADINA BAITY,JOOD
                            MARjAAN</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1400</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>BASMA</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate(\Carbon\Carbon::parse($departuredate)->addDays(10)) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MADINAH/ MONA SALAM / ERJWAAN
                            GOLDEN</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MADINAH ZIARAH</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>0800</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>BASMA</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($returndate) }}</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>MADINAH/ MONA SALAM / ERJWAAN
                            GOLDEN</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>AIRPORT JEDDAH</strong>
                    </td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>{{ $returntime }}</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong></strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>1</strong></td>
                    <td style="border: 1px solid #000000;text-align:center;"><strong>BASMA</strong></td>
                </tr>
            </tbody>
        </table>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;margin-top:10px;" cellpadding="5px"
            cellspacing="0">
            <tfoot>
                <tr>
                    <td style="width:50%;border: 1px solid #000000;text-align:center;"><strong>RAWDA PERMIT</strong>
                    </td>
                    <td style="width:50%;border: 1px solid #000000;text-align:center;">
                        <strong>{{ Helper::formatCarbonDate($rawda_permit) }}</strong>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div style="font-size:20px;font-weight:700;padding-left:50px;padding-top:8px;padding-bottom:8px;">LOCAL CONTACT
            PERSON</div>
        <table style="width:95%;margin:0 auto; border: 1px solid #000000;" cellpadding="5px" cellspacing="0">
            <thead style="background:#92cddc; border: 1px solid #000000;text-align:left;">
                <tr>
                    <th style="border: 1px solid #000000;width:12.5%;">NAME</th>
                    <th style="border: 1px solid #000000;width:12.5%;">CONTACT NO.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000000;"><strong>ZAFFAR (MAKKAH)</strong></td>
                    <td style="border: 1px solid #000000;"><strong>SHOEB (MADINAH)</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"><strong>+966 59 046 6545</strong></td>
                    <td style="border: 1px solid #000000;"><strong>+966 58 379 8252</strong></td>
                </tr>
            </tbody>
        </table>
        <img src="{{ $package_image_bottom }}" width="100%"
            style="position: absolute;left:0px;bottom:0px;top:auto;width:100%;z-index:-1;" />
        <table style="width:100%;">
            <tbody>
                <tr>
                    <td height="250px"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
