<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        /* Importing a beautiful Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
        }

        a:hover {
            background-color: #2980b9;
        }

        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Dear, {{ $customer->name }}</h2>
        <p>Congratulations! Your account has been activated successfully.</p>
        <p>You can now log in and access your account.</p>
        <p>Thank you for registering with us!</p>
        <p>Regards</p>
        <p>{{ __('tablevars.Rahat Travels of India') }}</p>
    </div>
</body>

</html>
