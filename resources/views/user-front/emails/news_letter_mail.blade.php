<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
    <style>
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

        .infotitle {
            color: #56d1dd;
            font-size: 16px;
            margin: 0 0 10px;
        }

        .infobox {
            border: 1px solid #56d1dd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .textlabel {
            color: #7a7a7a;
            margin-bottom: 2px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="mailheader">
            <div style="font-size:16px;color:#206099;"><strong>Dear Team</strong></div>
            <p style="margin:0px;color:#206099;font-size:16px;">We have received an inquiry for the newsletter.</p>
        </div>
        <h6 class="infotitle">Newsletter Info:</h6>
        <div class="infobox">
            <div class="textlabel">Image:</div>
            <img style="width:200px; height:100px" src="{{ asset('storage/' . $image_path) }}" alt="Newsletter Image">
            {{-- <p>Attached below.</p> --}}
        </div>
        <div style="color: #000000;margin-bottom:50px;font-size:16px;">Thank you</div>
        <div style="color: #000000;font-size:16px;">Regards,</div>
        <p style="color: #56d1dd;margin:0px;font-size:16px;">{{ __('tablevars.Rahat Travels of India') }}</p>
    </div>
    <div class="footer">
        &copy; 2024 AIHUT. All rights reserved.
    </div>
</body>

</html>
