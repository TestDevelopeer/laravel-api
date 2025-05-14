FROM php:8.4-fpm

# Установите необходимые зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libicu-dev \
    libpq-dev \
    nano \
    && docker-php-ext-install pdo_mysql

# Install PHP extensions zip and intl (intl requires to be configured)
RUN docker-php-ext-install zip && docker-php-ext-configure intl && docker-php-ext-install intl

# Add MySQL and Postgres/pgsql support
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

# Установите Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Установите Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd

# Установите рабочую директорию
WORKDIR /var/www
