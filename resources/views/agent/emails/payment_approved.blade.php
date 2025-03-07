<!DOCTYPE html>
<html>
<head>
    <title>Payment Approved</title>
</head>
<body>
    <h1>Payment Approved</h1>
    <p>Dear Admin,</p>
    <p>The payment with the following details has been approved:</p>
    <ul>
        <li>Payment ID: {{ $payment->id }}</li>
        <li>Booking ID: {{ $booking->booking_id }}</li>
        <li>Amount: {{ $payment->amount }}</li>
        <li>Transaction ID: {{ $payment->txn_id }}</li>
        <li>Date: {{ $payment->txn_date }}</li>
    </ul>
</body>
</html>
