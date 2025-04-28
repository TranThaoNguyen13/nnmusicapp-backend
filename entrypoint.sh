#!/bin/bash
# Chạy migration
php artisan migrate --force

# Chạy ứng dụng
php-fpm