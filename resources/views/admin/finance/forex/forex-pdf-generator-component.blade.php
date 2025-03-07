<!doctype html>
<html lang="en-us">

<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
    <title>Forex Details</title>
    <meta name="description" content="">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="background-color:#f2f2f2;">
    <h5
        style="color:#4c606a;text-align:center;font-family:Helvetica Neue ;margin: 10px 0;font-size: 14px;margin-top: 10px;margin-bottom: 10px;font-weight: 500;line-height: 1.1">
        Forex Details</h5>
    <table width="90%" cellspacing="5" cellpadding="5"
        style="border: 1px solid #b8cbd4;border-collapse: collapse;text-align:left;" cellspacing="0px" cellpadding="0px"
        ;>
        <thead>
            <tr>
                <th
                    style="padding:3px;text-align:center;width:5%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;height:30px;">
                    #</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Date</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Reference No</th>
                <th
                    style="padding:3px;text-align:center;width:20%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Beneficiary Name</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Company Name</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Amount</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Type</th>
                <th
                    style="padding:3px;text-align:center;width:15%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Bank Name</th>
                <th
                    style="padding:3px;text-align:center;width:10%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:10pxfont-family:verdana;">
                    Particulars</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($forexData as $forex)
                <tr>
                    <td
                        style="color:#4c606a;width:5%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;height:25px;">
                        {{ $i }}</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ Helper::formatCarbonDate($forex->txn_date ?? '---') }}</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->reference_no ?? '---' }}</td>
                    <td
                        style="color:#4c606a;width:20%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->beneficiary->beneficiary_name ?? '---' }}</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->company->company_name ?? '---' }}</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ number_format($forex->amount ?? '---') }}.00</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->types ?? '---' }}</td>
                    <td
                        style="color:#4c606a;width:15%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->bank_name ?? '---' }}</td>
                    <td
                        style="color:#4c606a;width:10%;border: 1px solid #b8cbd4;font-family:verdana;font-size:12px;text-align:center;">
                        {{ $forex->particularts ?? '---' }}</td>
                </tr>

                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>
