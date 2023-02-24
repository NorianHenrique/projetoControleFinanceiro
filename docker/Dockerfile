FROM php:8.1.2-apache-buster
WORKDIR /var/www/html

ENV uid=1000   

RUN apt-get update && apt-get install libpq-dev libjpeg-dev libpng-dev libzip-dev unzip -y && \
    docker-php-ext-install zip gd pdo_mysql pdo pgsql pdo_pgsql && \
    pecl install  xdebug && \
    docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php && rm composer.phar

COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/php.ini $PHP_INI_DIR/php.ini

RUN a2enmod rewrite

RUN useradd -G root -u $uid -d /home/devuser devuser

RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser

RUN chown -R $uid:$uid /var/www/html

USER $uid

