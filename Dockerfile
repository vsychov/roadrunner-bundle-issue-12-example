FROM php:7.4-alpine

COPY --from=spiralscout/roadrunner:1.8.0 /usr/bin/rr /usr/bin/rr

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add postgresql-dev

RUN docker-php-ext-install sockets pdo_pgsql

WORKDIR /src

COPY composer.* /src/

RUN composer install

COPY . /src

CMD /usr/bin/rr serve -d