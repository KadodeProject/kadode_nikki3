# バックエンドに関して

[データベースに関して](01_db.md)

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

# laravel cron の設定

kadode_nikki3\backend\app\Console\Kernel.php

にて。

# 利用可能な追加 artisan コマンド

GCP Gooogle Cloud Storage へ最新の DB ダンプを送る(DB ダンプは(php artisan backup:run --only-db))

```
php artisan kadode:gcsBackup
```

かどで日記のユーザーランク審査を行い、ランクアップ可能ならばランクアップ処理を行う

```
php artisan user:judgeUser_rank
```
