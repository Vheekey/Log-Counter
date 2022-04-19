# FROM php:8.1-alpine3.14

# RUN docker-php-ext-install pdo pdo_mysql sockets

# #composer
# ENV COMPOSER_VERSION 2.3.4
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION

# RUN curl   https://raw.githubusercontent.com/creationix/nvm/v0.25.0/install.sh | bash

# RUN curl -sL https://deb.nodesource.com/setup_14.x | bash

# RUN apt-get update \
#     && apt-get install -y --no-install-recommends \
#         libz-dev \
#         libpq-dev \
#         libjpeg-dev \
#         libpng-dev \
#         libssl-dev \
#         libzip-dev \
#         unzip \
#         zip \
#         nodejs \
#     && apt-get clean \
#     && pecl install redis \
#     && docker-php-ext-configure gd \
#     && docker-php-ext-configure zip \
#     && docker-php-ext-install \
#         gd \
#         exif \
#         opcache \
#         pdo_mysql \
#         pdo_pgsql \
#         pgsql \
#         pcntl \
#         zip \
#     && docker-php-ext-enable redis \
#     && rm -rf /var/lib/apt/lists/*;


# WORKDIR /src
# COPY . .

# # Copy existing application directory contents
# COPY . .

# # Copy composer.lock and composer.json
# COPY composer.json /var/www/

# COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# RUN composer install  \
#     --ignore-platform-reqs \
#     --no-ansi \
#    # --no-dev \
#     --no-interaction \
#     --no-scripts \
#     --prefer-dist

# RUN apt-get update \
#   && apt-get install -y libzip-dev git wget --no-install-recommends \
#   && apt-get clean \
#   && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

# RUN wget https://getcomposer.org/download/2.0.9/composer.phar \ 
#     && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

# RUN chown -R www-data:www-data /var/www/*

# RUN chmod +x /entrypoint.sh

# ENTRYPOINT ["entrypoint.sh"]

# # Enable mod_rewrite
# RUN a2enmod rewrite

# CMD bash -C './run.sh';'bash'; 'apache2-foreground'

FROM php:8.1-fpm

# Copy existing application directory contents
COPY . .

# Copy composer.lock and composer.json
COPY composer.json /var/www/

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
   # --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist

WORKDIR /var/www/logcounter

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# RUN a2enmod rewrite

CMD bash -C './run.sh';'bash'; 'apache2-foreground'