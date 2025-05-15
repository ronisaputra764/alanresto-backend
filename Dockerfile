# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy source code
COPY . .

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Laravel-specific
RUN composer install --no-dev --optimize-autoloader
RUN cp .env.example .env && php artisan key:generate

# Expose port
EXPOSE 80
