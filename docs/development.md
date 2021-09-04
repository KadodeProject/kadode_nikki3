http://localhost

https://fonts.google.com/icons

## docker

### よく使う

```
dc exec app php
```

```
dc exec app php artisan migrate:fresh --seed
```

### DB 閲覧

```
dc exec db mysql -u root -p
pass:secret


show databases;show tables from laravel_local;USE laravel_local;
SHOW COLUMNS FROM users;
SELECT * FROM users;
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

## python MySQLdb

https://www.sejuku.net/blog/82657

## テストアカウント

氏名:開発者 1
メール:test1@example.com
パス:test1234

氏名:開発者 2
メール:test2@example.com
パス:test1234
