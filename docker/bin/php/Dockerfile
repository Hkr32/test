FROM php:8.2-fpm-buster

RUN apt-get update  \
    && apt-get install -y \
    && apt-get install -y libcurl4-openssl-dev \
    && apt-get install -y zip unzip \
    && docker-php-ext-install curl mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD composer install \
    && php -S 0.0.0.0:8000 -t ./public
