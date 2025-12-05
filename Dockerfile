# Gunakan PHP-FPM resmi
FROM php:8.2-fpm

# Install OS dependencies dan ekstensi PHP untuk CI4
RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev unzip git curl libzip-dev libxml2-dev libonig-dev \
    && docker-php-ext-install zip xml mbstring pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy seluruh project ke container (termasuk vendor)
COPY . .

# Set permissions agar www-data bisa akses file
RUN chown -R www-data:www-data /var/www/html

# Expose port Render
EXPOSE 8080

# Jalankan PHP built-in server di folder public
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /var/www/html/public"]
