#!/usr/bin/env sh
set -e

# -yオプションがないので--forceで実行(上書きされるわけではなく、あくまでproductionなのにいいの？画面を飛ばす用)
php artisan config:cache
php artisan migrate --force
php-fpm -D
nginx -g 'daemon off;'
