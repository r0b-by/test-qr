FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html
COPY . .

RUN mkdir -p writable/cache writable/logs writable/session writable/uploads writable/database \
    && chmod -R 777 writable

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]