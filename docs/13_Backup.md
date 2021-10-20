# 全体

古いバックアップデータが溜まっている場合は削除
↓
laravel-backup でバックアップを作成
↓
GCP の Google Cloud Storage へ送信
(ここはライブラリと artisan 自作コマンドで)

これらを laravel cron で定期実行

## 使うストレージ

GCP の Google Cloud Storage 無料枠

# 操作方法(下記はこのリポジトリを使う前提(git 管理されてる部分は省略))

### gcp の設定

https://thr3a.hatenablog.com/entry/20180916/1537093825

https://blog.capilano-fw.com/?p=3359

Google cloud storage の契約済

-   composer install
-   storage/json/に GCP Google Cloud Storage の鍵を入れる(これは git 管理外)
-   env にパスなど登録

### laravel-backup

https://helog.jp/laravel/db-backup/

-   composer install 必要
-   メール送信先を env に追記(それ以外の手順は git 管理なので問題なし)

コマンド

```
php artisan backup:run --only-db
```

mysql コマンドないエラー →apt install default-mysql-client する(この docker には導入済み)

mysql-client はインストールできなくなっている……

RSA がどうこうってエラー →php artisan migrate:fresh --seed してから行う(mysql のバージョンで認証方式の変更あったらしい)

### laravel-backup を行うための laravel cron と バックアップした dump データを gcp に送るために cron に登録(docker の例)

### cron 追加

root で

crontab -e

```
* * * * * cd /work/backed && php artisan schedule:run >> /dev/null 2>&1
0 5 * * * cd /work/backend/app/CustomFunction && /usr/local/bin/php backupGCS.php
```

設定後に下記コマンド実行

```
service cron restart
service cron status
```

cron の確認は

crontab -l

laravel cron の確認は

php artisan schedule:list

laravel cron のテスト実行は

php artisan schedule:work

※全タスクを 1 分ごとに cron してくれる

```
php artisan cache:clear
```

をお忘れなく

# 復元方法

GCS からダウンロードして、sql のあるところに送る

↓
mysql -u root -p < dump.sql

こういう感じで行けるらしい。

https://qiita.com/mikakane/items/6857a4ae25ceaed4ee4e
