#
## docker
#
up:
	docker compose up -d
r:
	docker compose restart
b:
	docker compose up -d --build 
s:
	docker compose stop
barth:
	docker-compose down --rmi all --volumes --remove-orphans

sh-b:
	docker compose exec backend bash
sh-f:
	docker compose exec frontend bash
sh-n:
	docker compose exec nlp bash
sh-d:
	docker compose exec db mysql -u root -psecret kadode_local

777:
	sudo chmod 777 -R backend

# 
# コミット前ルーティン
#
1:
	@make 1-b
	@make 1-f
	# @make 1-n
1-b:
	@make f-b
	@make c-b
	@make ide-helper
1-f:
	@make f-f
	@make c-f
# 1-n:
# 	@make f-n
# 	@make c-n

# 
# テスト
# 
t-a:
	@make t-b
	@make t-f
	# @make t-n

# バックエンド
t-b:
	@make t-bu
	@make t-bf
	# ↓大改修で絶賛コケまくってるので一旦保留
	# @make t-bm
t-bu:
	docker compose exec backend php artisan test --testsuite Unit
t-bf:
	docker compose exec backend php artisan test --testsuite Feature
t-bm:
	docker compose exec backend php artisan test --testsuite MinimumOperationCheck

# フロントエンド
t-f:
	@make t-fu
	@make t-fc
	@make t-fi
	@make t-fr
t-finstall:
	docker compose exec frontend npx playwright install 
t-fu:
	docker compose exec frontend pnpm test:u
t-fc:
	docker compose exec frontend pnpm test:c
t-fi:
	docker compose exec frontend pnpm test:i
t-fr:
	docker compose exec frontend npx playwright show-report --host=0.0.0.0 --port=2802

# NLP
# t-n:
# 	@make t-nu
# 	@make t-nc
# 	@make t-ni
#
# t-nu:
# 	docker compose exec nlp pytest -m unit
# t-nc:
# 	docker compose exec nlp pytest -m component
# t-ni:
# 	docker compose exec nlp pytest -m integration



#
# format & lint
# 
f:
	@make f-b
	@make f-f
	# @make f-n

f-b:
	docker compose exec backend ./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v
f-f:
	docker compose exec frontend pnpm format
	docker compose exec frontend pnpm lint
# f-n:




# 
# 静的解析
# 
c:
	@make c-b
	@make c-f
	# @make c-n

c-b:
	docker compose exec backend ./vendor/bin/phpstan analyse
c-f:
	docker compose exec frontend pnpm check
# c-n:
#
#
# update
#
u:
	@make u-b
	@make u-f
	@make u-n
u-b:
	docker compose exec backend composer update
u-f:
	docker compose exec frontend pnpm upgrade
u-n:
	docker compose exec nlp poetry update




# 
# バックエンド固有のもの
# 
cc:
	docker compose exec backend php artisan config:clear
	docker compose exec backend php artisan route:clear
migrate:
	docker compose exec backend php artisan migrate
# DB再構築
fresh:
	docker compose exec backend php artisan migrate:fresh --seed
# DBロールバック
refresh:
	docker compose exec backend php artisan migrate:refresh
tinker:
	docker compose exec backend php artisan tinker
stan:
	@make c-b
stan-g:
	docker compose exec backend ./vendor/bin/phpstan analyse --generate-baseline 
ide-helper:
	docker compose exec backend php artisan clear-compiled
	docker compose exec backend php artisan ide-helper:generate
	docker compose exec backend php artisan ide-helper:meta
	docker compose exec backend php artisan ide-helper:models --nowrite
make-model:
# make-model name=ModelName
	docker-compose exec backend php artisan make:model $(name) --migration


# 
# フロントエンド固有のもの
# 
f-dev:
	docker compose exec frontend pnpm dev
f-build:
	docker compose exec frontend pnpm build

# 
# NLP固有のもの
# 


#
# 開発支援
#
b-log:
	sh script/backend_log.sh
tag:
	sh script/git_tag.sh
