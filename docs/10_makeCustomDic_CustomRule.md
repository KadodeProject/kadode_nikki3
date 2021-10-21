# 辞書と固有表現ルール追加について

本体データは git 管理していません。.example をコピーして利用してください。

# GiNZA(sudachi)でカスタム辞書を作る

sudachi_custom_dic.csv.example をコピーして sudachi_custom_dic.csv を作成する

https://github.com/WorksApplications/Sudachi/blob/develop/docs/user_dict.md

上記リンクを元に値を記入していく

## ローカル Docker での手法

辞書の位置：/usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic

カスタム辞書の位置：/work/backend/python/nlp/dic/sudachi_custom_dic.csv

### コンパイル

```
sudachipy ubuild \
-s /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic \
/work/backend/python/nlp/dic/sudachi_custom_dic.csv

```

### 権限付与

```
chmod 777 /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources
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
