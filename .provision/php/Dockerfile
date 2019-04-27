FROM php:7.1-fpm
RUN docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update \
    && apt-get upgrade --yes \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        zip

WORKDIR /var/www/html