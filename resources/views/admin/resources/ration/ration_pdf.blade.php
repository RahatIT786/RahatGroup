<!doctype html>
		<html lang="en-us">
			<head>
				<meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
				<title>Ration Details</title>
				<meta name="description" content="">
				<meta http-equiv="x-ua-compatible" content="ie=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1"> 
			</head>
			<body style="background-color:#f2f2f2;">
			 <h5 style="color:#4c606a;text-align:center;font-family:Helvetica Neue ;margin: 10px 0;font-size: 14px;margin-top: 10px;margin-bottom: 10px;font-weight: 500;line-height: 1.1">Ration Title : {{$rationData->ration_title}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ration Date : {{date("d-m-Y", strtotime($rationData->txn_date)) }}</h5>
			<table width="90%" cellspacing="5" cellpadding="5" style="border: 1px solid #b8cbd4;border-collapse: collapse;text-align:left;"  cellspacing="0px" cellpadding="0px" ;>
					<thead>
						<tr>
							<th style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;height:30px;" >#</th>
							<th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >Item Name</th>
							<th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >Description</th>
							<th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >City Name</th>
							<th style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >Weight</th>
							<th style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >Rate</th>
							<th style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;" >Total</th>
						</tr>            
					</thead>
					<tbody>
						@php
							$i = 0;
							$totalPrice = 0;
						@endphp
						@foreach($rationDetail as $detail)
							@php
								$i++;
								$totalPrice += $detail->total_rate;
							@endphp
							<tr>
								<td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;height:25px;">{{ $i }}</td>
								<td style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->main_item }}</td>
								<td style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->description }}</td>
								<td style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->city->city_name }}</td>
								<td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->weight }}</td>
								<td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->rate }}</td>
								<td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $detail->total_rate }}</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="6" style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:right;padding-top:15px;">Total Amount</td>
							<td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ $totalPrice }}</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>