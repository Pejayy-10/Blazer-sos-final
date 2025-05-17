<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #5F0104, #7A1518);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px 25px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #D4B79F, #C09A78);
            color: #5F0104;
            font-weight: bold;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .button:hover {
            background: linear-gradient(135deg, #C09A78, #A67C52);
        }
        .footer {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #eaeaea;
        }
        .link {
            word-break: break-all;
            color: #5F0104;
            text-decoration: underline;
        }
        .note {
            background-color: #f9f6f2;
            padding: 15px;
            border-left: 4px solid #D4B79F;
            margin: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>
        
        <div class="content">
            <p>Hello {{ $user->first_name }},</p>
            
            <p>You recently requested to reset your password for your Blazer SOS account. Click the button below to reset it:</p>
            
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="button">Reset Your Password</a>
            </div>
            
            <div class="note">
                <p><strong>Note:</strong> This password reset link will expire in 60 minutes.</p>
                <p>If you did not request a password reset, please ignore this email or contact support if you have concerns.</p>
            </div>
            
            <p>If the button above doesn't work, copy and paste the following link into your browser:</p>
            <p class="link">{{ $resetUrl }}</p>
            
            <p>Thank you,<br>The Blazer SOS Team</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Blazer SOS. All rights reserved.</p>
            <p>This email was sent automatically from our system. Please do not reply.</p>
        </div>
    </div>
</body>
</html> 