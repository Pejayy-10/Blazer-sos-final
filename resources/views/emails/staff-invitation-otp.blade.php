<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code for Staff Invitation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background: linear-gradient(135deg, #7A1518, #5F0104);
            padding: 25px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header img {
            max-width: 120px;
            height: auto;
        }
        .header h1 {
            color: white;
            margin: 0;
            padding: 10px 0;
            font-size: 24px;
        }
        .content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }
        .code-block {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 6px;
            color: #5F0104;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #7A1518, #5F0104);
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 15px;
        }
        .details {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-size: 14px;
        }
        .details p {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blazer SOS Staff Verification</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            
            <p>You have been invited to join <strong>Blazer SOS</strong> as a <strong>{{ $invitation->role_name }}</strong>. Please verify your email using the code below to complete your registration.</p>
            
            <div class="code-block">
                <div class="code">{{ $invitation->otp_code }}</div>
            </div>
            
            <p>After verification, you will be able to create your account and access your administrative dashboard.</p>
            
            <p>This code will expire in 15 minutes. If you did not request this invitation, please ignore this email.</p>
            
            <div class="details">
                <p><strong>Email:</strong> {{ $invitation->email }}</p>
                <p><strong>Role:</strong> {{ $invitation->role_name }}</p>
                <p><strong>Date:</strong> {{ now()->format('F d, Y') }}</p>
            </div>
            
            <p>Thank you,<br>The Blazer SOS Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Blazer SOS. All rights reserved.</p>
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html> 