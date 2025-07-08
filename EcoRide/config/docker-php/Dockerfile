FROM php:8.3.23-fpm-alpine3.21

RUN apk add --no-cache \
    openssl \
    openssl-dev \
    pkgconf \
    unzip \
    git \
    curl \
    libzip-dev \
    autoconf \
    build-base\
    re2c

RUN docker-php-ext-install pdo_mysql zip

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -rf /tmp/pear \
    && apk del openssl-dev pkgconf unzip git curl libzip-dev autoconf build-base re2c

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

EXPOSE 9000

CMD ["php-fpm"]
