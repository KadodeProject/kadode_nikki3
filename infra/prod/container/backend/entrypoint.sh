#!/usr/bin/env sh
set -e

cd /work/backend && php artisan migrate
php-fpm -D
nginx -g 'daemon off;'
