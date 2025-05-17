#!/bin/bash

# Make sure storage and bootstrap/cache directories are writable
chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Run heroku-php-nginx for Render deployment
cd /var/www
vendor/bin/heroku-php-nginx -C nginx.conf public/
