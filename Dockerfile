FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    nginx \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Heroku PHP buildpack binaries
RUN curl --silent --location https://lang-php.s3.amazonaws.com/dist-heroku-22-stable/php-8.2.6.tar.gz | tar xz -C /app/
ENV PATH=/app/php/bin:/app/composer/bin:$PATH

# Ensure the /app directory exists before extracting the tarball
RUN mkdir -p /app && chmod -R 755 /app

# Debugging step to verify the /app directory
RUN ls -la /app

# Add user for application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# Copy application files
COPY . /var/www
COPY ./nginx.conf /etc/nginx/sites-enabled/default

# Set permissions
RUN chown -R www:www /var/www
RUN chmod +x /var/www/build.sh

# Change current user
USER www

# Expose port
EXPOSE 8080

# Start script
COPY ./docker-start.sh /var/www/docker-start.sh
RUN chmod +x /var/www/docker-start.sh
CMD ["/var/www/docker-start.sh"]
