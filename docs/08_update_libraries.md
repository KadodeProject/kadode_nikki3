## composer と npm の更新

### ローカル

```
composer update
```

で composer 更新

```
npm update
```

で npm 更新

### 本番

push してからの

```
composer install
```

```
npm ci
```

以外ダメ

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
