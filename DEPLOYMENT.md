# Deploying Blazer SOS to Render with SQLite

This document provides step-by-step instructions for deploying the Blazer SOS application to [Render](https://render.com) using SQLite as the database.

## Prerequisites

1. A Render account (sign up at https://render.com/)
2. Your code pushed to a GitHub repository
3. Basic understanding of Laravel applications

## Deployment Steps

### Step 1: Set up a Web Service on Render

1. Log in to your Render dashboard
2. Click on "Blueprints" in the left sidebar
3. Click "New Blueprint Instance"
4. Connect to your GitHub repository
5. Render will automatically detect your render.yaml file and create the web service

Alternatively, you can manually create the web service:

1. Log in to your Render dashboard
2. Click on the "New +" button and select "Web Service"
3. Connect your GitHub repository
4. Fill in the following details:
   - **Name**: `blazer-sos` (or your preferred name)
   - **Environment**: `PHP`
   - **Branch**: `main` (or your production branch)
   - **Build Command**: `./build.sh`
   - **Start Command**: `vendor/bin/heroku-php-nginx -C nginx.conf public/`
5. Under "Advanced" section, add a disk:
   - **Mount Path**: `/var/data`
   - **Name**: `sqlite-data`
   - **Size**: `1 GB`

### Step 2: Add Environment Variables

1. In the "Environment" section, add the following environment variables:
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `APP_KEY`: Generate with `php artisan key:generate --show` locally and copy the value
   - `APP_URL`: Will be automatically set by Render
   - `DB_CONNECTION`: `sqlite`
   - `DB_DATABASE`: `/var/data/database.sqlite`
   
2. If you're using Render's MySQL database service, the connection details will be automatically injected

3. Add the following mail settings (customize as needed):
   - `MAIL_MAILER`: `smtp`
   - `MAIL_HOST`: Your SMTP host
   - `MAIL_PORT`: Your SMTP port (usually 587 for TLS)
   - `MAIL_USERNAME`: Your SMTP username
   - `MAIL_PASSWORD`: Your SMTP password
   - `MAIL_ENCRYPTION`: `tls`
   - `MAIL_FROM_ADDRESS`: The email address to send from
   - `MAIL_FROM_NAME`: "Blazer SOS"

### Step 3: Deploy Your Application

1. Click "Create Web Service" to start the deployment process
2. Render will build and deploy your application
3. Once deployment is complete, you can access your application at the provided URL

### Step 5: Run Migrations and Seed Data (if needed)

If you need to run migrations manually after deployment:

1. In your Render dashboard, go to your web service
2. Navigate to the "Shell" tab
3. Run the following commands:
   ```
   php artisan migrate --force
   php artisan db:seed --force  # If you have seeders
   ```

## Maintenance and Updates

When you push new changes to your repository, Render will automatically redeploy your application with the latest code. If you need to make changes to the environment variables or other settings, you can do so from the Render dashboard.

## Troubleshooting

- **Application Error**: Check the logs in the Render dashboard
- **Database Connection Issues**: Verify that the database credentials are correct
- **Missing Assets**: Make sure `npm run build` is executing correctly in the build process

For more help, refer to Render's documentation at https://render.com/docs
