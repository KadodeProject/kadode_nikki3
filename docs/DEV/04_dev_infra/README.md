# ローカル開発環境に関して

## 必要なもの

-   git
-   Docker
-   make 実行環境

※ Windows の場合は WSL の利用で動作できます。

## 初期構築

```
git clone https://github.com/Usuyuki/kadode_nikki3.git
```

※Windows の場合は WSL で動作する Ubuntu などのディレクトリ配下に置くことを極めて推奨します。(動作速度の都合上)

```
cd kadode_nikki3
```

```
make init
```

## 開発時

フロントエンド部分を触る場合

```
cd backend && yarn dev
```

テスト

```
make test
```

ブラウザテスト

```
make dusk
```
