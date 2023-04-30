# バックエンドのログがDockerから見れないDockerfileにしてしまったので、ログをtailするシェルスクリプトを用意
(cd backend/storage/logs && tail -f -n 30 laravel.log)
