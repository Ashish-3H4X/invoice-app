# Stage 1 - Build Frontend (Vite + Tailwind)
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --frozen-lockfile
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel 12 + PHP 8.2)
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git curl unzip libpq postgresql-dev oniguruma-dev libzip-dev zip \
    supervisor bash \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app files
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader && \
    composer clear-cache

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache

# Copy supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear

EXPOSE 9000

CMD ["php-fpm"]