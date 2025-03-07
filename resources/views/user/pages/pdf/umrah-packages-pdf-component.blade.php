<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AIHUT</title>
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
            font-family: arial;
            line-height: 1.2;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    @php
        $packageImageSrc = Helper::imageForPDF($packageData->pkgImages[0]->pkg_img, 'package_image');
    @endphp
    <div style="width:720px;margin:0px auto;padding:0px;border:1px solid #e4e4e4;">
        <img src="{{ $packageImageSrc }}" width="100%" />
        <div
            style="background:#006a20;padding-top:25px;padding-left:25px;padding-right:25px;position:relative;border-bottom:8px solid #000000;">
            <div
                style="background:url({{ public_path('assets/img/itinerary-img/green-bg.png') }}) repeat-x;background-size: cover;width:100%;height:52px;position:absolute;left:0px;top:-50px;padding-bottom:1px;">
            </div>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td valign="top" style="padding-bottom:15px;">
                            <div style="color:#ffffff;">Here is your package for</div>
                            <div style="width:50px;height:2px;background:#ffffff;margin-top:20px;margin-bottom:20px;">
                            </div>
                            <div style="color:#ffffff;font-size:38px;">{{ $package_name }}</div>
                        </td>
                        <td valign="top" align="right" style="color:#ffffff;padding-bottom:15px;">
							Tour Code: {{ $pnr_details['tour_code'] ?? 'N/A' }}
						</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:#ffffff;font-size:17px;padding-top:10px;padding-bottom:10px;border-top:1px dashed #ffffff;border-bottom:1px dashed #ffffff;">
							{{ $pnr_details['days'] }} Days - <span style="color:#ffe000;">{{ $pnr_details['city_name'] }}</span>
						</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="text-align:center;color:#ffe000;font-size:12px;padding-top:15px;padding-bottom:15px;">
						</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#3e3e3e;">OVERVIEW</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td valign="top" style="width:40%;padding-bottom:15px;border-right:1px solid #e1e1e1;padding-right:20px;">
							<table style="width:100%;">
								<tbody>
									<tr>
										<td valign="top" width="72px">
											<img src="" width="54px" height="52px"/>
										</td>
										<td valign="top">
											<div style="font-size:20px;font-weight:bold;color:#3e3e3e;padding-bottom:10px;">DEPARTURE DATES</div>
											<div style="font-size:17px;color:#695f5f;padding-bottom:10px;">{{ $pnr_details['departure_date'] }}</div>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
                        <td valign="top" style="width:60%;padding-bottom:15px;padding-left:50px;">
                            <table style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="72px">
                                            <img src="{{ public_path('assets/img/itinerary-img/map-icon.png') }}"
                                                width="53px" height="51px" />
                                        </td>
                                        <td valign="top">
                                            <div
                                                style="font-size:20px;font-weight:bold;color:#3e3e3e;padding-bottom:10px;">
                                                DESTINATIONS</div>
                                            <div style="font-size:17px;color:#695f5f;padding-bottom:10px;">Makkah
                                                Madinah</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">ITINERARY..!!</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            {!! $itinerary !!}

        </div>

        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">HOTELS</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <table style="width:100%;position:relative;margin-bottom:58px;">
                <tbody>
                    @foreach ($package_details as $detail)
                        <tr>
                            <td colspan="4"
                                style="font-size:20px;font-weight:bold;color:#ffb300;padding-bottom:20px;">
                                {{ $detail['package_type'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"
                                style="font-size:18px;font-weight:bold;color:#60b739;padding-top:20px;padding-bottom:20px;">
                                MAKKAH</td>
                        </tr>
                        <tr>
                            @php
                                $packageImageSrc = Helper::imageForPDF(
                                    $packageData->pkgImages[0]->pkg_img,
                                    'package_image',
                                );
                            @endphp
                            @php
                                $makkahHotelImageSrc = Helper::imageForPDF(
                                    $detail['makkah_hotel_image'],
                                    'hotel_photo',
                                );
                            @endphp
                            <td valign="top"
                                style="padding-right:8px;padding-bottom:20px;border-bottom:1px solid #d9e3e2;width:158px;">
                                @if ($makkahHotelImageSrc)
                                    <img src="{{ $makkahHotelImageSrc }}" width="150px" height="112px" />
                                @endif
                            </td>
                            <td valign="top"
                                style="padding-top:8px;padding-bottom:20px;border-bottom:1px solid #d9e3e2;">
                                <div style="font-size:18px;font-weight:bold;color:#000000;padding-bottom:10px;">
                                    {{ $detail['makkahotel'] }}<small
                                        style="color:#bc2e31;font-weight:normal;font-size:14px;">(OR Similar)</small>
                                </div>
                                <div>

                                    @if (is_numeric($detail['makkah_hotel_star_rating']) &&
                                            (int) $detail['makkah_hotel_star_rating'] >= 1 &&
                                            (int) $detail['makkah_hotel_star_rating'] <= 5)
                                        @for ($i = 0; $i < (int) $detail['makkah_hotel_star_rating']; $i++)
                                            <img src="{{ public_path('assets/img/itinerary-img/star-icon.png') }}"
                                                width="20px" height="20px" />
                                        @endfor
                                    @else
                                        <p>{{ $detail['makkah_hotel_star_rating'] }}</p>
                                    @endif
                                </div>
                            </td>

                        <tr>
                            <td colspan="4"
                                style="font-size:20px;font-weight:bold;color:#ffb300;padding-bottom:20px;">
                                {{ $detail['package_type'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"
                                style="font-size:18px;font-weight:bold;color:#60b739;padding-top:20px;padding-bottom:20px;">
                                MADINAH</td>
                        </tr>
                        <tr>
                            @php
                                $packageImageSrc = Helper::imageForPDF(
                                    $packageData->pkgImages[0]->pkg_img,
                                    'package_image',
                                );
                            @endphp
                            @php
                                $madinahHotelImageSrc = Helper::imageForPDF(
                                    $detail['madinah_hotel_image'],
                                    'hotel_photo',
                                );
                            @endphp
                            <td valign="top"
                                style="padding-right:8px;padding-bottom:20px;border-bottom:1px solid #d9e3e2;width:158px;">
                                @if ($madinahHotelImageSrc)
                                    <img src="{{ $madinahHotelImageSrc }}" width="150px" height="112px" />
                                @endif
                            </td>
                            <td valign="top"
                                style="padding-top:8px;padding-bottom:20px;border-bottom:1px solid #d9e3e2;">
                                <div style="font-size:18px;font-weight:bold;color:#000000;padding-bottom:10px;">
                                    {{ $detail['madinahotel'] }}<small
                                        style="color:#bc2e31;font-weight:normal;font-size:14px;">(OR Similar)</small>
                                </div>
                                <div>

                                    @if (is_numeric($detail['madinah_hotel_star_rating']) &&
                                            (int) $detail['madinah_hotel_star_rating'] >= 1 &&
                                            (int) $detail['madinah_hotel_star_rating'] <= 5)
                                        @for ($i = 0; $i < (int) $detail['madinah_hotel_star_rating']; $i++)
                                            <img src="{{ public_path('assets/img/itinerary-img/star-icon.png') }}"
                                                width="20px" height="20px" />
                                        @endfor
                                    @else
                                        <p>{{ $detail['madinah_hotel_star_rating'] }}</p>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">MEALS</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                {!! $meals !!}
            </ul>
        </div>

        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">TRIP COST</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <table style="width:100%;position:relative;">
                <tbody>
                    <tr>
                        <td style="padding-bottom:60px;">
                            <div style="font-size:19px;color:#737373;font-weight:bold;padding-bottom:8px;">DEPARTURE
                                DATES : <span style="font-style:italic;color:#006a20;font-weight:normal;"><strong>{{ $pnr_details['departure_date'] }}</strong></span></div>
                            <div style="font-size:19px;color:#737373;font-weight:bold;padding-bottom:8px;">DEPARTURE
                                CITY : <span style="font-style:italic;color:#006a20;font-weight:normal;">{{ $pnr_details['city_name'] }}</span></div>
                            <div style="font-size:19px;color:#737373;font-weight:bold;padding-bottom:8px;">AIRLINE :
                                <span style="font-style:italic;color:#006a20;font-weight:normal;">{{ $pnr_details['flight_name'] }}</span>
                            </div>
                        </td>
                    </tr>
                    @foreach ($package_details as $detail)
                        <tr>
                            <td style="padding-bottom:10px;">
                                <div style="font-size:18px;color:#000000;font-weight:normal;">Package Type :<span
                                        style="font-style:italic;color:#006a20;font-weight:normal;">{{ $detail['package_type'] }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            @if (!empty($detail['single']) && $detail['single'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#f8ffcf;border-bottom:3px solid #ffb300;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #ffd573;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                           Single</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['single'], 2) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['d_share']) && $detail['d_share'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#fff1d6;border-bottom:3px solid #f44336;font-weight:normal;margin-right:16px;margin-bottom:45px;">

                                    <div style="border:1px solid #ffc8c1;border-radius:20px;">

                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            DBL Sharing</div>

                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['d_share'], 2) }}
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['t_share']) && $detail['t_share'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#f8ffcf;border-bottom:3px solid #ffb300;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #ffd573;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            Triple Sharing</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['t_share'], 2) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['qd_share']) && $detail['qd_share'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#e9ffd0;border-bottom:3px solid #8bc34a;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #cdff94;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            Quad Sharing</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['qd_share'], 2) }} </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['qt_share']) && $detail['qt_share'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#fff1d6;border-bottom:3px solid #f44336;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #ffc8c1;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            Quint Sharing</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['qt_share'], 2) }}</div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['g_share']) && $detail['g_share'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#e9ffd0;border-bottom:3px solid #8bc34a;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #cdff94;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            Sharing</div>

                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['g_share'], 2) }}
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['child_with_bed']) && $detail['child_with_bed'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#f0faff;border-bottom:3px solid #03a9f4;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #79d5ff;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            CWB</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['child_with_bed'], 2) }}</div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['child_no_bed']) && $detail['child_no_bed'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#fff1f6;border-bottom:3px solid #ab47bc;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #d85eec;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            CWOB</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['child_no_bed'], 2) }}</div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($detail['infant']) && $detail['infant'] != 0)
                                <div
                                    style="display:inline-block;vertical-align:top;text-align:center;width:138px;border-radius:20px;background:#e2e6ff;border-bottom:3px solid #25476a;font-weight:normal;margin-right:16px;margin-bottom:45px;">
                                    <div style="border:1px solid #4383c5;border-radius:20px;">
                                        <div
                                            style="padding:15px 5px;border-bottom:1px dashed #006a20;letter-spacing: 1.5px;font-size:16px;color:#000000;">
                                            Infant</div>
                                        <div style="padding:15px 5px;font-size:16px;color:#000000;">INR
                                            {{ number_format($detail['infant'], 2) }}</div>
                                    </div>
                                </div>
                            @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div style="padding-bottom:50px;">
                <ul style="color:#006a20;font-size:16px;list-style:none;padding: 0px;margin: 0px;line-height: 24px;">
                    <li>* All Prices are Per Person</li>
                    <li>* CWOB: Child Without Bed</li>
                    <li>* CWB: Child With Bed.</li>
                </ul>
            </div>
            <div>
                <div style="font-size:20px;color: #3e3e3e;font-weight: bold;padding-bottom:25px;">PAYMENT SCHEDULE
                </div>
                <ul style="color:#000000;font-size:16px;list-style:none;padding: 0px;margin: 0px;line-height: 24px;">
                    {!! $payment_policy !!}
                </ul>
            </div>
        </div>
        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">INCLUSIONS / EXCLUSIONS</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <table style="width:100%;position:relative;margin-bottom:58px;">
                <tbody>
                    <tr>
                        <td valign="top" style="width:50%;padding-right:20px;">
                            <div style="font-size:20px;font-weight:bold;color:#60b739;padding-bottom:10px;">INCLUSIONS
                            </div>
                            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                                {!! $inclusion !!}
                            </ul>
                        </td>
                        <td valign="top" style="width:50%;">
                            <div style="font-size:20px;font-weight:bold;color:#60b739;padding-bottom:10px;">EXCLUSIONS
                            </div>
                            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                                {!! $exclusion !!}
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">VISA & TAXES</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                {!! $visa_taxes !!}
            </ul>
        </div>
        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">CANCELLATION POLICY</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                {!! $cancellation_policy !!}
            </ul>
        </div>
        <div style="padding-top:25px;padding-bottom:25px;padding-left:25px;padding-right:25px;position:relative;">
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">TAKEOFF..!!</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <table style="width:100%;position:relative;margin-bottom:58px;">
                <tbody>
                    <tr>
                        <td valign="top" style="width:50%;padding-right:20px;">
                            <div style="font-size:20px;font-weight:bold;color:#60b739;padding-bottom:10px;">FLIGHT &
                                TRANSPORT</div>
                            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                                {!! $flight_transport !!}
                            </ul>
                        </td>
                        <td valign="top" style="width:50%;">

                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align:center;font-size:24px;font-weight:bold;color:#000000;">IMPORTANT NOTES</div>
            <div style="width:100%;height:10px;background:#006a20;margin-top:20px;margin-bottom:20px;"></div>
            <ul style="color:#000000;font-size:16px;padding-left: 15px;margin: 0px;line-height: 24px;">
                {!! $important_notes !!}
            </ul>
        </div>
    </div>

</body>

</html>
