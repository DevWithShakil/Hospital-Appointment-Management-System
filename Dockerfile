FROM php:7.4-apache

# সিস্টেমের প্রয়োজনীয় প্যাকেজ এবং PHP এক্সটেনশন ইনস্টল করুন
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# Composer ইনস্টল করুন
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/frontend

# Apache এর ডকুমেন্ট রুট কনফিগার করুন
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html # ওয়ার্কিং ডিরেক্টরি সেট করুন

# শুধুমাত্র composer ফাইলগুলি কপি করুন এবং নির্ভরতা ইনস্টল করুন
# এটি ক্যাশিং এর জন্য ভালো এবং নিশ্চিত করে যে ফাইলগুলি উপস্থিত আছে
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --verbose

# বাকি প্রজেক্ট ফাইলগুলি কপি করুন
COPY . /var/www/html

EXPOSE 80