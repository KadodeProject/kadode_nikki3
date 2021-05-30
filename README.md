http://localhost

```
dc exec app php
```

```
dc exec app php artisan migrate:fresh --seed
```

最初 docker 動かす時

## docker

```
docker-compose exec app chmod -R 777 storage bootstrap/cache
docker-compose exec app chmod -R 777 storage/logs
```

## 認証

(laravel jetstream 導入)
https://readouble.com/jetstream/1.0/ja/installation.html
認証は livewire を使った。

(laravel jetsream で sociolite)
https://qiita.com/manbolila/items/b64d0e9a9d42e4b8502c

google auth
https://qiita.com/u-dai/items/91df3b923dc82fed5b76

### jetstream 日本語化

https://php-junkie.net/framework/laravel/jetstream-ja/
composer require laravel-lang/lang:~8.0

### jetstream カスタマイズ

https://biz.addisteria.com/laravel_jetstream_customize/#toc6

## 環境構築

参考
https://github.com/ucan-lab/docker-laravel

## テストアカウント

名前:小畑尚史
メール:fugufugu0206@gmail.com
パスワード:mikakunin0530
