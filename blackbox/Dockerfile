FROM php:7.4-rc-apache AS base
RUN \
    apt-get update && \
    apt-get install -y zip unzip git && \
    true
ENV PATH="vendor/bin:${PATH}"
COPY --from=composer /usr/bin/composer /usr/bin/
WORKDIR /var/www/html
COPY composer.json composer.lock ./

FROM base AS build
RUN composer install --prefer-dist --no-suggest --no-dev --optimize-autoloader

FROM build AS dev
RUN composer install --no-suggest
# xdebug not yet supported on php 7.4
#RUN \
#    pecl install xdebug-2.6.0 && \
#    docker-php-ext-enable xdebug && \
#    true

FROM dev AS testing
# docker-php-ext-disable xdebug
CMD phpunit

FROM php:7.4-rc-apache AS production
WORKDIR /var/www/html
COPY --from=build . .