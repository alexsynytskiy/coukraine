#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Allocate swap for MySQL"
fallocate -l 2048M /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab

info "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure locales

info "Configure timezone"
echo ${timezone} | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

info "Update OS software"
add-apt-repository -y ppa:ondrej/php
apt-get update -y -qq
apt-get install -y python-software-properties openssl libssl-dev libssl-dev build-essential
echo "Done!"

info "Install additional software"
apt-get install -y git vim screen curl unzip memcached redis-server supervisor mc grc wget swftools poppler-utils htop cron
echo "Done!"

info "Install Nginx"
apt-get install -y nginx
echo "Done!"

info "Install MySQL"
debconf-set-selections <<< "mariadb-server mysql-server/root_password password \"'vagrant'\""
debconf-set-selections <<< "mariadb-server mysql-server/root_password_again password \"'vagrant'\""
apt-get install -y mariadb-server
echo "Done!"

DEBIAN_FRONTEND=noninteractive \
    apt-get update && \
    apt-get install -y language-pack-en-base &&\
    export LC_ALL=en_US.UTF-8 && \
    export LANG=en_US.UTF-8
apt-get install software-properties-common -y
DEBIAN_FRONTEND=noninteractive LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update --fix-missing

apt-get install -y \
    mysql-client \
    apt-utils \
    curl \
    php7.1 \
    php7.1-fpm \
    php7.1-cli \
    php7.1-common \
    php7.1-json \
    php7.1-intl \
    php7.1-sqlite3 \
    php7.1-curl \
    php7.1-tidy \
    php7.1-xml \
    php7.1-mbstring \
    php7.1-xdebug \
    php7.1-mysql \
    php7.1-gd \
    php7.1-imagick \
    php7.1-mcrypt \
    php7.1-redis \
    php7.1-memcache \
    php7.1-imap \
    php7.1-mbstring \
    php7.1-dom \
    php7.1-soap \
    php7.1-zip \
    acl \
    rsyslog \
    supervisor \
    vim \
    telnet \
    dnsutils \
    mc \
    npm \
    git

info "Install NodeJS and NPM"
apt-get -y install npm
curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -
apt-get install -y nodejs
echo "Done!"

info "Install PhantomJs"
npm install -g phantomjs
echo "Done!"

info "Install CasperJs"
npm install -g casperjs
echo "Done!"

info "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

service mysql stop
mkdir -p /var/run/mysqld
chown mysql:mysql /var/run/mysqld
sudo /usr/sbin/mysqld --skip-grant-tables --skip-networking &
mysql -u root
FLUSH PRIVILEGES;
USE mysql;
UPDATE user SET authentication_string=PASSWORD("vagrant") WHERE User='root';
UPDATE user SET plugin="mysql_native_password" WHERE User='root';
quit;
echo "Done!"

info "Configure PHP-FPM"
mv /etc/php/7.1/fpm/php.ini /etc/php/7.1/fpm/php.ini.dmp
ln -s /var/www/coukraine/vagrant/php/fpm/php.ini /etc/php/7.1/fpm/php.ini
mv /etc/php/7.1/fpm/pool.d/www.conf /etc/php/7.1/fpm/pool.d/www.conf.dmp
ln -s /var/www/coukraine/vagrant/php/fpm/pool.d/www.conf /etc/php/7.1/fpm/pool.d/www.conf
sed -i 's/user = www-data/user = vagrant/g' /etc/php/7.1/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = vagrant/g' /etc/php/7.1/fpm/pool.d/www.conf
sed -i 's/owner = www-data/owner = vagrant/g' /etc/php/7.1/fpm/pool.d/www.conf
echo "Done!"

info "Configure NGINX"
sed -i 's/user www-data/user vagrant/g' /etc/nginx/nginx.conf
echo "Done!"

info "Enabling site configuration"
ln -s /var/www/coukraine/vagrant/nginx/app.conf /etc/nginx/sites-enabled/app.conf
echo "Done!"

info "Enabling xdebug configuration"
mv /etc/php/7.1/mods-available/xdebug.ini /etc/php/7.1/mods-available/xdebug.ini.dmp
cp /var/www/coukraine/vagrant/php/mods-available/xdebug.ini /var/www/coukraine/vagrant/php/mods-available/xdebug-local.ini
ln -s /var/www/coukraine/vagrant/php/mods-available/xdebug-local.ini /etc/php/7.1/mods-available/xdebug.ini
echo "Done!"

info "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
