# Sử dụng image PHP chính thức với phiên bản PHP phù hợp (Laravel 11 yêu cầu PHP 8.2 trở lên)
FROM php:8.2-fpm

# Cài đặt các tiện ích cần thiết và Nginx
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    nginx \
    && docker-php-ext-install pdo pdo_mysql

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy mã nguồn vào container
WORKDIR /var/www/html
COPY . .

# Cài đặt dependencies của Laravel
RUN composer install --optimize-autoloader --no-dev

# Tạo file .env nếu chưa có
RUN cp .env.example .env || echo "APP_NAME=Laravel\nAPP_ENV=production\nAPP_KEY=\nAPP_DEBUG=false\nAPP_URL=https://nnmusicapp-backend.onrender.com\nSESSION_DRIVER=database" > .env

# Tạo khóa ứng dụng
RUN php artisan key:generate

# Cấp quyền cho thư mục storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy file cấu hình Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Copy và cấp quyền cho entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Mở cổng 80
EXPOSE 80

# Chạy ứng dụng bằng entrypoint
CMD ["/entrypoint.sh"]