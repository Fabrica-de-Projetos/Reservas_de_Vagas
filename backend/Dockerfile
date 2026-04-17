FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]