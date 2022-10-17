up:
	docker compose up -d
build:
	docker compose build --no-cache --force-rm
init:
	docker compose up -d --build
	docker compose exec backend composer install
	docker compose exec backend cp .env.example .env
	docker compose exec backend php artisan key:generate
	docker compose exec backend php artisan storage:link
	docker compose exec backend chmod -R 777 storage bootstrap/cache
	docker compose exec backend php artisan dusk:chrome-driver
	docker compose exec backend chmod 775 -R vendor/laravel/dusk/bin
	@make fresh

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
	docker compose exec backend bash
migrate:
	docker compose exec backend php artisan migrate
fresh:
	docker compose exec backend php artisan migrate:fresh --seed
run-nlp-direct:
	docker compose exec backend python3 python/pythonUseFromPHP.py 1
seed:
	docker compose exec backend php artisan db:seed
rollback-test:
	docker compose exec backend php artisan migrate:fresh
	docker compose exec backend php artisan migrate:refresh
tinker:
	docker compose exec backend php artisan tinker
dusk:
	docker compose exec backend php artisan dusk --testdox
test:
	docker compose exec backend php artisan test
unit-test:
	docker compose exec backend php artisan test --testsuite Unit
combined-test:
	docker compose exec backend php artisan test --testsuite MinimumOperationCheck --testsuite Feature
optimize:
	docker compose exec backend php artisan optimize
optimize-clear:
	docker compose exec backend php artisan optimize:clear
cache:
	docker compose exec backend composer dump-autoload -o
	@make optimize
	docker compose exec backend php artisan event:cache
	docker compose exec backend php artisan view:cache
cache-clear:
	docker compose exec backend composer clear-cache
	@make optimize-clear
	docker compose exec backend php artisan event:clear
sql:
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'
ide-helper:
	docker compose exec backend php artisan clear-compiled
	docker compose exec backend php artisan ide-helper:generate
	docker compose exec backend php artisan ide-helper:meta
	docker compose exec backend php artisan ide-helper:models --nowrite
stan:
	docker compose exec backend ./vendor/bin/phpstan analyse
cs-fixer:
	docker compose exec backend ./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v
barth:
	docker-compose down --rmi all --volumes --remove-orphans
777:
	sudo chmod 777 -R backend
dev:
	# cd backend && yarn dev
	docker-compose exec web yarn dev
cu:
	docker-compose exec backend composer update
yu:
	cd backend && yarn upgrade && cd ../
make-model:
# make-model name=ModelName
	docker-compose exec backend php artisan make:model $(name) --migration
1:
	@make stan
	@make cs-fixer
	@make ide-helper
