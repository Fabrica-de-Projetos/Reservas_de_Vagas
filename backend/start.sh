#!/bin/bash
until mysqladmin ping -h "$DB_HOST" -uroot -p"$DB_PASSWORD" --silent; do
  echo "Aguardando MySQL..."
  echo $DB_HOST
  echo $DB_PASSWORD
  sleep 2
done

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

apache2-foreground