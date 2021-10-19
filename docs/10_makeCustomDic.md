## GiNZA(sudachi)でカスタム辞書を作る

### ローカルで

辞書の位置：/usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic

カスタム辞書の位置：/work/backend/python/nlp/dic/sudachi_custom_dic.csv

## コンパイル

```
sudachipy ubuild \
-s /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/system.dic \
/work/backend/python/nlp/dic/sudachi_custom_dic.csv

```

## 権限付与

```
chmod 777 /usr/local/lib/python3.7/dist-packages/sudachidict_core/resources
```

## 追加

```
vim /usr/local/lib/python3.7/dist-packages/sudachipy/resources/sudachi.json

"systemDict" : "",
    "characterDefinitionFile" : "char.def",
    "userDict" : ["/usr/local/lib/python3.7/dist-packages/sudachidict_core/resources/user.dic"],←これ
    "inputTextPlugin" : [

```

## サーバー

サーバー側はセキュリティ的に notion に記載

### 参考

https://note.com/npaka/n/n6fa359ac611c
"
