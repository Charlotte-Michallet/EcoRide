FROM php:8.3-fpm-alpine3.21

RUN apk update && apk upgrade && apk add --no-cache\
    openssl \
    openssl-dev \
    pkgconf \
    unzip \
    git \
    curl \
    libzip-dev \
    autoconf \
    build-base \
    ca-certificates

RUN pecl install mongodb-1.21.0 \
    && docker-php-ext-enable mongodb

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache mysql-client

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY config/php-custom.ini /usr/local/etc/php/conf.d/
WORKDIR /var/www/html
RUN git config --global --add safe.directory /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --prefer-dist

COPY ./config/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]