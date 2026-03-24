
FROM php:8.2-apache

# Install and enable MySQL extensions used by the app
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod headers

# Copy all files to the web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/

# VERY IMPORTANT: Configure Apache to allow .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set the correct document root
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

