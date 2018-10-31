FROM composer:1.7.2 AS composer_install
WORKDIR /app
COPY composer.json .
RUN composer global require hirak/prestissimo
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-suggest --ignore-platform-reqs

FROM php:7.1-fpm-alpine
ENV APP_LOGGING_STREAM="/tmp/stdout"
RUN docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache  --virtual .phpize-deps $PHPIZE_DEPS && \
    pecl install apcu-5.1.12  && \
    docker-php-ext-enable apcu && \
    rm -rf /tmp/pear && \
    apk del .phpize-deps

RUN mkdir /app && chown www-data:www-data /app && \
    mkfifo $APP_LOGGING_STREAM && chmod 777 $APP_LOGGING_STREAM
WORKDIR /app
COPY --chown=www-data:www-data --from=composer_install /app/ .
COPY --chown=www-data:www-data src ./src
COPY --chown=www-data:www-data index.php .
COPY --chown=www-data:www-data doctrinecli.php .
USER www-data
RUN php doctrinecli.php orm:generate-proxies
CMD ["sh", "-o", "pipefail", "-c", "php-fpm -D | tail -f $APP_LOGGING_STREAM"]
