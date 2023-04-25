FROM php:8.1-fpm-alpine

RUN apk --update add --no-cache postgresql-client postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql 

WORKDIR /var/www/html

EXPOSE 9001

CMD ["php", "-S", "0.0.0.0:9001"]
