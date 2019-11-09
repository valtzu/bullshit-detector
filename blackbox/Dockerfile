FROM php:7.4-rc-apache AS base
WORKDIR /var/www/html
RUN apt-get update && apt-get install sudo -y
RUN a2enmod rewrite
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
ENTRYPOINT ["docker-entrypoint"]


# Build image
FROM base AS build
RUN \
    apt-get update && \
    apt-get install -y zip unzip git && \
    true
COPY --from=composer /usr/bin/composer /usr/bin/
COPY composer.* ./
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --prefer-dist --no-suggest --no-dev --optimize-autoloader


# Dev image. Using build as base to prevent double-loading composer dependencies
FROM build AS dev
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-suggest
CMD apache2-foreground

# Testing image
FROM dev AS testing
CMD vendor/bin/phpunit


# Production image
FROM base AS production
COPY --from=build --chown=www-data . .
CMD apache2-foreground
