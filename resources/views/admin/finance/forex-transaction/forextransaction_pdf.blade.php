<!doctype html>
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
        <title>Forex Transaction Details</title>
        <meta name="description" content="">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
    </head>
    
    <body style="background-color:#f2f2f2;" width="100%">
        <h5 style="color:#4c606a;text-align:center;font-family:Helvetica Neue ;margin: 10px 0;font-size: 14px;margin-top: 10px;margin-bottom: 10px;font-weight: 500;line-height: 1.1">{{$companyNameData}}</h5>
    <table width="100%" cellspacing="5" cellpadding="5" style="border: 1px solid #b8cbd4;border-collapse: collapse;text-align:left;"  cellspacing="0px" cellpadding="0px" ;>
            <thead>
                <tr>
                    <th style="padding:3px;text-align:center;width:5%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:10%;" >#</th>
                    <th style="padding:3px;text-align:center;width:15%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:10%;" >Date</th>
                    <th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:40%;" >Particularts</th>
                    <th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:20%;" >Total Amount (INR)</th>
                    <th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:10%;" >Debit</th>
                    <th style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;width:10%;" >Credit</th>
                </tr>            
            </thead>
            <tbody>
                @if($forexData)
                    @php
                        $tot_debit = 0;
                        $tot_credit = 0;
                        $i = 0;
                    @endphp
                    @foreach($forexData as $forex)
                        @php
                            $i++;
                            $SarRate = $forex->sar_rate;
                            $Sarcredit =  0;
                            $Sardebit =  0;
                            if($forex->types == 'DEBIT') {
                                $debit = $forex->tot_amount;
                                $Sardebit = $debit / $SarRate;
                                $credit = "0";
                                $tot_debit += $Sardebit;
                            }
                            if($forex->types == 'CREDIT') {
                                $debit = "0";
                                $credit = $forex->tot_amount;
                                $Sarcredit = $credit / $SarRate;
                                $tot_credit += $Sarcredit;
                            }
                            $beneficiary = $forex->beneficiary;
                            $company = $forex->company;
                        @endphp
                        <tr>
                            <td style="color:#4c606a;width:5%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;height:25px;">{{$i}}</td>
                            <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{date("d-m-Y", strtotime($forex->txn_date))}}</td>
                            <td style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{html_entity_decode(stripslashes($forex->particularts))}}</td>
                            <td style="color:#4c606a;width:15%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{$forex->types == 'DEBIT' ? $debit : $credit}}</td>
                            <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ number_format($Sardebit,2)}}</td>
                            <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">{{ number_format($Sarcredit,2)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:right;height:25px;" colspan="4"></td>
                        <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;font-weight:bold;">{{ number_format($tot_debit,2)}}</td>
                        <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;font-weight:bold;">{{ number_format($tot_credit,2)}}</td>
                    </tr>
                    <tr>
                        <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:right;height:25px;" colspan="4">Balance</td>
                        <td style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:left;color:white;background-color:{{ 0 > ($tot_credit-$tot_debit) ? 'red' : 'green' }}" colspan="2"> {{number_format($tot_credit-$tot_debit,2)}}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="8" style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;padding-top:15px;color:red;">No List Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </body>
</html>