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
	@make 1-n
1-b:
	@make f-b
	@make c-b
	@make ide-helper
1-f:
	@make f-f
	@make c-f
1-n:
	@make f-n
	@make c-n

#
# テスト
#
t-a:
	@make t-b
	@make t-f
	@make t-n

# バックエンド
t-b:
	@make t-bu
	@make t-bf
	# ↓大改修で絶賛コケまくってるので一旦保留
	# @make t-bm
t-bu:
	docker compose exec -T backend php artisan test --testsuite Unit
t-bf:
	docker compose exec -T backend php artisan test --testsuite Feature
t-bm:
	docker compose exec -T backend php artisan test --testsuite MinimumOperationCheck

# フロントエンド
t-f:
	@make t-fu
	@make t-fc
	@make t-fi
	@make t-fr
t-finstall:
	docker compose exec -T frontend npx playwright install
t-fu:
	docker compose exec -T frontend pnpm test:u
t-fc:
	docker compose exec -T frontend pnpm test:c
t-fi:
	docker compose exec -T frontend pnpm test:i
t-fr:
	docker compose exec -T frontend npx playwright show-report --host=0.0.0.0 --port=2802

# NLP
t-n:
	@make t-nu
	@make t-nc
	@make t-ni

t-nu:
	docker compose exec -T nlp pytest tests/unit
t-nc:
	docker compose exec -T nlp pytest tests/combination
t-ni:
	docker compose exec -T nlp pytest tests/integration



#
# format & lint
#
f:
	@make f-b
	@make f-f
	@make f-n

f-b:
	docker compose exec -T backend composer cs-fixer-fix
f-f:
	docker compose exec -T frontend pnpm format
	docker compose exec -T frontend pnpm lint
f-n:
	docker compose exec -T nlp black .
	docker compose exec -T nlp isort .
	docker compose exec -T nlp pflake8 .




#
# 静的解析
#
c:
	@make c-b
	@make c-f
	@make c-n

c-b:
	docker compose exec -T backend composer phpstan
c-f:
	docker compose exec -T frontend pnpm check
c-n:
	# legacyなど従来ファイルは無限にエラーが出てくるので新規で追加するファイルのみを対象にする
	docker compose exec -T nlp mypy ./src



# update
#
u:
	@make u-b
	@make u-f
	@make u-n
u-b:
	docker compose exec -T backend composer update
u-f:
	docker compose exec -T frontend pnpm upgrade
u-n:
	docker compose exec -T nlp poetry update

# init
init-b:
	docker compose exec backend composer install
	docker compose exec backend chmod -R 777 storage bootstrap/cache

init-f:
	docker compose exec frontend pnpm install

init-n:
	docker compose exec nlp poetry install



#
# バックエンド固有のもの
#
cc:
	docker compose exec -T backend php artisan config:cache
	docker compose exec -T backend php artisan route:cache
migrate:
	docker compose exec -T backend php artisan migrate
# DB再構築
fresh:
	docker compose exec -T backend php artisan migrate:fresh --seed
# DBロールバック
refresh:
	docker compose exec -T backend php artisan migrate:refresh
tinker:
	docker compose exec -T backend php artisan tinker
stan:
	@make c-b
stan-b:
	docker compose exec -T backend composer phpstan-g
ide-helper:
	docker compose exec -T backend php artisan clear-compiled
	docker compose exec -T backend php artisan ide-helper:generate
	docker compose exec -T backend php artisan ide-helper:meta
	docker compose exec -T backend php artisan ide-helper:models --nowrite
make-model:
	docker compose exec -T backend php artisan make:model $(name) --migration
	# make-model name=ModelName
# parameterはPHPDocに定義したほうがわかりやすいので使わない
# parameter:
# 	docker compose exec -T backend php artisan openapi:make-parameters $(name)
response:
	docker compose exec -T backend php artisan openapi:make-response $(name)
request:
	docker compose exec -T backend php artisan openapi:make-requestBody $(name)
schema:
	docker compose exec -T backend php artisan openapi:make-schema $(name)


#
# フロントエンド固有のもの
#
dev-f:
	docker compose exec frontend pnpm dev
pnpm-dev:
	docker compose exec -T frontend pnpm dev
pnpm-build:
	docker compose exec -T frontend pnpm build

#
# NLP固有のもの
#

black:
	# previewは原則導入しない
	docker compose exec -T nlp black .
isort:
	docker compose exec -T nlp isort .
flake:
	docker compose exec -T nlp pflake8 .
mypy:
	@make c-n

#
# 開発支援
#
b-log:
	sh script/backend_log.sh
tag:
	sh script/git_tag.sh
openapi:
	sh script/generate_schema.sh
openapi-b:
	docker compose exec -T backend php artisan route:cache
	docker compose exec -T backend php artisan openapi:generate
adr:
	sh script/generate_adr.sh

