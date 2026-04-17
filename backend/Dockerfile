FROM php:8.3-apache

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libzip-dev libpng-dev libonig-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Apache rewrite (Laravel precisa disso)
RUN a2enmod rewrite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data storage bootstrap/cache

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["/start.sh"]