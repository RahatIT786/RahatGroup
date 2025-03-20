<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ID Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        img {
            max-width: 100%;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1;
        }

        table {
            border-collapse: collapse;
        }

        table th {
            vertical-align: top;
        }

        /* ---------------------- */
        
    </style>
</head>

<body>
	@foreach($datas as $data)

    <div class="conatiner" style="
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 30vh;
                        
                        margin-top:2rem;
                    ">
                        <div class="idcard" style="
                            border: 1px solid rgba(0,0,0,0.5);
                            width: 35rem;
                            box-shadow: 3px 3px 5px rgba(0,0,0,0.3), -3px -3px 5px rgba(0,0,0,0.3);
                        ">
                            <div class="header" style="
                                padding: 10px;
                                display: -webkit-box;
                            display: -ms-flexbox;
        
                               display: table;
                                 box-sizing: border-box;
                                justify-content: space-between;
                                align-items: center;
                            ">
                                <div class="logo" style="
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    display: table-cell; vertical-align: middle;
                                    padding-left: 1rem;
                                ">
                                    <img class="cardlogo" src="{{$data['logo_1']}}" alt="Logo" style="
                                        height: 40px;
                                    ">
                                </div>
                                <div class="cardnum" style="
                                display: table-cell; vertical-align: middle;
                                    font-size: 45px;
                                    letter-spacing: 3px;
                                    color: rgb(238, 202, 154);
                                    font-weight: 600;
                                     padding-left: 2rem;
                                ">{{$data['pax_passport']}}</div>
                                <div class="id" style="
                                 display: table-cell; vertical-align: middle;
                                    font-size: 34px;
                                    font-weight: 600;
                                    color: rgba(0,0,0,0.6);
                                   
                                     padding-left: 2rem;
                                ">ID</div>
                            </div>
                            <div class="cardbody" style="
                                padding-top:2rem;
                                padding: 10px;
                                display: table;
                                justify-content: center;
                                align-items: center;
                                gap: 8rem;
                                background-image: url({{$data['bg_img']}});
                                background-size: cover;
                                background-position: center;
                                background-repeat: no-repeat;
                                height: 15rem;
                                width:100%;
                            ">
                                <div class="cardbio" style="
                                    display: table-cell; vertical-align: middle;
                                    color: antiquewhite;
                                    width: 60%;
                                ">
                                    <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Name of Passenger: </span>
                                        <span>{{$data['pax_name']}}</span>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Passport No.: </span>
                                        <span>{{$data['pax_passport']}}</span>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Booking ID: </span>
                                        <span>{{$data['booking_id']}}</span>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Package Name:</span>
                                        <span>{{$data['pkg_name']}}</span>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Package Type:</span>
                                        <span>{{$data['pkg_type']}}</span>
                                    </div>
                                    {{-- <div style="margin-top: 10px;">
                                        <span class="title" style="color: white; font-weight: 600;">Hotel Name:</span>
                                        <span>Manazil</span>
                                    </div> --}}
                                </div>
                                <div class="personImg" style="
                                    display: table-cell; vertical-align: middle;
                                    width: 40%;
                                ">
                                    <img src="{{$data['pax_photo']}}" alt="Profile" style="
                                        display: block;
                                        width: 150px;
                                        height: 150px;
                                        border-radius: 5px;
                                        margin-left:2rem;
                                    ">
                                </div>
                            </div>
                            <div class="footer" style="
                                padding: 10px;
                                display: flex;
                                justify-content: space-between;
                            ">
                                <div class="foot-text" style="
                                    font-weight: 500;
                                    font-size: 19px;
                                ">
                                    All India Hajj & Umrah Tour Pvt. Ltd.
                                </div>
                                <div class="barcode"></div>
                            </div>
                        </div>
                    </div>
                 

                    {{-- @if (!$loop->last+2) --}}
                    @if($loop->iteration % 2 == 0 && !$loop->last)
                    <div class="page-break" style="page-break-before: always;"></div>
                @endif
                @endforeach
     
    {{-- @endforeach --}}
</body>

</html>
