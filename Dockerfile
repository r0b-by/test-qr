# Gunakan PHP-FPM resmi
FROM php:8.2-fpm

# Install OS dependencies + ekstensi PHP
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    git \
    curl \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_sqlite zip xml mbstring \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy seluruh project (termasuk vendor)
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 8080
EXPOSE 8080

# Jalankan PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public"]
