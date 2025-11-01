# Dockerfile
FROM php:8.2-apache
# install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql
# enable apache rewrite (if needed)
RUN a2enmod rewrite
COPY src/ /var/www/html/
# change owner if needed
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
