FROM nginx:stable-alpine
COPY infra/dev/nginx/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /work/backend

COPY ./backend/public ./public
