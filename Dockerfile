


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



# FROM php:8.2-apache

# RUN apt-get update && apt-get install -y default-mysql-client \
#     && docker-php-ext-install mysqli pdo pdo_mysql \
#     && docker-php-ext-enable mysqli pdo pdo_mysql

# RUN a2enmod rewrite
# RUN a2enmod headers

# COPY . /var/www/html/

# # ✅ Fix uploads permissions
# RUN mkdir -p /var/www/html/uploads \
#     && chown -R www-data:www-data /var/www/html \
#     && chmod -R 777 /var/www/html/uploads

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

# # EXPOSE 80

FROM php:8.2-apache

RUN apt-get update && apt-get install -y default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql

RUN a2enmod rewrite
RUN a2enmod headers

COPY . /var/www/html/

# ✅ Fix all permissions
RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/uploads

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ✅ Allow Apache to write uploads
RUN echo '<Directory /var/www/html/uploads>' >> /etc/apache2/apache2.conf \
    && echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf \
    && echo '    AllowOverride All' >> /etc/apache2/apache2.conf \
    && echo '    Require all granted' >> /etc/apache2/apache2.conf \
    && echo '</Directory>' >> /etc/apache2/apache2.conf

ENV DB_HOST=z40w808w80s8cckow00wo4cc
ENV DB_NAME=default
ENV DB_USER=mysql
ENV DB_PASS=T4fz93Lxd1sw5VMmb9VfMhwdManhqdpO1GgVniDrHJJOCJ2m1PdZosMLr6LudQzg
ENV DB_PORT=3306
ENV APP_ENV=production

COPY init-db.sh /init-db.sh
RUN chmod +x /init-db.sh

CMD ["/bin/bash", "-c", "/init-db.sh & apache2-foreground"]

EXPOSE 80
