# FROM php:8.2-apache

# # Enable Apache modules
# RUN a2enmod rewrite
# RUN a2enmod headers

# # Copy all files to the web root
# COPY . /var/www/html/

# # Set correct permissions
# RUN chown -R www-data:www-data /var/www/html/

# # VERY IMPORTANT: Configure Apache to allow .htaccess
# RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# # Set the correct document root
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# EXPOSE 80



FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache modules
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# If you have a composer.json
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["apache2-foreground"]
