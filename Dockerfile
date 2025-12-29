FROM php:8.2-cli

#Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

#Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-progress

COPY . .

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
