FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    sqlite3 \
    libsqlite3-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip pdo_sqlite

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# ✅ Set Composer Auth environment variable (escaped JSON)
ENV COMPOSER_AUTH="{"http-basic": {"composer.fluxui.dev": {"username": "wtifbdn01@gmail.com", "password": "fda6d960-96ce-40f8-b0dc-63148f841e73"}}}"

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN php artisan key:generate || true

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 1000
CMD php artisan serve --host=0.0.0.0 --port=1000
