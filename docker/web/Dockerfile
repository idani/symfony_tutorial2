FROM httpd:2.4-alpine

# Add basics first
RUN set -eux \
    && apk update \
    && apk upgrade \
    && apk add \
    bash \
    apache2 \
    php7-apache2 \
    curl \
    ca-certificates \
    openssl \
    openssh \
    git \
    php7 \
    php7-phar \
    php7-json \
    php7-iconv \
    php7-openssl \
    tzdata \
    openntpd \
    ssmtp

# Setup apache and php
RUN apk add \
    php7-ftp \
    php7-xdebug \
    php7-mcrypt \
    php7-mbstring \
    php7-soap \
    php7-gmp \
    php7-pdo_odbc \
    php7-dom \
    php7-pdo \
    php7-zip \
    php7-mysqli \
    php7-sqlite3 \
    php7-pdo_pgsql \
    php7-bcmath \
    php7-gd \
    php7-odbc \
    php7-pdo_mysql \
    php7-pdo_sqlite \
    php7-gettext \
    php7-xml \
    php7-xmlreader \
    php7-xmlwriter \
    php7-tokenizer \
    php7-xmlrpc \
    php7-bz2 \
    php7-pdo_dblib \
    php7-curl \
    php7-ctype \
    php7-session \
    php7-redis \
    php7-exif \
    php7-intl \
    php7-fileinfo \
    php7-ldap \
    php7-apcu

# Problems installing in above stack
RUN apk add php7-simplexml

RUN cp /usr/bin/php7 /usr/bin/php \
    && rm -f /var/cache/apk/*

# Add Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && composer config -g repos.packagist composer https://packagist.jp \
    && composer global require hirak/prestissimo

RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# 自己証明書を発行
RUN openssl genrsa 2048 > /usr/local/apache2/conf/server.key \
    && openssl req -new -key /usr/local/apache2/conf/server.key -subj "/C=JP/ST=Tokyo/L=Chuo-ku/O=RMP Inc./OU=web/CN=localhost" > /usr/local/apache2/conf/server.csr \
    && openssl x509 -in /usr/local/apache2/conf/server.csr -days 3650 -req -signkey /usr/local/apache2/conf/server.key > /usr/local/apache2/conf/server.crt \
    && chmod 400 /usr/local/apache2/conf/server.key


# Add apache to run and configure
RUN sed -i \
    -e 's/^#\(Include .*httpd-ssl.conf\)/\1/' \
    -e 's/^#\(LoadModule .*mod_ssl.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_socache_shmcb.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_rewrite.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_session.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_session_cookie.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_session_crypto.so\)/\1/' \
    -e 's/^#\(LoadModule .*mod_deflate.so\)/\1/' \
    -e 's/^ErrorLog \/proc\/self\/fd\/2$/ErrorLog \/var\/log\/apache2\/apache2-error.log/' \
    -e 's/\/proc\/self\/fd\/1/\/var\/log\/apache2\/apache2-access.log/' \
    /usr/local/apache2/conf/httpd.conf

RUN sed -i \
    -e 's/^ErrorLog \/proc\/self\/fd\/2$/ErrorLog \/var\/log\/apache2\/apache2-ssl-error.log/' \
    -e 's/\/proc\/self\/fd\/1/\/var\/log\/apache2\/apache2-ssl-access.log/' \
    -e 's/^ServerName www.example.com:443/ServerName localhost:443/' \
    /usr/local/apache2/conf/extra/httpd-ssl.conf
