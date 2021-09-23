## 形態素解析

janome(mecab ベース)を利用

https://mocobeta.github.io/janome/

※GiNZA の形態素解析を使っていないのは深い理由がるわけではなく、歴史的経緯によるものです。

## 形態素解析、係り受け解析、アノテーション解析、コサイン類似度抽出

GiNZA を利用

https://megagonlabs.github.io/ginza/

※サーバーメモリの都合上実行速度重視モデルを採用しています。

GiNZA は transformers モデルを採用されていますが、本サイトではそのモデルでない方を利用しています。予算の都合です。悲しいです………

GiNZA やばすぎません………？？？？

## 形態素解析と辞書

先述の通り GiNZA ですが GiNZA は sudachi を形態素解析に用いています。

ソース:https://megagonlabs.github.io/ginza/developer_reference.html

sudachi の辞書は Sudachi 辞書と呼ばれるものが使われている。これがすごい。

ソース:https://zenn.dev/sorami/articles/c9a506000fd1fbd1cf98

### コサイン類似度

## GiNZA で使える

### 参考記事など

はじめての自然言語処理　第 4 回 spaCy/GiNZA を用いた自然言語処理

https://www.ogis-ri.co.jp/otc/hiroba/technical/similar-document-search/part4.html

何もない所から一瞬で、自然言語処理と係り受け解析をライブコーディングする手品を、LT でやってみた話

https://qiita.com/youwht/items/b047225a6fc356fd56ee
