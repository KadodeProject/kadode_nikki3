# データベースのバックアップについて

storage/app/backup-temp:バックアップ生成中に生じる一時データの保存先(処理が終わると自動で消える)
storage/app/laravel-backup:バックアップファイルの保存先(cron ジョブで最新 2 つだけ残している)

## バックアップデータを掃除する

```
php artisan backup:clean --disable-notifications
```

直近 2 つを残して消している(config/backup.php)

## バックアップデータを作成する

```
php artisan backup:run --only-db
```

## GCP にアップロードする

```
php artisan gcs:backup
```

存在しているバックアップファイルから最新のものをアップロードする
