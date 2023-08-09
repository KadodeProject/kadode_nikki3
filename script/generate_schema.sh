# 初回は絶対に失敗する
docker compose exec -T backend php artisan route:cache
docker compose exec -T backend php artisan openapi:generate >./frontend/openapi/api.json
docker compose exec -T frontend rm -rf src/apiSchema
# なぜかpnpm経由だとキャッシュを変に経由して動かなくなるので、npx経由で実行する
docker compose exec -T frontend npx openapi2aspida@v0.22.0 -o src/apiSchema -i ./openapi/api.json
# 設定ファイルではどうやってもexclude効かないので刺客を差し込む
# tsconfig.jsonのexcludeでは//src/apiSchema/$api.tsだけは効かないが、それより下のディレクトリは有効っぽいので、src/apiSchema/$api.tsだけはコメントで対処している
docker compose exec -T frontend sed -i '1i // @ts-nocheck' src/apiSchema/\$api.ts
docker compose exec -T frontend sed -i '1i // eslint-disable-next-line @typescript-eslint/ban-ts-comment' src/apiSchema/\$api.ts
# git checkoutとかでエラーにならないように権限強くする
docker compose exec -T frontend chmod 777 -R src/apiSchema
