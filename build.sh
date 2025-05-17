#!/bin/bash

# Exit on error
set -e

# Install PHP dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Generate application key if needed
php artisan key:generate --force

# Clear and cache configuration
php artisan config:clear
php artisan config:cache

# Cache routes and views
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Create storage symbolic link
php artisan storage:link

# Install NPM dependencies and build assets
npm ci --omit=dev
npm run build

# Set proper permissions for storage and bootstrap/cache
chmod -R 777 storage bootstrap/cache
chmod -R 777 public/storage

echo "Build completed successfully!"
