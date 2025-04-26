#!/bin/bash
# Chạy migration
php artisan migrate --force

# Chạy ứng dụng
php artisan serve --host 0.0.0.0 --port 10000