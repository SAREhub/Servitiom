FROM php:7.1-fpm-alpine
ENV APP_LOGGING_STREAM="/tmp/stdout"
RUN mkdir /app && chown www-data:www-data /app && \
    mkfifo $APP_LOGGING_STREAM && chmod 777 $APP_LOGGING_STREAM  && \
    docker-php-ext-install pdo pdo_mysql

COPY --chown=www-data:www-data vendor /app/vendor
COPY --chown=www-data:www-data src /app/src
COPY --chown=www-data:www-data index.php /app
USER www-data

CMD ["sh", "-o", "pipefail", "-c", "php-fpm -D | tail -f $APP_LOGGING_STREAM"]
