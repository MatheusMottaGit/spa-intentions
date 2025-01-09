FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    git \
    zip \
    unzip \
    curl \
    libbz2-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-install bcmath mbstring pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

RUN npm install

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php" ,"artisan" ,"serve","--host=0.0.0.0", "--port=8000"]
