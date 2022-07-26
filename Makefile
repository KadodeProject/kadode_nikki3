up:
	docker compose up -d
build:
	docker compose build --no-cache --force-rm
laravel-install:
	docker compose exec app composer create-project --prefer-dist laravel/laravel .
create-project:
	mkdir -p backend
	@make build
	@make up
	@make laravel-install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
install-recommend-packages:
	# Laravel静的解析用
	docker compose exec app composer require --dev nunomaduro/larastan
	# dbカラムの変更用
	docker compose exec app composer require doctrine/dbal
	# エディタのコード補完
	docker compose exec app composer require --dev barryvdh/laravel-ide-helper
	# bladeでのデバッグ向上
	docker compose exec app composer require --dev barryvdh/laravel-debugbar
	# 上記を動作させる用
	docker compose exec app php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
	# 上記を動作させる用
	docker compose exec app composer require --dev roave/security-advisories:dev-master
	# docker compose exec app composer require --dev beyondcode/laravel-dump-server
	docker compose exec app php artisan vendor:publish --provider="BeyondCode\DumpServer\DumpServerServiceProvider"
init:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	docker compose exec app php artisan dusk:chrome-driver
	docker compose exec app chmod 775 -R vendor/laravel/dusk/bin
	@make fresh
	docker compose exec web yarn install
	docker compose exec web yarn build
remake:
	@make destroy
	@make init
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
destroy-volumes:
	docker compose down --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow
log-web:
	docker compose logs web
log-web-watch:
	docker compose logs --follow web
log-app:
	docker compose logs app
log-app-watch:
	docker compose logs --follow app
log-db:
	docker compose logs db
log-db-watch:
	docker compose logs --follow db
web:
	docker compose exec web bash
app:
	docker compose exec app bash
migrate:
	docker compose exec app php artisan migrate
fresh:
	docker compose exec app php artisan migrate:fresh --seed
seed:
	docker compose exec app php artisan db:seed
rollback-test:
	docker compose exec app php artisan migrate:fresh
	docker compose exec app php artisan migrate:refresh
tinker:
	docker compose exec app php artisan tinker
dusk:
	docker compose exec app php artisan dusk --testdox
test:
	docker compose exec app php artisan test
unit-test:
	docker compose exec app php artisan test --testsuite Unit
combined-test:
	docker compose exec app php artisan test --testsuite MinimumOperationCheck --testsuite Feature
optimize:
	docker compose exec app php artisan optimize
optimize-clear:
	docker compose exec app php artisan optimize:clear
cache:
	docker compose exec app composer dump-autoload -o
	@make optimize
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan view:cache
cache-clear:
	docker compose exec app composer clear-cache
	@make optimize-clear
	docker compose exec app php artisan event:clear
sql:
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'
ide-helper:
	docker compose exec app php artisan clear-compiled
	docker compose exec app php artisan ide-helper:generate
	docker compose exec app php artisan ide-helper:meta
	docker compose exec app php artisan ide-helper:models --nowrite
stan:
	docker compose exec app ./vendor/bin/phpstan analyse
cs-fixer:
	docker compose exec app ./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v
barth:
	docker-compose down --rmi all --volumes --remove-orphans
777:
	sudo chmod 777 -R backend
dev:
	docker-compose exec web yarn dev
