FROM php:7.4-apache

# System dependencies এবং PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Document root root folder এ
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Apache config update
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Composer ফাইল কপি করে dependency install
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --verbose

# বাকি project ফাইল কপি
COPY . .

EXPOSE 80
