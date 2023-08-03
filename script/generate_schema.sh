# たまに失敗する？？
docker compose exec -T backend php artisan openapi:generate >./frontend/openapi/backend.json
docker compose exec -T frontend rm -rf apiSchema
docker compose exec -T frontend pnpm openapi2aspida -i ./openapi/backend.json -o apiSchema
# 設定ファイルではどうやってもexclude効かないので刺客を差し込む
docker compose exec -T frontend sed -i '1i // @ts-nocheck' apiSchema/\$api.ts
docker compose exec -T frontend sed -i '1i // eslint-disable-next-line @typescript-eslint/ban-ts-comment' apiSchema/\$api.ts
