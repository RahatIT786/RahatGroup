<style type="text/css">
    body {
        font-family: Arial;
    }

    table.page_header {
        width: 100%;
        border: none;
        border-bottom: solid 1px #000;
    }

    table td {
        padding: 0px;
    }

    table.page_footer {
        width: 100%;
        background-color: #DDDDFF;
        border-top: solid 1mm #AAAADD;
        padding: 1mm;
    }

    h1 {
        color: #000033;
    }

    h2 {
        color: #000055;
    }

    h3 {
        color: #000077;
    }

    div.standard {
        width: 100%;
    }
</style>

<div style="margin:20px 20px 0px 20px;">
    <h2 style="color: #282828;font-weight: 400;margin: 0 auto 1px;font-family: Open Sans;text-align: center;">
        <b>Client Report</b>
    </h2>
    <hr style="border:0px;border-bottom: 1px solid #131313 !important;">
    <table width="100%" cellspacing="5" cellpadding="5" style="border-collapse:collapse;margin-top:15px;border: none;">
        <tr>
            <td style="width:50%;">
                <h2 style="color: #282828;font-weight: 400;margin: 0 auto 1px;font-family: Open Sans;">Booking Id :
                    {{ $clientData->booking->booking_id ?? '' }}</h2>
                <p>{{ $clientData->booking->agency->agency_name ?? '' }}<br>{{ $clientData->booking->agency->city ?? '' }}<br>{{ $clientData->booking->agency->mobile ?? '' }}
                </p>
            </td>
            <td style="width:50%;">
                <table width="100%" cellspacing="5" cellpadding="5"
                    style="border: 1px solid #b8cbd4;border-collapse:collapse;text-align:left;">
                    <tbody>
                        <tr>
                            <th
                                style="padding:6px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:Helvetica Neue;">
                                Service Type:
                            </th>
                            <td
                                style="padding:6px;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $clientData->booking->servicetype->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="padding:6px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:Helvetica Neue;">
                                Package Type
                            </th>
                            <td
                                style="padding:6px;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                Package : {{ $clientData->booking->package->name ?? '' }} <br>
                                Package type : {{ $clientData->booking->packagetype->package_type ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="padding:6px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:Helvetica Neue;">
                                Sharing Name
                            </th>
                            <td
                                style="padding:6px;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $clientData->booking->sharingtype->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="padding:6px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:Helvetica Neue;">
                                Travel Date
                            </th>
                            <td
                                style="padding:6px;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $clientData->booking->travel_date ? \App\Helpers\Helper::formatCarbonDate($clientData->booking->travel_date) : '' }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="padding:6px; line-height: 2.428571429;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:Helvetica Neue;">
                                Package Cost:
                            </th>
                            <td
                                style="padding:6px;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ $clientData->booking->tot_cost != '' ? number_format($clientData->booking->tot_cost, 2) : '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="5" cellpadding="5"
        style="border-collapse:collapse;margin-top:15px;border: none;">
        <tbody>
            @php
                $tot_debit = 0;
                $tot_credit = 0;
                $debit_balance1 = $clientData->booking->tot_cost;
            @endphp
            <tr>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                    Date
                </th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                    Booking Id
                </th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                    Payment ID
                </th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:25%;">
                    Particulars
                </th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                    Debit
                </th>
                <th
                    style="padding:6px; line-height: 2.428571429;border: 1px solid #b8cbd4;background-color:#000;color:#fff;font-size:14px;font-family:Helvetica Neue;text-align: center;width:15%;">
                    Credit
                </th>
            </tr>
            @foreach ($clientData->booking->payment as $payment)
                @php
                    $tot_debit += $payment->amount;
                    $debit_balance = $debit_balance1 - $tot_debit;
                @endphp
                <tr>
                    <th style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;"
                        scope="row">
                        {{ $payment->txn_date ? \App\Helpers\Helper::formatCarbonDate($payment->txn_date) : '' }}
                    </th>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $payment->booking->booking_id }}
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $payment->receipt_id }}
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ $payment->deposite_type }}
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                    </td>
                    <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                        {{ number_format($payment->amount, 2) }}
                    </td>
                </tr>
            @endforeach
            @php
                if (empty($debit_balance)) {
                    $tot_credit = $tot_credit;
                } else {
                    $tot_credit = $debit_balance - $tot_credit;
                }
            @endphp
            @if($clientData->booking->full_payment_discount > 0)
             <tr>
                <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;background-color:#f5f7f8;"
                colspan="4" align="right">Full Payment Discounts : </td>
                <td 
                    style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;background-color:#f5f7f8;color:#4c606a;">
                </td>
                <td
                    style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;background-color:#f5f7f8;color:#4c606a;">
                    {{ number_format($clientData->booking->full_payment_discount, 2) }}
                </td>
               
            </tr>
            @endif
            <tr>
                <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;background-color:#f5f7f8;"
                    colspan="4" align="right">Total : </td>
                <td
                    style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;background-color:#f5f7f8;color:#4c606a;">
                    {{ number_format($clientData->booking->tot_cost, 2) }}
                </td>
                <td
                    style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;background-color:#f5f7f8;color:#4c606a;">
                    {{ number_format($tot_debit + $clientData->booking->full_payment_discount, 2) }}
                </td>
            </tr>
           
            <tr>
                <td style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;"
                    colspan="5" align="right">Balance : </td>
                <td
                    style="padding:6px;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:white;background-color:red;">
                    {{ number_format($clientData->booking->tot_cost - $tot_debit - $clientData->booking->full_payment_discount , 2) }}
                </td>
            </tr>
        </tbody>
    </table>
    <p style="text-align: center;margin-top:15px;">This is a computer generated report.</p>
</div>
