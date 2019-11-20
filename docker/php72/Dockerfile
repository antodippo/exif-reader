FROM php:7.2-cli

RUN apt-get update
RUN apt-get install -y git zip unzip

RUN pecl channel-update pecl.php.net
RUN pecl install xdebug-2.8.0
RUN docker-php-ext-enable xdebug

RUN docker-php-ext-install exif

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_CACHE_DIR=/root/.composer/cache