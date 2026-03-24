
# FROM php:8.2-apache

# # Install and enable MySQL extensions used by the app
# RUN docker-php-ext-install mysqli pdo pdo_mysql \
#     && docker-php-ext-enable mysqli pdo pdo_mysql

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

# Install and enable MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod headers

# Copy all files to the web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/

# Configure Apache to allow .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set the correct document root
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ✅ Hardcoded DB environment variables
ENV DB_HOST=z40w808w80s8cckow00wo4cc
ENV DB_NAME=relievv
ENV DB_USER=mysql
ENV DB_PASS=T4fz93Lxd1sw5VMmb9VfMhwdManhqdpO1GgVniDrHJJOCJ2m1PdZosMLr6LudQzg
ENV DB_PORT=3306
ENV APP_ENV=production



EXPOSE 80
