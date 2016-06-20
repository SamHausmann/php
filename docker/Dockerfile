FROM rosetteapi/docker-base-layer:RCB-414
MAINTAINER Fiona Hasanaj
ENV LANGUAGE=php

# install necessary software

RUN apt-get -y update && apt-get install -y \
    language-pack-en-base \
    libxslt1-dev \
    python-software-properties \
    vim \
    wget

RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php5-5.6
RUN apt-get update && apt-get install -y \
    php5-dev \
    php5-cli \
    php5-curl \
    php5-xsl \
    libapache2-mod-php5


RUN echo "memory_limit=-1" >> /etc/php5/cli/php.ini && \
    echo "date.timezone=America/New_York" >> /etc/php5/cli/php.ini

RUN wget -O /usr/local/bin/composer https://getcomposer.org/composer.phar && \
    chmod +x /usr/local/bin/composer

# copy over the necessary files
RUN mkdir /test-dev/tests
COPY composer.json /test-dev/composer.json
WORKDIR /test-dev

RUN composer install

# specify docker volume
VOLUME ["/source"]

# allow interactive bash inside docker container
CMD ./docker-entrypoint.sh $API_KEY $FILENAME $ALT_URL $GIT_USERNAME $VERSION $LANGUAGE; /bin/bash
