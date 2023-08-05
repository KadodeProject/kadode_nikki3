# たまに失敗する？？
docker compose exec -T backend php artisan openapi:generate >./frontend/openapi/backend.json
docker compose exec -T frontend rm -rf src/apiSchema
docker compose exec -T frontend pnpm openapi2aspida -i ./openapi/backend.json -o src/apiSchema
# 設定ファイルではどうやってもexclude効かないので刺客を差し込む
# tsconfig.jsonのexcludeでは//src/apiSchema/$api.tsだけは効かないが、それより下のディレクトリは有効っぽいので、src/apiSchema/$api.tsだけはコメントで対処している
docker compose exec -T frontend sed -i '1i // @ts-nocheck' src/apiSchema/\$api.ts
docker compose exec -T frontend sed -i '1i // eslint-disable-next-line @typescript-eslint/ban-ts-comment' src/apiSchema/\$api.ts
# git checkoutとかでエラーにならないように権限強くする
docker compose exec -T frontend chmod 777 -R src/apiSchema
