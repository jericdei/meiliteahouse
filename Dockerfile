FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    curl ca-certificates gnupg g++ git sudo unzip zip \
    libbz2-dev libfreetype6-dev libicu-dev libjpeg-dev \
    libmcrypt-dev libpng-dev libreadline-dev libonig-dev libzip-dev libpq-dev \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite headers

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    bcmath bz2 calendar iconv intl mbstring opcache zip gd \
    pdo pdo_pgsql pgsql

RUN apt-get update \
    && apt-get install -y libmagickwand-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sL "https://deb.nodesource.com/setup_21.x" | bash -
RUN apt update
RUN apt -q -y install nodejs
RUN npm install -g yarn

ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser
