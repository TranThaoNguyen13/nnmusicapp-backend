#!/bin/bash

mkdir -p /var/www/html/storage/app/public/songs
chown -R www-data:www-data /var/www/html/storage/app/public/songs
chmod -R 775 /var/www/html/storage/app/public/songs
php artisan migrate --force
php artisan storage:link --force

# Khởi động PHP-FPM
php-fpm -D

# Khởi động Nginx
nginx -g "daemon off;"