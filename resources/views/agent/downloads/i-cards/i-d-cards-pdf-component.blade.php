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
    </style>
</head>

<body>
	@foreach($datas as $data)
    <table style="width:100%;" cellpadding="0px" cellspacing="0">
        <tbody>
            <tr>
                <td width="50%" valign="top" style="padding:0px 10px 20px 20px;">

                    <div style="width:389px;height:574px;margin:0px auto;padding:0px;font-size:16px;">
                        <table
                            style="width:100%;height:574px;font-size:16px;background-image:url({{ $data['front_background'] }});background-size:100% 100%;background-position:center bottom;"
                            cellpadding="0px" cellspacing="0px">
                            <tbody>
                                <tr>
                                    <td valign="bottom" colspan="2" align="center" style="height: 380px;">
                                        <img src="{{ $data['pax_photo'] }}"
                                            width="114px" height="150px" alt="img"
                                            style="width:114px;height:150px;object-fit:cover;object-position:top;border:10px solid #ffffff; display:block;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="2" align="left"
                                        style="padding-top:10px;padding-left:25px;padding-right:25px;font-size:25px;color:#ffffff;font-weight:bold;text-transform:uppercase;height: 72px;">
                                        {{ $data['pax_name'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="50%" align="left"
                                        style="padding-left:25px;font-weight:bold;height: 26px;">
                                        Booking ID :
                                    </td>
                                    <td valign="top" width="50%" align="left"
                                        style="padding-right:25px;font-weight:bold;height: 26px;">
                                        {{ $data['booking_id'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="50%" align="left"
                                        style="padding-left:25px;font-weight:bold;height: 26px;">
                                        Passport Number :
                                    </td>
                                    <td valign="top" width="50%" align="left"
                                        style="padding-right:25px;font-weight:bold;height: 26px;">
                                        {{ $data['pax_passport'] }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td valign="top" colspan="2" align="center"
                                        style="padding-top:10px;padding-left:25px;padding-right:25px;font-size:14px;color:#ffffff;font-weight:bold;text-transform:uppercase;height: 18px;">
                                        {{ $data['agency_name'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="2" align="center">
                                        <table cellpadding="0px" cellspacing="0px">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" align="center"
                                                        style="padding-left:25px;padding-top:8px;">
                                                        <img src="{{ $data['agency_logo'] }}" width="56px" height="auto"
                                                            alt="img" style="width:56px;height:auto;" />
                                                    </td>
                                                    <td valign="top" align="center"
                                                        style="padding:8px;font-size:12px;color:#ffffff;font-weight:bold;height: 50px;">
                                                        <div>DELHI: 109/110 VARDHMAN VARDHMAN PLAZA, NEW DEL-110001
                                                        </div>
                                                        <div>Web:https://www.rahat.in</div>
                                                    </td>
                                                    <td valign="top" align="center"
                                                        style="padding-right:25px;padding-top:8px;">
                                                        <img src="{{ $data['logo_2'] }}" width="56px" height="auto"
                                                            alt="img" style="width:56px;height:auto;" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </td>
                <td width="50%" valign="top" style="padding:0px 10px 20px 20px;">
					<div style="width:389px;height:574px;margin:0px auto;padding:0px;font-size:16px;">
						<table style="width:100%;height:574px;font-size:16px;background-image:url({{ $data['rear_background'] }});background-size:100% 100%;background-position:center bottom;" cellpadding="0px" cellspacing="0px">
							<tbody>
								<tr>
									<td valign="bottom" colspan="2" align="center" style="height: 373px;">
										
									</td>
								</tr>
								<tr>
									<td valign="top" width="50%" align="left" style="padding-left:25px;font-weight:bold;height: 46px;">
										Name :
									</td>
									<td valign="top" width="50%" align="left" style="padding-right:25px;font-weight:bold;height: 46px;">
										{{ $data['pax_name'] }}
									</td>
								</tr>
								<tr>
									<td valign="top" width="50%" align="left" style="padding-left:25px;font-weight:bold;height: 46px;">
										Package Name :
									</td>
									<td valign="top" width="50%" align="left" style="padding-right:25px;font-weight:bold;height: 46px;">
										{{ $data['pkg_name'] }}
									</td>
								</tr>
								<tr>
									<td valign="top" width="50%" align="left" style="padding-left:25px;font-weight:bold;height: 46px;">
										Package Type :
									</td>
									<td valign="top" width="50%" align="left" style="padding-right:25px;font-weight:bold;height: 46px;">
										{{ $data['pkg_type'] }}
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td valign="top" colspan="2" align="center" style="padding-top:10px;padding-left:25px;padding-right:25px;font-size:15px;color:#ffffff;font-weight:bold;text-transform:uppercase;height: 20px;">
										
									</td>
								</tr>
								<tr>
									<td valign="top" colspan="2" align="center">
										<table cellpadding="0px" cellspacing="0px">
											<tbody>
												<tr>
													<td valign="top" align="center" style="padding-left:25px;padding-top:8px;">
														<img src="{{ $data['agency_logo'] }}" width="56px" height="auto" alt="img" style="width:56px;height:auto;"/>
													</td>
													<td valign="top" align="center" style="width:260px;padding:8px;font-size:12px;color:#ffffff;font-weight:bold;height: 50px;">
														
													</td>
													<td valign="top" align="center" style="padding-right:25px;padding-top:8px;">
														<img src="{{ $data['logo_2'] }}" width="56px" height="auto" alt="img" style="width:56px;height:auto;"/>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
@endforeach
</body>

</html>
