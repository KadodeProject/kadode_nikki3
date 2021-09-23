# 参考

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4

コチラを参考に作成していますが、mysqlclient 入れたり、python 入れたりかなり変更加わってます。

# 最初

.env.example から.env を作成(backend 内で)

```

docker-compose up -d --build
docker-compose exec app chmod -R 777 storage bootstrap/cache
docker-compose exec app chmod -R 777 storage/logs
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan migrate:fresh --seed


```

# 注意：Windows の場合

infra>mysql>my.cnf を読み取り専用にする(エクスプローラーからプロパティ開いてチェック)

https://yama-weblog.com/why-my-cnf-does-not-work-in-docker/
