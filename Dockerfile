# Base image PHP + Apache
FROM php:8.2-apache

# Enable PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install dependencies (no dev in production)
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port for Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
