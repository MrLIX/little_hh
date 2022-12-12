FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    git-core \
    curl \
    vim nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

### Composer - https://hub.docker.com/r/composer/composer/
ENV COMPOSER_VERSION 2.3.7

RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }"

RUN php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} && rm -rf /tmp/composer-setup.php
###

# Set working directory
WORKDIR /var/www

# Copy project /var/www
ADD . /var/www

# Make sure nginx accessible files and folders have correct owner and group
RUN chown -R www-data:www-data /var/www/.*
RUN chmod -R 777 /var/www/storage/

# Install PHP dependencies with composer
USER www-data
RUN cd /var/www \
    && composer install
