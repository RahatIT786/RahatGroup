<!DOCTYPE html>
<html>
<head>
    <title>Payment Offline Confirmation</title>
</head>
<body>
    <h1>Payment Offline Confirmation</h1>
    <p>Dear {{ $bookingData->personName }},</p>
    
    <p>We have received your offline payment for the booking #{{ $bookingData->booking_id }}.</p>
    
    <p><strong>Payment Details:</strong></p>
    <ul>
        <li>Payment Amount: {{ number_format($paymentData->amount, 2) }}</li>
        <li>Deposit Type: {{ $paymentData->deposite_type }}</li>
        <li>Transaction ID: {{ $paymentData->txn_id }}</li>
        <li>Transaction Date: {{ $paymentData->txn_date }}</li>
        <li>Company: {{ $paymentData->company }}</li>
    </ul>
    
    <p>Thank you for your payment!</p>
</body>
</html>
