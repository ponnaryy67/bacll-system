FROM php:8.2-apache

# ដំឡើង mysqli extension សម្រាប់ PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy source code ទៅកាន់ Apache server directory
COPY . /var/www/html/

# កែប្រែ Apache DocumentRoot ឱ្យចូលទៅក្នុង folder bacll
RUN sed -i 's!/var/www/html!/var/www/html/bacll!g' /etc/apache2/sites-available/000-default.conf

# បើកសិទ្ធិឱ្យ Apache អាចអានកូដបាន
RUN chown -R www-data:www-data /var/www/html



