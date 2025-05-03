#!/bin/bash

mkdir -p /var/www/html/storage/app/public/songs
chown -R www-data:www-data /var/www/html/storage/app/public/songs
chmod -R 775 /var/www/html/storage/app/public/songs
chown -R www-data:www-data /var/www/html/storage/logs
chmod -R 775 /var/www/html/storage/logs
php artisan cache:clear
php artisan config:clear
php artisan migrate --force
php artisan storage:link --force
php-fpm -D
nginx -g "daemon off;"