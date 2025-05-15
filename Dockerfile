FROM php:8.2-apache

# Install git, unzip dan ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin semua file ke direktori Laravel
COPY . /var/www/html/

WORKDIR /var/www/html

# Beri permission dan install dependency
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate

EXPOSE 80

