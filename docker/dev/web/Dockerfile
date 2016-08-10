# Use Alpine Linux
FROM choros/alpine-php-nginx-docker:latest

# Maintainer
MAINTAINER Krzysztof Chlistała

ENV WEB_DOCUMENT_INDEX app_dev.php
ENV WEB_DOCUMENT_ROOT /app/public

COPY docker/conf/ /opt/docker/

ADD src /app/src
ADD bin /app/bin
ADD public /app/public
ADD symfony /app/symfony
ADD composer.json /app/composer.json

RUN apk add --no-cache \
    git \
    curl \
    vim \
    && \
    /opt/docker/bin/control.sh service.enable cron && \
    cd app && \
    mkdir var && \
    mkdir var/cache && \
    mkdir var/logs && \
    composer update && \
    chmod 777 /app/var -R
