FROM php:8.2-apache
# Install Dependencies
RUN apt-get update && \
    apt-get install -y zlib1g-dev libfreetype6-dev libpng-dev libjpeg-dev libwebp-dev libzip-dev unzip git && \
    apt-get clean && \
# Install extensions
    docker-php-ext-install pdo_mysql zip exif pcntl sockets bcmath && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# install default-mysql-client
RUN apt-get update && apt-get install -y default-mysql-client && rm -rf /var/lib/apt/lists/*

