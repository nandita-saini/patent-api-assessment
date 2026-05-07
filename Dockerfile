FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install intl pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev

EXPOSE 80