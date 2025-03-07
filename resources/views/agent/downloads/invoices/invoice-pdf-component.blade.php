<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .invoice-header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-header div {
            display: table-cell;
            vertical-align: middle;
        }

        .invoice-header img {
            max-width: 150px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #61146b;
            text-align: left;
            padding: 8px;
            color: #ffffff;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .particulars-table td {
            text-align: left;
        }

        .note, .cancellation-policy {
            font-size: 12px;
            margin-top: 20px;
        }

        ul {
            padding-left: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    {{-- @php
    if($logo != '') {
        $logoSrc = Helper::imageForPDF($logo, 'company_logo');
    }else{
        $logoSrc = Helper::imageForPDF(null, null, 'img/agent/logo_1.svg');
    } 
    @endphp --}}
    @php
        $logoSrc = !empty($logo) ? Helper::imageForPDF($logo, 'company_logo') : null;
    @endphp
  <h1 style="text-align: center; color:#0e1555; margin:0px 0px 15px;">Invoice</h1>
  <div style="height:8px;background:#b9910d; margin:0px 0px 15px;"></div>
    <div class="invoice-header">
        <div style="width: 25%; padding-right: 20px;">
            <img src="{{ $logoSrc }}" alt="Company Logo">
        </div>
        <div style="width: 75%;">
            <h2 style="margin:0px 0px 8px;color:#61146b;">{{ $agency ?? 'Agency Name' }}</h2>
            <h3 style="margin:0px 0px 8px;color:#480e50;">Agent: {{ $agent_name ?? 'N/A' }}</h3>
            <h5 style="margin:0px 0px 8px;color:#34093a;">
                Website: {{ $agency_website ?? 'N/A' }} |
                Email: {{ $agency_mail ?? 'N/A' }} |
                Tel: {{ $agency_tel ?? 'N/A' }}
            </h5>
            <h5 style="margin:0px;color:#411132;">{{ $agency_address ?? 'No Address Provided' }}</h5>
        </div>
    </div>
    <table>
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <p><strong style="margin:0px 0px 8px;color:#480e50;">{{ ucfirst($meheram_name) }}</strong></p>
                <p>
                    {{ $meheram_address ? $meheram_address . ', ' : '' }}
                    {{ $meheram_contact ? $meheram_contact . ', ' : '' }}
                    {{ $meheram_email ?? '' }}
                </p>
                <p><strong style="margin:0px 0px 8px;color:#480e50;">Travel Date:</strong> {{ Helper::formatCarbonDate($travel_date) }}</p>
                <p><strong style="margin:0px 0px 8px;color:#480e50;">PAX:</strong> {{ $total_pax }}
                    (Adults: {{ $adult }}{{ $children ? ', Children: ' . $children : '' }}{{ $infant ? ', Infants: ' . $infant : '' }})
                </p>
            </td>
            <td style="width: 40%; vertical-align: top;">

                <table style="width: 100%; border: none;">
                    <tr>
                        <th style="width: 50%;background:#146b40;">Dated:</th>
                        <td>{{ Helper::formatCarbonDate($date) }}</td>
                    </tr>
                    <tr>
                        <th style="background:#146b40;">Booking ID:</th>
                        <td>{{ $booking_id }}</td>
                    </tr>
                    <tr>
                        <th style="background:#146b40;">Payment ID:</th>
                        <td>{{ $payment_ids }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="particulars-table">
        <tr>
            <th>Particulars</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td><strong style="color:#480e50;">Towards:</strong></td>
            <td>Rs. {{ number_format($total_cost, 2) }}</td>
        </tr>
        <tr>
            <td><strong style="color:#480e50;">Package:</strong> {{ $package_name }}</td>
            <td></td>
        </tr>
        <tr>
            <td><strong style="color:#480e50;">Sharing:</strong> {{ $sharingtype }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: right;"><strong style="color:#480e50;">Total</strong></td>
            <td>Rs. {{ number_format($total_cost, 2) }}</td>
        </tr>
    </table>

    <div class="note">
        <p style="font-size:20px;color:#197e40;margin:0px 0px 8px;"><strong>Important Note:</strong></p>
        <ul>
            <li>All Departure dates are tentative and a + or - of 2 to 3 days is possible.</li>
            <li>Any Increase in Saudi Riyal / Visa / Ticket will have to be paid before Departure.</li>
            <li>All tours are Subject to Visa Availability by Saudi Government.</li>
            <li>In Case Visa is Not Available Advance will be Refunded after deducting Processing Charges.</li>
            <li>Guests & Relatives of Hajis are NOT ALLOWED to Stay or Eat in our Hotel under any Circumstances.</li>
            <li>Room Service & House Keeping is Not Included in Package Cost.</li>
            <li>If you travel individually other than group dates, you will bear the additional transportation charges as per your itinerary.</li>
            <li>Additional stay other than group would be charged extra.</li>
            <li>No refund in case of unused services or lesser duration of stay.</li>
            <li>Extra luggage other than mentioned on ticket would be paid by the pilgrim.</li>
            <li>Coolie Services are Note Included / Everyone carries their own Luggage.</li>
            <li>Tips to Drivers or Waiters Not Included in Package Cost.</li>
            <li>We are not responsible for Waiting time at Airport / Hotel Reception due to Difference in Check-in and Check-out time of the Hotel in Comparison to Flight Arrival or Departure Time.</li>
        </ul>
    </div>

    <div class="cancellation-policy">
        <p style="font-size:20px;color:#197e40;margin:0px 0px 8px;"><strong>Cancellation Policy:</strong></p>
        <ul>
            <li>10,000/- per person is NON REFUNDABLE.</li>
            <li>50% of the tour cost if cancelled between 15 to 30 days before departure.</li>
            <li>NO REFUND if cancelled within 15 days of departure.</li>
            <li>Date Change Penalty 5000/- per person if made between 15 to 30 days before departure or else the above cancellations shall apply.</li>
        </ul>
    </div>

    <p class="footer">This is a computer-generated invoice.</p>
</body>

</html>
