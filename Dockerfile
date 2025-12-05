# Gunakan PHP-FPM resmi
FROM php:8.2-fpm

# Install OS dependencies
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Jika ingin install ekstensi PHP lain (misal pdo_mysql)
# RUN docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 9000

# Command default
CMD ["php-fpm"]
