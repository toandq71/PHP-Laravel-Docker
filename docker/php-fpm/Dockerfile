FROM php:8.2-fpm

ARG WWWGROUP
ARG NODE_VERSION=20
ARG POSTGRES_VERSION=15

ENV WWWUSER 1000
ENV XDEBUG_MODE off
ENV XDEBUG_CONFIG client_host=host.docker.internal

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    sudo \
    curl \
    zip \
    unzip \
    supervisor \
    sqlite3 \
    libcap2-bin \
    libpng-dev \
    libpq-dev \
    libzip-dev \
    vim


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add nodejs and npm
RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && mkdir -p /etc/apt/keyrings/ \
    && apt-get update

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.${XDEBUG_CONFIG}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/docker/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install imagick
# RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends
# RUN printf "\n" | pecl install imagick
# RUN docker-php-ext-enable imagick

# Install the pgsql client
# RUN apt-get update && apt-get -yqq install wget \
#     && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
#     && echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" | tee /etc/apt/sources.list.d/pgdg.list \
#     && apt-get update \
#     && apt-get -y install postgresql-client-$POSTGRES_VERSION \
#     && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

# Cleanup
RUN apt-get clean \
    && rm -rf /var/cache/apk/* /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql pcntl mysqli gd zip

# Create new user and group
RUN groupadd --force -g $WWWGROUP --system www-dev
RUN useradd -ms /bin/bash -g $WWWGROUP --system -u $WWWUSER www-dev \
    && echo "www-dev:123456" | chpasswd && adduser www-dev sudo

RUN chown -R www-dev:www-dev /var/www/html

# Modify default user and group configurations
RUN sed -i "s/user = www-data/user = www-dev/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = www-dev/g" /usr/local/etc/php-fpm.d/www.conf

COPY php-fpm/start-container /usr/local/bin/start-container
COPY php-fpm/php.ini /usr/local/etc/php/
COPY php-fpm/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN chmod +x /usr/local/bin/start-container

EXPOSE 9000

ENTRYPOINT ["start-container"]
