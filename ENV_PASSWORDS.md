# Working with Passwords in .env Files

## Handling Passwords with Spaces

When using passwords with spaces in your `.env` file, you must enclose them in quotes. This is especially important for app passwords from services like Gmail.

### Example Format:

```
# Without spaces (regular password)
MAIL_PASSWORD=yoursecretpassword123

# With spaces (needs quotes)
MAIL_PASSWORD="qixh qzsj byas sges"
```

### Fixing the .env File

If you're having issues with your password containing spaces, you have two options:

#### Option 1: Manually Edit the .env File
Open the `.env` file in a text editor and add quotes around the password:

```
MAIL_PASSWORD="qixh qzsj byas sges"
```

#### Option 2: Update via PowerShell
If using PowerShell, you can update the file with:

```powershell
(Get-Content .env) -replace 'MAIL_PASSWORD=old_password', 'MAIL_PASSWORD="new password with spaces"' | Set-Content .env
```

## Testing Email Configuration

After setting up your email credentials, test if they work correctly:

```
php artisan otp:test your-email@example.com
```

This will send a test OTP to the specified email. 