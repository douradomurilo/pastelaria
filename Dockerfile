FROM php:8.2.7-fpm-bullseye

#FROM php:7.3-fpm-alpine

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    apt-utils \
    vim \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install zip iconv pcntl gd fileinfo

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .