FROM ubuntu:16.04

RUN DEBIAN_FRONTEND=noninteractive \
    apt-get update && \
    apt-get install -y language-pack-en-base &&\
    export LC_ALL=en_US.UTF-8 && \
    export LANG=en_US.UTF-8
RUN apt-get install software-properties-common -y
RUN DEBIAN_FRONTEND=noninteractive LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update --fix-missing

RUN apt-get install -y \
    mysql-client \
    apt-utils \
    curl \
    php5.6 \
    php5.6-fpm \
    php5.6-cli \
    php5.6-common \
    php5.6-json \
    php5.6-intl \
    php5.6-sqlite3 \
    php5.6-curl \
    php5.6-tidy \
    php5.6-xml \
    php5.6-mbstring \
    php5.6-xdebug \
    php5.6-mysql \
    php5.6-gd \
    php5.6-imagick \
    php5.6-mcrypt \
    php5.6-redis \
    php5.6-memcache \
    php5.6-imap \
    php5.6-mbstring \
    php5.6-dom \
    php5.6-soap \
    php5.6-zip \
    acl \
    rsyslog \
    supervisor \
    vim \
    telnet \
    dnsutils \
    mc \
    npm \
    git

RUN  curl -sL https://deb.nodesource.com/setup_5.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g phantomjs \
    && npm install -g casperjs \
    && mkdir /run/php/ && chmod a+rwx /run/php \
    && chsh -s /bin/bash www-data \
    && usermod -m -d /home/www-data www-data \
    && mkdir /home/www-data && chown www-data:www-data /home/www-data \
    && echo 'ALL ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers \
    && echo 'www-data:www-data' | chpasswd \
    && echo "export TERM=xterm" >> /etc/bash.bashrc \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && echo 'export PATH="$HOME/.composer/vendor/bin:$PATH"' >> /root/.bashrc

USER www-data

ARG github_token
RUN echo 'export PATH="/home/www-data/.composer/vendor/bin:$PATH"' >> /home/www-data/.bashrc \
    && composer config --global github-oauth.github.com "$github_token"

USER root

ADD fpm.conf /etc/php/5.6/fpm/pool.d/www.conf
RUN phpenmod xdebug \
    && echo "xdebug.max_nesting_level=200" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini  && \
    echo "xdebug.remote_enable = On"  >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini  && \
    echo "xdebug.var_display_max_depth =5" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.remote_connect_back = 0" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.idekey=PHPSTORM" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.remote_host = 172.17.0.1" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.remote_autostart = 1" >> /etc/php/5.6/fpm/conf.d/20-xdebug.ini \
    && mkdir -p /var/www/coukraine \
    && chown -R www-data:www-data /var/www/coukraine

VOLUME /var/www/coukraine

WORKDIR /var/www/coukraine

ARG GID
ARG UID

RUN usermod -u $UID www-data \
    && groupmod -g $GID www-data


EXPOSE 9000

CMD ["/usr/sbin/php-fpm5.6", "--nodaemonize"]
