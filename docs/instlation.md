### 最初

```

docker-compose up -d --build
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan migrate:fresh --seed
docker-compose exec app chmod -R 777 storage bootstrap/cache
docker-compose exec app chmod -R 777 storage/logs

docker-compose exec app php


下記は不要
docker-compose exec app bash;mysql -u root -p;
root or secret
SELECT user, host, plugin from mysql.user;

```
