# poetry

ライブラリ追加

```
poetry add ja-ginza
```

アップデート

```
poetry update
```

# grpc

参考にさせていただいた記事 →https://zenn.dev/kumamoto/articles/0596ed47f33965

proto ファイルからの生成

```
dc exec nlp python ./proto/codegen.py
```

# 手動実行

```
docker compose exec nlp python legacy/pythonUseFromPHP.py 1
```
