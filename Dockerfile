FROM php:7-apache

MAINTAINER suchomski.marcin@gmail.com

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start-apache /usr/local/bin
RUN a2enmod rewrite

# Copy application source
COPY /DB /var/www/DB
COPY /api /var/www/
COPY /api/.htaccess /var/www/


RUN chown -R www-data:www-data /var/www

# use your users $UID and $GID below
RUN groupadd apache-www-volume -g 1000
RUN useradd apache-www-volume -u 1000 -g 1000
#RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql

CMD ["start-apache"]