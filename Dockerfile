# Base PHP 8.2 + Apache
FROM php:8.2-apache

# Working directory
WORKDIR /var/www/html

# Install OS packages
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    git

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite
RUN docker-php-ext-enable pdo pdo_sqlite

# Enable Apache mod_rewrite for CodeIgniter 4
RUN a2enmod rewrite

# --- FIX PENTING UNTUK RENDER ---
# Pastikan folder writable/db sudah ada sebelum COPY
RUN mkdir -p /var/www/html/writable/db

# (Opsional) Buat file SQLite jika belum ada agar migrate tidak error
RUN touch /var/www/html/writable/db/documents.sqlite
RUN chmod 777 /var/www/html/writable/db/documents.sqlite

# Copy project
COPY . /var/www/html

# Permission untuk CI4 writable
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Jalankan migrate + seeder setelah container start
CMD ["bash", "-c", "php spark migrate --all && php spark db:seed DatabaseSeeder && apache2-foreground"]
