<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Invitation - Blazer SOS</title>
    <style>
        :root {
            --primary: #7A1518;
            --primary-dark: #5F0104;
            --primary-light: #9A382F;
            --accent: #D4B79F;
            --background-dark: #200000;
            --background-light: #F8F5F2;
            --text-light: #F8F5F2;
            --text-dark: #1A1A1A;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: var(--background-light);
        }
        .header {
            background-color: var(--primary);
            padding: 25px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header img {
            max-width: 120px;
            height: auto;
        }
        .header h1 {
            color: var(--text-light);
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
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: white !important;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: var(--primary-dark);
        }
        .details {
            margin-top: 30px;
            padding: 15px;
            background-color: var(--background-light);
            border-radius: 6px;
            font-size: 14px;
            border: 1px solid #eaeaea;
        }
        .details p {
            margin: 0 0 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 12px;
        }
        .note {
            padding: 15px;
            background-color: #fff8e1;
            border-left: 4px solid #ffb300;
            margin: 20px 0;
            color: #6d4c00;
            font-size: 14px;
            border-radius: 0 6px 6px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blazer SOS Staff Invitation</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            
            <p>You have been invited to join <strong>Blazer SOS</strong> as a <strong>{{ $invitation->role_name }}</strong>.</p>
            
            <p>Click the button below to create your account and get started:</p>
            
            <div class="btn-container">
                <a href="{{ $invitation->invitation_url ?? route('register.admin', ['token' => $invitation->token, 'email' => $invitation->email]) }}" class="btn">Create Your Account</a>
            </div>
            
            <div class="note">
                <p>This invitation link will expire in 48 hours. If you're unable to click the button, copy and paste the following URL into your browser:</p>
                <p style="word-break: break-all;">{{ $invitation->invitation_url ?? route('register.admin', ['token' => $invitation->token, 'email' => $invitation->email]) }}</p>
            </div>
            
            <div class="details">
                <p><strong>Email:</strong> {{ $invitation->email }}</p>
                <p><strong>Role:</strong> {{ $invitation->role_name }}</p>
                <p><strong>Date:</strong> {{ now()->format('F d, Y') }}</p>
            </div>
            
            <p>After registration, you will be able to access your administrative dashboard and manage the yearbook system.</p>
            
            <p>If you did not expect this invitation, please disregard this email.</p>
            
            <p>Thank you,<br>The Blazer SOS Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Blazer SOS. All rights reserved.</p>
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html> 