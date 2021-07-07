FROM php:7.3-fpm

RUN apt update && \
apt -y install wget git libzip-dev unzip

RUN docker-php-ext-install pdo pdo_mysql zip

RUN pecl install xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/jumia_phonebook
