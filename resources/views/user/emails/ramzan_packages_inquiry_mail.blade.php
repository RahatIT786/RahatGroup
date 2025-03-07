<!DOCTYPE html>
<html>

<head>
    <title>RamzanPackages Inquiry</title>

    <style>
        /* Importing a beautiful Google Font */

        @import url('https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            color: #3498db;
            text-decoration: none;
        }

        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        .mailheader {
            margin-bottom: 50px;
        }

        .infotitle {
            color: #56d1dd;
            font-size: 16px;
            margin: 0px 0px 10px;
        }

        .infobox {
            border: 1px solid #56d1dd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .fieldrow {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .fieldcol {
            -ms-flex: 0 0 33.333%;
            flex: 0 0 33.333%;
            max-width: 33.333%;
            position: relative;
            width: 100%;
            padding-right: 10px;
            padding-left: 10px;
            margin-bottom: 20px;
        }

        @media(max-width:575px) {
            .fieldcol {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .textlabel {
            color: #7a7a7a;
            margin-bottom: 2px;
            font-size: 16px;
        }

        .textvalue {
            color: #000000;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="mailheader">
            <div style="font-size:16px;color:#206099;"><strong>Dear Team</strong></div>
            <p style="margin:0px;color:#206099;font-size:16px;">We have received Inquiry for ramzanpackages</p>
        </div>
        <h6 class="infotitle">Inquiry Info:</h6>
        <div class="infobox">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:0;">
                <tr>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Inquiry Number</div>
                        <div class="textvalue"><strong>{{ Helper::uppercase($ramzanpackages->unique_id) }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Full Name</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->cust_name }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Mobile No</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->cust_num }}</strong></div>
                    </td>
                </tr>
                <tr>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Email Id</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->cust_email }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Message</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->cust_msg }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">City</div>
                        <div class="textvalue"><strong>{{ $city_name }}</strong></div>
                    </td>
                </tr>
                <tr>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Departure Date</div>
                        <div class="textvalue">
                            <strong>{{ $ramzanpackages->travel_date ? Helper::formatCarbonDate($ramzanpackages->travel_date) : '' }}</strong>
                        </div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Airline</div>
                        <div class="textvalue"><strong>{{ $flight_name }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Package Type</div>
                        <div class="textvalue"><strong>{{ $package_type }}</strong></div>
                    </td>
                </tr>
                <tr>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">Food</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->food == 1 ? 'Yes' : 'No' }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">visa</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->visa == 1 ? 'Yes' : 'No' }}</strong></div>
                    </td>
                    <td style="border:0;width:33.3333%; padding-right:10px;">
                        <div class="textlabel">airticket</div>
                        <div class="textvalue"><strong>{{ $ramzanpackages->air_ticket == 1 ? 'Yes' : 'No' }}
                            </strong></div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="color: #000000;margin-bottom:50px;font-size:16px;">Thank You</div>
        <div style="color: #000000;font-size:16px;">Regards</div>
        <p style="color: #56d1dd;margin:0px;font-size:16px;">{{ __('tablevars.Rahat Travels of India') }}</p>
    </div>

    <div class="footer">

    </div>
</body>

</html>
