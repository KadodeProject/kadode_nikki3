FROM php:7.3-fpm-alpine
LABEL maintainer="ikuma"

# tinker(psysh)
ARG PSYSH_DIR=/usr/local/share/psysh
ARG PHP_MANUAL_URL=http://psysh.org/manual/ja/php_manual.sqlite

# timezone
ARG TZ

# composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

RUN set -eux && \
  apk update && \
  apk add --update --no-cache --virtual=.build-dependencies \
    autoconf \
    gcc \
    g++ \
    make \
    bash \
    tzdata \
    git && \
  apk add --update --no-cache \
    icu-dev \
    libzip-dev && \
  #Mecab,ipadic, php-mecabのインストール
  cd /tmp && \
  wget "https://drive.google.com/uc?export=download&id=0B4y35FiV1wh7cENtOXlicTFaRUE" -O mecab-0.996.tar.gz && \
  tar zxf mecab-0.996.tar.gz && \
  cd mecab-0.996 && \
  ./configure --enable-utf8-only --with-charset=utf8 && \
  make && \
  make install && \
  cd /tmp && \
  wget "https://drive.google.com/uc?export=download&id=0B4y35FiV1wh7MWVlSDBCSXZMTXM" -O mecab-ipadic-2.7.0-20070801.tar.gz && \
  tar zxf mecab-ipadic-2.7.0-20070801.tar.gz && \
  cd mecab-ipadic-2.7.0-20070801 && \
  ./configure --with-charset=utf8  && \
  make && \
  make install && \
  cd /tmp && \
  git clone https://github.com/rsky/php-mecab.git && \
  cd php-mecab/mecab && \
  phpize && \
  ./configure --with-mecab=/usr/local/bin/mecab-config && \
  make && \
  make install && \
  echo 'extension=mecab.so' > /usr/local/etc/php/conf.d/docker-php-ext-mecab.ini && \
  #OSの設定
  cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
  echo ${TZ} > /etc/timezone && \
  #Laravel関連のインストール
  pecl install xdebug && \
  docker-php-ext-install intl pdo_mysql zip bcmath && \
  docker-php-ext-enable xdebug && \
  mkdir $PSYSH_DIR && wget $PHP_MANUAL_URL -P $PSYSH_DIR && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  # composer config -g repos.packagist composer https://packagist.jp && \
  # composer global require hirak/prestissimo && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org  &&\
  #お片付け
  #apk del .build-dependencies && \
  rm -rf \
    mecab-0.996* \
    mecab-ipadic-2.7.0-20070801* \
    php-mecab
COPY ./infra/docker/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./infra/docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /work/backend