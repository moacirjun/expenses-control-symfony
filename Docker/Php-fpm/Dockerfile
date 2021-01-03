FROM php:fpm-alpine
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/app

RUN adduser -S -D -h /home/master --shell /bin/bash -g "$GROUP_ID" -u "$USER_ID" master
USER master

CMD composer install; php-fpm
EXPOSE 9000
