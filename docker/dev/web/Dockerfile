# Use Alpine Linux
FROM webdevops/php-nginx:alpine-3-php7

# Maintainer
MAINTAINER Krzysztof Chlistała

ENV WEB_DOCUMENT_INDEX app_dev.php
ENV WEB_DOCUMENT_ROOT /app/public

ADD src /app/src
ADD bin /app/bin
ADD public /app/public
ADD symfony /app/symfony
ADD composer.json /app/composer.json
ADD composer.lock /app/composer.lock

RUN apk add --no-cache \
    git \
    curl \
    vim \
    && \
    curl -sS https://getcomposer.org/installer | php7 -- --install-dir=/usr/local/bin --filename=composer && \
    cd app && \
    mkdir var && \
    mkdir var/cache && \
    mkdir var/logs && \
    composer update && \
    chmod 777 /app/var -R
