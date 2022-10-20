# 自然言語処理に関して

[固有表現に関して](01_ner.md)

## venv

リポジトリごとに pip を管理できる venv を利用しています。

```
dc exec backend bash
```

source kadode_py/bin/activate

```

```

## 現状のパイプライン

1. ('tok2vec', spacy.pipeline.tok2vec.Tok2Vec)
1. ('parser', spacy.pipeline.dep_parser.DependencyParser)
1. ('ner', spacy.pipeline.ner.EntityRecognizer)
1. ('morphologizer', spacy.pipeline.morphologizer.Morphologizer)
1. ('compound_splitter', ginza.compound_splitter.CompoundSplitter)
1. ('bunsetu_recognizer', ginza.bunsetu_recognizer.BunsetuRecognizer)
1. ('entity_ruler', spacy.pipeline.entityruler.EntityRuler)←2021/10/26 追加

## 形態素解析、係り受け解析、固有表現抽出解析、コサイン類似度抽出、形態素解析

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

# ラベル

http://liat-aip.sakura.ne.jp/ene/ene8/definition_jp/html/enedetail.html

---

# 辞書と固有表現ルール追加について

本体データは git 管理していません。.example をコピーして利用してください。

```
cd /work/backend/python/nlp/dic

vim sudachi_custom_dic.csv

```

# GiNZA(sudachi)でカスタム辞書を作る

sudachi_custom_dic.csv.example をコピーして sudachi_custom_dic.csv を作成する

https://github.com/WorksApplications/Sudachi/blob/develop/docs/user_dict.md

上記リンクを元に値を記入していく

## ローカル Docker での手法

辞書の位置：/usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic

カスタム辞書の位置：/work/backend/python/nlp/dic/sudachi_custom_dic.csv

### 権限付与

```
chmod 777 -R /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/
```

### コンパイル

```
sudachipy ubuild \
-s /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic \
/work/backend/python/nlp/dic/sudachi_custom_dic.csv

```

### 追加

```
vim /usr/local/lib/python3.7/dist-packages/sudachipy/resources/sudachi.json

"systemDict" : "",
    "characterDefinitionFile" : "char.def",
    "userDict" : ["/usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/user.dic"],←これ
    "inputTextPlugin" : [

```

## サーバー側での手法

サーバー側はセキュリティ的に notion に記載

### 参考

https://note.com/npaka/n/n6fa359ac611c
"

# GiNZA で固有表現抽出のルール追加

RegisterEntityRule.py.example をコピーして RegisterEntityRule.py を作成

```
cd /work/backend/python/nlp/dic/EntityRule

vim RegisterEntityRule.py

python3 RegisterEntityRule.py

```

## ラベル名

GiNZA がラベル体系を変えているため詳細は不明だが、関根の拡張固有表現階層を元にされているらしく、それを見ながら追加

-   GiNZA
    https://megagonlabs.github.io/ginza/
-   関根の拡張固有表現階層 http://liat-aip.sakura.ne.jp/ene/ene8/definition_jp/html/enedetail.html

## 登録

RegisterEntityRule.py を実行

## 独自追加したラベル

-   Animation[アニメ名]

### 参考

https://note.com/lizefield/n/n18fcac42afea
