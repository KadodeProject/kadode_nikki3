#
# 事前にビルドが必要なものを作っておく
#
FROM node:18-alpine AS node
RUN corepack enable
WORKDIR /work/build
COPY backend/package.json ./
COPY backend/pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile
# COPY backend/postcss.config.js .
COPY backend/tailwind.config.js .
COPY backend/vite.config.js .
COPY backend/resources ./resources
COPY backend/routes ./routes
COPY backend/public ./public

RUN pnpm build


#
# ここからPHP
#
FROM php:8.2-fpm-bullseye AS backend

ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

RUN apt-get update \
  && apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    gnupg \
    nginx \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && locale-gen en_US.UTF-8 \
  && localedef -f UTF-8 -i en_US en_US.UTF-8 \
  && mkdir /var/run/php-fpm

#
# nginx関連
#
COPY infra/prod/container/backend/nginx.conf /etc/nginx/conf.d/default.conf
COPY infra/prod/container/backend/entrypoint.sh /work/backend/entrypoint.sh


#
# PHP関連のインストール
#

RUN docker-php-ext-install intl pdo_mysql zip bcmath \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && docker-php-ext-install redis
# MAKEFLAGSで並列ビルド指定することでめちゃくちゃに遅いgrpcのinstallを高速化する
RUN MAKEFLAGS="-j $(nproc)" pecl install grpc protobuf \
    && docker-php-ext-enable grpc protobuf
RUN composer config -g process-timeout 3600 && composer config -g repos.packagist composer https://packagist.org


COPY ./infra/prod/container/backend/php.ini /usr/local/etc/php/php.ini

WORKDIR /work/backend

COPY ./backend/composer.json ./backend/composer.lock ./
RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist

# storageはマウントするので、初回ビルドでコケないようにファイル生成のみ
RUN mkdir -p bootstrap/cache \
    storage/framework/cache/data/ \
    storage/framework/app/cache \
    storage/framework/sessions \
    storage/framework/views \
# COPY ./backend/server.php ./server.php
COPY ./backend/artisan ./artisan
COPY ./backend/bootstrap/app.php ./bootstrap/
COPY ./backend/GrpcClient ./GrpcClient
COPY ./backend/resources ./resources
COPY ./backend/config ./config
COPY ./backend/routes ./routes
COPY ./backend/database ./database
COPY ./backend/app ./app
COPY --from=node /work/build/public ./public

RUN chmod -R 777 storage bootstrap/cache entrypoint.sh \
    && php artisan optimize:clear \
    && php artisan route:cache \
    && php artisan config:cache \
    && php artisan view:cache \
    && php artisan optimize
# 終了させないために
ENTRYPOINT ["sh","/work/backend/entrypoint.sh"]
