FROM nginx:stable-alpine
COPY infra/dev/container/nginx/nginx.conf /etc/nginx/conf.d/default.conf

RUN apk update && \
    apk add --update --no-cache --virtual=.build-dependencies g++

RUN apk add bash

WORKDIR /work/backend
