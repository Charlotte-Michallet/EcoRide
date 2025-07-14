FROM php:8.3-fpm-alpine3.21

RUN apk add --no-cache \
    openssl \
    openssl-dev \
    pkgconf \
    unzip \
    git \
    curl \
    libzip-dev \
    autoconf \
    build-base

RUN pecl install mongodb-1.18.0 \
    && docker-php-ext-enable mongodb

RUN docker-php-ext-install pdo pdo_mysql
    
RUN apk add --no-cache mysql-client

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN git config --global --add safe.directory /var/www/html

COPY . .

COPY ./config/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]