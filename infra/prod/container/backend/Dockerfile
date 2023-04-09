#
# 事前にビルドが必要なものを作っておく
#
FROM node:18-alpine AS node
RUN corepack enable
WORKDIR /build
COPY package.json ./
COPY pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile
# COPY postcss.config.js .
COPY tailwind.config.js .
COPY vite.config.js .
COPY resources ./resources
COPY routes ./routes
COPY public ./public

RUN pnpm build


#
# ここからPHP
# grpc周りがあまりにも遅いのでキャッシュを効かせるためにステージを分ける
#
FROM php:8.2-fpm-bullseye AS install-essential

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

RUN docker-php-ext-install intl pdo_mysql zip bcmath \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && docker-php-ext-install redis
# MAKEFLAGSで並列ビルド指定することでめちゃくちゃに遅いgrpcのinstallを高速化する
RUN MAKEFLAGS="-j $(nproc)" pecl install grpc protobuf \
    && docker-php-ext-enable grpc protobuf
RUN composer config -g process-timeout 3600 && composer config -g repos.packagist composer https://packagist.org


#
# ここからcomposerとコピー関連と初期構築
#
FROM install-essential AS production
#
# nginx関連
#
COPY container/prod/nginx.conf /etc/nginx/conf.d/default.conf
COPY container/prod/entrypoint.sh /backend/entrypoint.sh
COPY container/prod/php.ini /usr/local/etc/php/php.ini

WORKDIR /backend

COPY composer.json composer.lock ./
RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist

# storageはマウントするので、初回ビルドでコケないようにファイル生成のみ
# COPY ./server.php ./server.php
COPY ./ .
# artisanを明示的に読まないと読み込んでくれない(ドットがないのでディレクトリ扱いになっている説ある)
# COPY artisan ./artisan
COPY --from=node /build/public ./public

# config:cacheだけはRUNの状態ではまだconfigが入ってこないのでENTRYPOINTのシェルスクリプト内でやる
RUN mkdir -p bootstrap/cache \
    storage/app/backup-temp \
    storage/app/laravel-backup \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/json \
    && chmod -R 777 storage bootstrap/cache entrypoint.sh \
    && php artisan route:cache \
    && php artisan view:cache
# 終了させないために
ENTRYPOINT ["sh","/backend/entrypoint.sh"]
