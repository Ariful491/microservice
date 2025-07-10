FROM php:8.2.0-fpm-alpine


RUN apk update && apk add --no-cache \
    openssl \
    zip \
    unzip \
    git \
    oniguruma-dev


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN docker-php-ext-install pdo mbstring pdo_mysql


WORKDIR /app


COPY . .


RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000
