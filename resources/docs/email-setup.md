# Email Configuration Guide for Blazer SOS

This guide will help you set up email functionality for Blazer SOS using Gmail SMTP, which is required for sending admin invitations, verification emails, and other system notifications.

## Setting up Gmail for SMTP

### Step 1: Create or use a Gmail account

Choose a Gmail account to use for sending emails from your application. For security and management purposes, we recommend creating a dedicated Gmail account for your application.

### Step 2: Enable 2-Step Verification

1. Log in to your Gmail account
2. Go to your Google Account settings (click on your profile picture and select "Manage your Google Account")
3. Select "Security" from the left sidebar
4. Under "Signing in to Google," find "2-Step Verification" and turn it on
5. Follow the steps to complete the setup

### Step 3: Generate an App Password

Once 2-Step Verification is enabled:

1. Go back to the "Security" section of your Google Account
2. Find "App passwords" under the "Signing in to Google" section
3. You may need to verify your password
4. In the "Select app" dropdown, choose "Mail"
5. In the "Select device" dropdown, choose "Other" and enter "Blazer SOS"
6. Click "Generate"
7. Google will display a 16-character app password (with spaces)
8. **Important:** Copy this password somewhere secure. You'll need to remove the spaces when adding it to your `.env` file

### Step 4: Configure your `.env` file

Update your `.env` file with the following settings:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=yourgeneratedapppasswordwithoutspaces
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="Blazer SOS"
```

**Note:** When entering the app password, remove all spaces from the password Google provided.

### Step 5: Test your configuration

After setting up your email configuration, you can test it by:

1. Using the "Invite Admin" feature in the SuperAdmin dashboard
2. Check if the email is sent successfully
3. Verify the inbox of the invited email address

## Troubleshooting

If emails are not being sent:

1. **Double-check your `.env` file settings**:
   - Ensure your Gmail username and app password are correct
   - Make sure there are no spaces in the app password
   - Confirm that the MAIL_FROM_ADDRESS is the same as your MAIL_USERNAME

2. **Check server requirements**:
   - Ensure your server allows outgoing connections to smtp.gmail.com on port 587
   - Some hosting providers block outgoing SMTP connections

3. **Consider queue configuration**:
   - For production, consider setting `QUEUE_CONNECTION=database` in your `.env` file
   - Run `php artisan queue:work` to process emails in the background

4. **Check Laravel logs**:
   - Look at `storage/logs/laravel.log` for any email-related errors

## Alternative Email Providers

If Gmail doesn't work for your needs, Blazer SOS also supports:

- Mailgun
- Amazon SES
- Postmark
- SendGrid (via SMTP)

Refer to the [Laravel Mail documentation](https://laravel.com/docs/mail) for more information on configuring these services. 