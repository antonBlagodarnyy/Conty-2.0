FROM php:8.2-apache as php

RUN apt-get update -y

RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev

RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN apt-get install nano

RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \

&& apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chmod +x /docker/entrypoint.sh

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-dev --optimize-autoloader

RUN rm -rf node_modules package-lock.json

RUN apt-get clean

ENV PORT=8000

ENTRYPOINT [ “docker/entrypoint.sh” ]