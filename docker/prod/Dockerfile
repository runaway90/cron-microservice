# Use Alpine Linux
FROM choros/php-nginx.alpine-3-php7

# Maintainer
MAINTAINER Krzysztof Chlistała

ENV WEB_DOCUMENT_INDEX app.php
ENV WEB_DOCUMENT_ROOT /app/public

COPY docker/dev/web/conf/ /opt/docker/

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
    composer update --no-dev && \
    chmod 777 /app/var -R
