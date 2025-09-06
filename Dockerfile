FROM php:apache

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y libzip-dev zip vim git && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global --add safe.directory /var/www/html

WORKDIR /var/www/html

RUN a2enmod rewrite && \
    sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY composer.json composer.lock* ./

#RUN composer update --no-dev --no-scripts --optimize-autoloader
RUN composer install

EXPOSE 80
