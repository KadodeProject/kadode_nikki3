# 本番環境に関して

## Laravel キャッシュクリア＆最適化

https://qiita.com/ucan-lab/items/c1e561d20cc591966c25

```
$ composer install --optimize-autoloader --no-dev
$ php artisan optimize:clear
$ php artisan optimize
```

## composer メモリエラー

```
COMPOSER_MEMORY_LIMIT=-1 $(which composer) install
```

---

# メンテナンスモード移行 artisan コマンド

メンテナンスモード

```
php artisan down
```

メンテナンスモード終了

```
php artisan up
```

引数はなぜか使えない。

メンテナンスモード中は 503 エラー扱いになる

---

# データベース手動バックアップコマンド

```
php artisan backup:run --only-db
```

# データベース手動 GCS 送信

```
php artisan gcs:backup
```

# 実際にテスト済

### SQL インジェクション

Laravel 側 →eloquent で対策済み(できないことを確認済み)
Python 側 →Mysqldb の execute で対策済み
https://qiita.com/yoichi22/items/56cc3d8e243e137a254c

### XSS 攻撃

できないことを確認済み

### CSRF 攻撃

Laravel blade で対策済み(@csrf)

# 実施済みの対策

## SSH 不正ログイン対策

パスワードログインの禁止、root ログインの禁止を設定済み
