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

### laravel cron を cron に登録(docker の例)

crontab -e

-   -   -   -   -   cd /work/backed && php artisan schedule:run >> /dev/null 2>&1
