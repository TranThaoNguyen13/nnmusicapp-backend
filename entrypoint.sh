#!/bin/bash

# Chạy migration để tạo bảng sessions và các bảng khác
php artisan migrate --force

# Khởi động PHP-FPM
php-fpm -D

# Khởi động Nginx
nginx -g "daemon off;"