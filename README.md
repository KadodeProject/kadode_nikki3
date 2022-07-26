# この web アプリについて

個人的に欲しかった統計付き日記管理 web アプリを作っています。

https://kadode.usuyuki.net

# Operation

## CI
### テスト周り
[![PHPテスト[ブラウザ]](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/BrowserTest.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/BrowserTest.yml)
[![PHPテスト[結合]](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/CombinedTest.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/CombinedTest.yml)
[![PHPテスト[単体]](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/unitTest.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/unitTest.yml)
### コード解析
[![PHPコーディング規約遵守チェック](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/php-cs-fixer.yml)
[![PHP静的解析](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/larastanReviewdog.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/larastanReviewdog.yml)

[![Total alerts](https://img.shields.io/lgtm/alerts/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/alerts/)
[![Language grade: JavaScript](https://img.shields.io/lgtm/grade/javascript/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:javascript)
[![Language grade: Python](https://img.shields.io/lgtm/grade/python/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:python)
### 他
[![PRに自動でラベル付けるCI](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/label.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/label.yml)
[![自動デプロイと初期構築](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/automatic_deploy.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/automatic_deploy.yml)



## Web

![image](https://badgen.net/uptime-robot/status/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/day/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/week/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/month/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/response/m791749575-72b5e08236c6f4fb0d2235a7)

## Language

![image](https://img.shields.io/badge/-Python-3776AB.svg?logo=python&style=plastic)
![image](https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=plastic)
![image](https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=plastic)
![image](https://img.shields.io/badge/-Html5-E34F26.svg?logo=html5&style=plastic)
![image](https://img.shields.io/badge/-Css3-1572B6.svg?logo=css3&style=plastic)

![image](https://img.shields.io/badge/Framework-Laravel-F4655F)
![image](https://img.shields.io/badge/Library-TailwindCSS-06B6D4)
![image](https://img.shields.io/badge/Library-Chart.js-FF6384)
![image](https://img.shields.io/badge/Library-GiNZA-5A3B1D)

![image](https://img.shields.io/badge/App-%E3%81%8B%E3%81%A9%E3%81%A7%E6%97%A5%E8%A8%98-624466)

# 開発おたより

**現在はかどで日記v3系「リファクタリングのフェーズ」です!**

## 大域ロードマップ
```mermaid
flowchart LR
    0[かどで日記v0.x]-->|一般向けリリース整備|1[かどで日記v1.x]
    1-->|日記の基本機能整備|2[かどで日記v2.x]
    2[かどで日記v2.x]-->|自然言語処理機能整備|3[かどで日記v3.x]
    3-->|リファクタリング|4[かどで日記v4.x]
    4-->|日記解析機能強化|5[かどで日記v5.x]
```

※かどで日記3内でのバージョン。かどで日記、かどで日記2とは異なる

## v3系終了済みリファクタリング

```mermaid
flowchart TD
    0[かどで日記v2.x]-->|Laravel8.x->9.xへのアップデート|1[かどで日記v3.0]
    0-->|PHP7.4->8.1へのアップデート|1
    1-->|PHPのテスト導入|2[かどで日記v3.1]
    1-->|激重パッケージ管理ページ軽量化|2
    1-->|PHPテストをCIで実行|2
    2-->|PHP静的解析の導入|3[かどで日記v3.2]
    2-->|PHP静的解析をCIで実行|3
    2-->|Labeler導入|3
    3-->|日記表示ページのリニューアル|4[かどで日記v3.3]
    4-->|フロントエンドのビルドをwebpack管理に変更|5[かどで日記v3.4]
    4-->|CSSでのカラー指定をTailwindに移行|5
    5-->|PythonとJSの静的解析導入|A[かどで日記v3.5]
    5-->|Pythonの静的解析で見つかった問題解消|A
    5-->|JSの静的解析で見つかった問題解消|A
    A-->|ControllerからActionへの移行|B[かどで日記v3.6]
    A-->|命名規則の統一|B
    A-->|型の設定|B
    B-->|PHP-CS-Fixerの導入|C[かどで日記v3.7]
    B-->|CIでコードフォーマッタ違反チェック導入|C
    C-->|フロントエンドのビルドをwebpackからViteに変更|D[かどで日記v3.8]
    C-->|CIのpipをキャッシュしてCIテスト速度改善|D
```

## v3系未リファクタリング

```mermaid
flowchart TD
    D[かどで日記v3.8]-->|リポジトリ内のURL指定を全てリバースルート方式に変更|E[かどで日記v3.9]
    D-->|CIのテストを分野ごとに分離する|E
    D-->|検索のcollation問題解消|E
    E-->|ブラウザテストで全体の動作のテストを作成する|E_F[かどで日記v3.10]
    E_F-->|リレーション活用でDBの無駄なアクセスの削減|F[かどで日記v3.11]
    E_F-->|Responderの整備|F
    F-->|Pythonの技術的負債の解体|G[かどで日記v3.12]
    G-->|フロントエンド部分のリファクタリング|H[かどで日記v3.13]
```

## v4系ロードマップ

```mermaid
flowchart LR
    B[かどで日記v4.0]
    B-->|類語付き検索機能|C[かどで日記v4.1]
    C-->|ネガポジ判定精度改善|D[かどで日記v4.2]
    D-->|統計生成の自動化|E[かどで日記v4.3]
    D-->|インフラ大幅変更|E
    E-->|閲覧アシスト機能|F[かどで日記v4.4]
```

# 文章周り

## 開発者向けの情報は、かどで日記 wiki を御覧ください

[かどで日記 wiki](https://github.com/Usuyuki/kadode_nikki3/wiki)

## **ライセンス**

### かどで日記ライセンス

[LICENSE](./LICENSE.md)

    Copyright (c) 2021-2022 usuyuki

    Released under the MIT license

### 使用しているソフトウェアのライセンス表記

[usedLicense.md](./docs/99_usedLicense.md)

## 他

[プライバシーポリシー](https://kadode.usuyuki.net/privacyPolicy)

[利用規約](https://kadode.usuyuki.net/terms)

[このサイトについて](https://kadode.usuyuki.net/aboutThisSite)

[お問い合わせ](https://kadode.usuyuki.net/contact)

[お知らせ](https://kadode.usuyuki.net/osirase)

[リリースノート](https://kadode.usuyuki.net/releaseNote)

![かどでリリースのお知らせ](https://user-images.githubusercontent.com/63891531/124377606-ad6ba080-dce7-11eb-8cf4-af3fc95656ef.png)
