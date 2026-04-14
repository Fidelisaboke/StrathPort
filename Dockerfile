FROM dunglas/frankenphp:1.4-php8.4-alpine

# Set environment variables for Puppeteer and Laravel
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true \
    PUPPETEER_EXECUTABLE_PATH=/usr/bin/chromium-browser \
    COMPOSER_ALLOW_SUPERUSER=1 \
    SERVER_NAME=:8080 \
    PUBLIC_ROOT=/app/public

# Install system dependencies
RUN apk add --no-cache \
    chromium \
    nss \
    freetype \
    harfbuzz \
    ca-certificates \
    ttf-freefont \
    nodejs \
    npm \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libzip-dev \
    postgresql-dev \
    git \
    unzip \
    bash \
    libcap

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        intl \
        zip \
        gd \
        opcache

# Install Redis extension
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps \
    && setcap -r /usr/local/bin/frankenphp \
    && apk del libcap

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Run composer autoloader and scripts
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies and build assets
RUN npm install \
    && npm run build \
    && rm -rf node_modules

# Set permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Production OPcache settings
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Expose port 8080
EXPOSE 8080

# The entrypoint is already set to frankenphp in the base image
