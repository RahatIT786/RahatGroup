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
        padding: 1mm
    }

    h1 {
        color: #000033
    }

    h2 {
        color: #000055
    }

    h3 {
        color: #000077
    }

    div.standard {
        width: 100%;
    }
</style>
<table style="width:99%;background-color:white;">
    <tbody>
        <tr>
            <td>
                <h2 style="color:#4c606a;text-align:center;font-family:'arial', sans-serif;margin: 10px 0;">
                    {{ $agency }}</h2>
                <h5
                    style="color:#4c606a;text-align:center;font-family:arial ;margin: 10px 0;font-size: 14px;margin-top: 10px;
                margin-bottom: 10px;font-weight: 500;line-height: 1.1">
                    Website : {{ $agency_website }} :: Email : {{ $agency_mail }} :: Tel :
                    {{ $agency_tel }}</h5>
                <h5
                    style="text-align:center;color:#4c606a;font-family:arial ;margin: 10px 0;font-size: 14px;margin-top: 	10px;
            margin-bottom: 10px;font-weight: 500;line-height: 1.1">
                    {{ $agency_address }}</h5>
                <h1
                    style="color:#4c606a;font-size:28px;font-family:arial ;margin: 10px 0;margin-left:15px;margin-top: 10px;
        margin-bottom: 10px;font-weight: 500;line-height: 1.1">
                    Receipt</h1>
                {{-- <table width="80%" cellspacing="5" cellpadding="5"
                        style="border: 1px solid #b8cbd4;border-collapse: collapse;margin-left:17px;margin-right:15px;text-align:left;"
                        cellspacing="0px" cellpadding="0px" ;>
                        <tbody>
                            <tr>
                                <td style="width:35%;"> --}}
                <table width="40%" cellspacing="5" cellpadding="5"
                    style="border: 1px solid #b8cbd4;border-collapse:collapse;margin-left:17px;margin-top:50px;margin-right:15px;"
                    cellspacing="0px" cellpadding="0px" ;>
                    <tbody>
                        <tr>
                            <th
                                style="padding:3px;text-align:left; line-height: 1;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:arial;">
                                Dated:</th>
                            <td
                                style="padding:3px;text-align:left;width:60% ;font-family:verdana;font-size:14px;border: 1px solid #b8cbd4;color:#4c606a;">
                                {{ Helper::formatCarbonDate($transaction_date) }}</td>
                        </tr>
                        <tr>
                            <th
                                style="padding:3px;text-align:left; line-height: 1;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:arial;">
                                Booking ID:</th>
                            <td
                                style="padding:3px;text-align:left;width:60% ;border: 1px solid #b8cbd4;font-family:verdana;font-size:14px;">
                                {{ $booking_id }}</td>
                        </tr>
                        <tr>
                            <th
                                style="padding:3px;text-align:left; line-height: 1;width:40%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:14px;font-family:arial;">
                                Receipt No: </th>
                            <td
                                style="padding:3px;text-align:left;width:60% ;border: 1px solid #b8cbd4;color:#4c606a;font-family:verdana;font-size:14px;">
                                {{ $receipt_id }}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- </td>
                            </tr>
                        </tbody>
                    </table> --}}
                <table width="100%" cellspacing="5" cellpadding="5"
                    style="border: 1px solid #b8cbd4;border-collapse: 		collapse;margin-left:17px;margin-top:50px;margin-right:15px;"
                    cellspacing="0px" cellpadding="0px" ;>
                    <tbody>
                        <tr>
                            <th
                                style="padding-left:35px;text-align:left; line-height: 1.428571429;width:65%;border: 1px solid #b8cbd4;background-color:#f5f7f8;font-size:13px;font-family:arial;color:#4c606a;">
                                Particulars:</th>
                            <th
                                style="background-color:#f5f7f8;text-align:left;padding-left:35px;width:30% ;font-size:13px;font-family:arial;border: 1px solid #b8cbd4;color:#4c606a;">
                                Amount</th>
                        </tr>
                        <tr>
                            <td
                                style="padding-left:35px;color:#4c606a;line-height: 1.428571429;width:65%;border: 1px solid #b8cbd4;font-family:verdana;font-size:14px;">
                                Deposit Type: {{ $deposite_type }}</td>
                            <td
                                style=";padding-left:35px;width:30% ;color:#4c606a;border: 1px solid #b8cbd4;font-family:verdana;font-size:14px;font-family:verdana;font-size:14px;">
                                Rs. {{ number_format($amount) }}.00 </td>
                        </tr>
                        <tr>
                            <td
                                style="padding-left:35px;width:65%;border: 1px solid #b8cbd4;color:#4c606a; line-height: 1.428571429;font-family:verdana;font-size:14px;">
                                Transaction No: : {{ $tnx_id }}</td>
                            <td style="padding-left:35px;width:30%color:#4c606a; ;border: 1px solid #b8cbd4;"></td>
                        </tr>
                        <tr>
                            <td
                                style="padding-left:35px;width:65%;border: 1px solid #b8cbd4;text-align:right; line-height: 1.428571429;color:#4c606a;font-family:verdana;font-size:14px;">
                                Total </td>
                            <td
                                style="padding-left:35px;color:#4c606a;width:30% ;border: 1px solid #b8cbd4;font-family:verdana;font-size:14px;">
                                Rs. {{ number_format($amount) }}.00 </td>
                        </tr>
                    </tbody>
                </table>
                <p style="margin-left:17px;margin-top:50px;font-size:16px;color:#4c606a;font-family:verdana">
                    Important Note :</p>
                <ul>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">All Departure
                            dates are tentative and a + or - of 2 to 3 days is possible.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Any Increase in
                            Saudi Riyal / Visa / Ticket will have to be paid before Departure.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">All tours are
                            Subject to Visa Availabiity by Saudi Government.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">In Case Visa is
                            Not Available Advance will be Refunded after deducting Processing Charges.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Guests &
                            Relatives of Hajis are NOT ALLOWED to Stay or Eat in our Hotel under any Circumstances
                        </p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Room Service &
                            House Keeping is Not Included in Package Cost</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">If you travel
                            individually other than group dates, you will bear the additional transportation charges
                            as per your itinerary.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Additional stay
                            other than group would be charged extra.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">No refund in
                            case of unused services or lesser duration of stay.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Extra luggage
                            other than mentioned on ticket would be paid by the pilgrim.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Coolie Services
                            are Note Included / Everyone carries their own Luggage.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Tips to Drivers
                            or Waiters Not Included in Package Cost</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">We are not
                            responsible for Waiting time at Airport / Hotel Reception due to Difference in Checkin
                            and Check Out time of the Hotel in Comparison to Flight Arrival or Departure Time.</p>
                    </li>
                </ul>
                <p style="margin-left:17px;margin-top:50px;font-size:16px;color:#4c606a;font-family:verdana">
                    Cancellation Policy : </p>
                <ul>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">10,000/- per
                            person is NON REFUNDABLE.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">50% of the tour
                            cost if cancelled between 15 to 30 days before departure.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">NO REFUND if
                            cancelled within 15 days of departure.</p>
                    </li>
                    <li>
                        <p style="font-size:10px;color:#4c606a;margin:0px auto;font-family:verdana;">Date Change
                            Penalty 5000/- per person if made between 15 to 30 days before departure or else the
                            above cancellations shall apply.</p>
                    </li>
                </ul>
                <p style="text-align:center;font-size:11px;color:#4c606a;margin:0px auto;font-family:verdana;">This
                    is a computer generated invoice. </p>
            </td>
        </tr>
    </tbody>
</table>
