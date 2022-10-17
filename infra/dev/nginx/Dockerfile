FROM nginx:1.23-alpine
ADD infra/dev/nginx/nginx.conf /etc/nginx/conf.d/default.conf

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

RUN apk add bash

WORKDIR /work/backend
