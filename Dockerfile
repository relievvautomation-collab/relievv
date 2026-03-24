


# FROM php:8.2-apache

# RUN apt-get update && apt-get install -y default-mysql-client \
#     && docker-php-ext-install mysqli pdo pdo_mysql \
#     && docker-php-ext-enable mysqli pdo pdo_mysql

# RUN a2enmod rewrite
# RUN a2enmod headers

# COPY . /var/www/html/

# RUN chown -R www-data:www-data /var/www/html/

# RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ENV DB_HOST=z40w808w80s8cckow00wo4cc
# ENV DB_NAME=default
# ENV DB_USER=mysql
# ENV DB_PASS=T4fz93Lxd1sw5VMmb9VfMhwdManhqdpO1GgVniDrHJJOCJ2m1PdZosMLr6LudQzg
# ENV DB_PORT=3306
# ENV APP_ENV=production

# COPY init-db.sh /init-db.sh
# RUN chmod +x /init-db.sh

# CMD ["/bin/bash", "-c", "/init-db.sh & apache2-foreground"]

# EXPOSE 80


FROM php:8.2-apache

# Install mysql client + PHP extensions
RUN apt-get update && apt-get install -y default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql \
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

# ✅ DB environment variables
ENV DB_HOST=z40w808w80s8cckow00wo4cc
ENV DB_NAME=default
ENV DB_USER=mysql
ENV DB_PASS=T4fz93Lxd1sw5VMmb9VfMhwdManhqdpO1GgVniDrHJJOCJ2m1PdZosMLr6LudQzg
ENV DB_PORT=3306
ENV APP_ENV=production

# ✅ Create uploads folder with correct permissions
RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads \
    && chmod -R 755 /var/www/html/uploads

# Copy and set permissions for startup script
COPY init-db.sh /init-db.sh
RUN chmod +x /init-db.sh

# ✅ Start DB import in background + Apache
CMD ["/bin/bash", "-c", "/init-db.sh & apache2-foreground"]

EXPOSE 80

# FROM php:8.2-apache

# RUN apt-get update && apt-get install -y default-mysql-client \
#     && docker-php-ext-install mysqli pdo pdo_mysql \
#     && docker-php-ext-enable mysqli pdo pdo_mysql

# RUN a2enmod rewrite
# RUN a2enmod headers

# COPY . /var/www/html/

# RUN chown -R www-data:www-data /var/www/html/

# RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ENV DB_HOST=z40w808w80s8cckow00wo4cc
# ENV DB_NAME=default
# ENV DB_USER=mysql
# ENV DB_PASS=T4fz93Lxd1sw5VMmb9VfMhwdManhqdpO1GgVniDrHJJOCJ2m1PdZosMLr6LudQzg
# ENV DB_PORT=3306
# ENV APP_ENV=production

# COPY init-db.sh /init-db.sh
# RUN chmod +x /init-db.sh

# CMD ["/bin/bash", "-c", "/init-db.sh & apache2-foreground"]

# EXPOSE 80
