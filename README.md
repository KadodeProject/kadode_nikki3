# この web アプリについて

個人的に欲しかった統計付き日記管理 web アプリを作っています。

https://kadode.usuyuki.net

## 開発者向け情報

https://kadodedocs.usuyuki.net

または docs ディレクトリ

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

**現在はかどで日記 v3 系「リファクタリングのフェーズ」です!**

## 大域ロードマップ

[大域ロードマップ](ROADMAP/overall.md)

※かどで日記 3 内でのバージョン。かどで日記、かどで日記 2 とは異なる
[v3 系ロードマップ(完了部分)](ROADMAP/v3.md)

## v3 系未リファクタリング

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
