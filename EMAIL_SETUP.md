# Email Verification Setup Guide

This guide explains how to configure Blazer SOS to use Gmail SMTP for sending verification emails and OTP codes.

## Gmail SMTP Configuration

### Step 1: Create or Use an Existing Gmail Account

You'll need a Gmail account to send emails from. You can use an existing account or create a new one specifically for your application.

### Step 2: Enable 2-Step Verification

Gmail requires 2-Step Verification to be enabled before you can generate an App Password:

1. Go to your [Google Account](https://myaccount.google.com/).
2. Select **Security** from the left navigation panel.
3. Under "Signing in to Google," select **2-Step Verification**.
4. Follow the steps to turn on 2-Step Verification.

### Step 3: Generate an App Password

1. Go to your [Google Account](https://myaccount.google.com/).
2. Select **Security** from the left navigation panel.
3. Under "Signing in to Google," select **App passwords**.
4. Select **App** and choose "Other (Custom name)".
5. Enter a name like "Blazer SOS" and click **Generate**.
6. Google will display a 16-character password. Copy this password.

### Step 4: Configure Environment Variables

Update your `.env` file with the following settings:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=wmsublazersos@gmail.com
MAIL_PASSWORD=qixh qzsj byas sges
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=wmsublazersos@gmail.com
MAIL_FROM_NAME="Blazer SOS"
```

Replace:
- `your-gmail@gmail.com` with your Gmail address
- `your-app-password` with the 16-character App Password you generated

## Testing the Email Configuration

After setting up the Gmail SMTP configuration, you can test it using the built-in command:

```bash
php artisan otp:test user@example.com
```

Replace `user@example.com` with an email of an existing user in your system. This command will:

1. Generate a new OTP for the user
2. Send the OTP to the user's email
3. Confirm whether the email was sent successfully

If the email fails to send, check:
1. Your Gmail credentials
2. Make sure the App Password is entered correctly
3. Verify that outbound SMTP connections are allowed by your server/network

## How Email Verification Works

### Registration Flow
1. User registers with email and password
2. System generates a 6-digit OTP code
3. OTP is sent to the user's email
4. User is redirected to the verification page
5. User enters the OTP code from their email
6. If the OTP is correct, the account is marked as verified

### Login Flow
1. If the user tries to log in but isn't verified:
   - The system sends a new OTP code to their email
   - The user is redirected to the verification page
   - The user must enter the OTP to verify their account before proceeding

## Troubleshooting

### Gmail SMTP Limitations

- Gmail has a sending limit of 500 emails per day for regular accounts
- For higher volume, consider using a service like SendGrid, Mailgun, or Amazon SES

### Common Issues

1. **"Connection could not be established with host smtp.gmail.com"**
   - Check your server's outbound connection to port 587
   - Verify your firewall allows this connection

2. **"Username and Password not accepted"**
   - Make sure you're using an App Password, not your regular Gmail password
   - Verify the App Password was copied correctly (no extra spaces)

3. **"Email not being received"**
   - Check spam/junk folders
   - Verify the recipient email is entered correctly
   - Ensure your Gmail account isn't temporarily restricted 