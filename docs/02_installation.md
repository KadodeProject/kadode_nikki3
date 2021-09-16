# 参考

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4

コチラを参考に作成していますが、mysqlclient 入れたり、python 入れたりかなり変更加わってます。

# 最初
.env.exampleから.envを作成(backend内で)
```

docker-compose up -d --build
docker-compose exec app chmod -R 777 storage bootstrap/cache
docker-compose exec app chmod -R 777 storage/logs
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan migrate:fresh --seed


docker-compose exec app pip3 install janome
docker-compose exec app pip3 install python-dotenv
docker-compose exec app pip3 install mysqlclient



```
