FROM php:7-apache

RUN docker-php-ext-install pdo pdo_mysql

ADD apache.conf /etc/apache2/sites-enabled/000-default.conf
ADD php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite
RUN service apache2 restart

