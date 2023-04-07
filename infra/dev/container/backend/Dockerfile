FROM php:8.2-fpm-bullseye
ARG PROTOBUF_VERSION=22.2
ARG GRPC_VERSION=v1.53.0

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
    clang \
    nginx \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && locale-gen en_US.UTF-8 \
  && localedef -f UTF-8 -i en_US en_US.UTF-8 \
  && mkdir /var/run/php-fpm

#
# nginx関連
#
COPY infra/dev/container/backend/nginx.conf /etc/nginx/conf.d/default.conf
COPY infra/dev/container/backend/entrypoint.sh /work/entrypoint.sh

#
# GRPC関連のインストール
#
WORKDIR /tmp
# # protocのinstall(phpはgrpcio-toolsてきなものがないので)
# RUN curl -L https://github.com/protocolbuffers/protobuf/releases/download/v${PROTOBUF_VERSION}/protoc-${PROTOBUF_VERSION}-linux-x86_64.zip -o protoc.zip && \
#     unzip protoc.zip && \
#     mv bin/* /usr/local/bin/ && \
#     mv include/* /usr/local/include/

# bazelのインストール
RUN curl -fsSL https://bazel.build/bazel-release.pub.gpg | gpg --dearmor > bazel.gpg \
    &&  mv bazel.gpg /etc/apt/trusted.gpg.d/ \
    && echo "deb [arch=amd64] https://storage.googleapis.com/bazel-apt stable jdk1.8" | tee /etc/apt/sources.list.d/bazel.list \
    && apt-get update \
    && apt-get install -y bazel

# grpc-php-pluginとprotocを自前ビルド
# protocはgitからも取れるが、grpc-php-pluginは取れないのでここでまとめて2つともビルドする
# 現行最新版ではmakeコマンドでビルドできないので、bazelでビルドする
RUN git clone -b ${GRPC_VERSION} https://github.com/grpc/grpc --depth=1 \
    && cd grpc \
    && git submodule update --init \
    && bazel build @com_google_protobuf//:protoc \
    && bazel build src/compiler:grpc_php_plugin \
    && cp -p bazel-bin/external/com_google_protobuf/protoc /usr/local/bin/ \
    && cp -p bazel-bin/src/compiler/grpc_php_plugin /usr/local/bin/ \
    && rm -rf /tmp/grpc

#
# PHP関連のインストール
#

RUN docker-php-ext-install intl pdo_mysql zip bcmath \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && docker-php-ext-install redis
# MAKEFLAGSで並列ビルド指定することでめちゃくちゃに遅いgrpcのinstallを高速化する
RUN MAKEFLAGS="-j $(nproc)" pecl install grpc protobuf && \
    docker-php-ext-enable grpc protobuf
RUN composer config -g process-timeout 3600 && composer config -g repos.packagist composer https://packagist.org


COPY ./infra/dev/container/backend/php.ini /usr/local/etc/php/php.ini

WORKDIR /work/backend

ENTRYPOINT ["/work/entrypoint.sh"]
