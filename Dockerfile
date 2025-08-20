FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# Composer ইনস্টল করুন
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/frontend
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html
WORKDIR /var/www/html

# composer.json এবং composer.lock ফাইলগুলি কপি করার পরে Composer নির্ভরতা ইনস্টল করুন
# এই লাইনগুলো composer install এর ঠিক আগে থাকতে হবে
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 80