FROM php:7.4-apache

# Install PHP extensions and other dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html