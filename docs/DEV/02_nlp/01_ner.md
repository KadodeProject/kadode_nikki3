# 固有表現に関して

# 固有表現ラベル

関根の拡張固有表現階層 ver7.1.2(以下 v7)に加えかどで日記で一部ラベルを追加

## 関根の拡張固有表現階層　 ver7.1.2

https://nlp.cs.nyu.edu/ene/ene_j_20160801/Japanese_7_1_2_160917.htm

## 追加固有表現ラベル

| 番号 |    ラベル英名     |   ラベル日本語名   |        例        |
| :--: | :---------------: | :----------------: | :--------------: |
|  1   |     Animation     |   アニメタイトル   | たまこまーけっと |
|  2   | Library_Framework |    ライブラリ名    |     Laravel      |
|  3   | Programming_Lang  | プログラミング言語 |       PHP        |

※これらはあくまでラベルだけであって、該当する固有表現ルールがない場合は機能しません。

## 固有表現抽出ルール

GiNZA 同封の学習モデル

＋

独自の固有表現をパッケージ化したもの(ユーザーが選択したもの)

＋

ユーザーが定義した固有表現

＋

※また全ユーザーに

```
{'label':'Product_Other','pattern':'かどで日記'}
```

の固有表現ルールも追加されています。

## 技術的な説明

関根の拡張固有表現階層 ver7.1.2 採用理由

-   GiNZA 自体は ver7 時代のものを使用しているため
-   今後 GiNZA の v8 採用が起きた場合、互換性が無くなりデータの破損が起きうるが、そのときは別テーブル作成で対処

## 関根の拡張固有表現階層

ただし GiNZA が使っているのはこれの Ver7。(現在最新は Ver8.1)

Ver7 の定義一覧

https://nlp.cs.nyu.edu/ene/ene_j_20160801/Japanese_7_1_2_160917.htm

---

Ver8.1

http://liat-aip.sakura.ne.jp/ene/ene8/definition_jp/html/enetree.html

分類がさらに細分化されており、ソフトウェア名やチャンネル名と言った時代に合わせた追加がなされている。

---

https://megagonlabs.github.io/ginza/

https://anlp.jp/proceedings/annual_meeting/2020/pdf_dir/P1-34.pdf
