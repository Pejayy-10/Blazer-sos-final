#!/bin/bash

# Exit on error
set -e

echo "💫 Running Blazer SOS Deployment Pre-Check..."
echo "--------------------------------------------"

# Check PHP version
echo -n "✅ Checking PHP version: "
php -v | head -n 1
echo ""

# Check Composer installation
echo -n "✅ Checking Composer version: "
composer --version
echo ""

# Check Node.js installation
echo -n "✅ Checking Node.js version: "
node --version
echo ""

# Check NPM installation
echo -n "✅ Checking NPM version: "
npm --version
echo ""

# Validate composer.json
echo "✅ Validating composer.json"
composer validate --no-check-all --no-check-publish
echo ""

# Check for required files
echo "✅ Checking for required files:"
REQUIRED_FILES=(".env.production" "Dockerfile" "nginx.conf" "Procfile" "build.sh")
for file in "${REQUIRED_FILES[@]}"; do
  if [ -f "$file" ]; then
    echo "   - $file: Found"
  else
    echo "   - $file: NOT FOUND (Required for deployment)"
    exit 1
  fi
done
echo ""

# Check environment variables in .env.production
echo "✅ Checking .env.production for required variables:"
REQUIRED_ENV_VARS=("APP_KEY" "APP_ENV" "APP_DEBUG" "APP_URL" "DB_CONNECTION" "DB_HOST" "LOG_LEVEL" "MAIL_MAILER")
for var in "${REQUIRED_ENV_VARS[@]}"; do
  if grep -q "^$var=" .env.production; then
    echo "   - $var: Found"
  else
    echo "   - $var: NOT FOUND (Required for deployment)"
  fi
done
echo ""

# Check Laravel configuration
echo "✅ Running Laravel configuration check:"
php artisan config:clear
php artisan config:cache --env=production
echo ""

# Run optimization commands
echo "✅ Running Laravel optimization commands:"
php artisan optimize
echo ""

# Clean up
php artisan config:clear
echo ""

echo "✅ Pre-check complete! Your application is ready for deployment."
echo "📝 Please follow the instructions in DEPLOYMENT.md to deploy to Render."
