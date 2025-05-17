<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #7A1518, #5F0104);
            padding: 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 5px;
            margin: 30px 0;
            color: #5F0104;
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 4px;
            display: inline-block;
        }
        .note {
            font-size: 14px;
            color: #666;
            margin-top: 30px;
            font-style: italic;
        }
        .footer {
            background-color: #f3f4f6;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #5F0104;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #7A1518;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blazer SOS - Email Verification</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $user->first_name }}!</h2>
            <p>Thank you for registering with Blazer SOS. To complete your registration, please use the verification code below:</p>
            
            <div class="code">{{ $user->otp_code }}</div>
            
            <p>Enter this code on the verification page to activate your account.</p>
            <p>This code will expire in 15 minutes.</p>
            
            <div class="note">
                If you did not create an account with Blazer SOS, please disregard this email.
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Blazer SOS. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html> 