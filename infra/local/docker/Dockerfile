FROM php:8.2-fpm-alpine

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && docker-php-ext-enable opcache \
  && apk del pcre-dev ${PHPIZE_DEPS}

RUN apk --no-cache --update --repository https://dl-cdn.alpinelinux.org/alpine/v$ALPINE_VERSION/main/ add \
    postgresql-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql

COPY . /app
RUN chown -R www-data:www-data /app/storage
