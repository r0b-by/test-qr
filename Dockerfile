# Gunakan PHP-FPM resmi
FROM php:8.2-fpm

# Install OS dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev unzip git curl libzip-dev libxml2-dev libonig-dev \
    && docker-php-ext-install pdo pdo_sqlite zip xml mbstring \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy semua termasuk vendor
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public"]
