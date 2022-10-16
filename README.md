# この web アプリについて

個人的に欲しかった統計付き日記管理 web アプリを作っています。

## お使いになられる方へ

かどで日記は個人で振り返るサービスです。
整えて書くことを目的としている訳でなく、その時その時の感情を綴った日記を振り返りやすくする機能を中心に開発を進めています。  
外部公開や共同編集などの機能は現在も今後も導入しません。

https://kadode.usuyuki.net

## 開発者向け情報

https://wiki.kado.day

または docs ディレクトリ, GitHub Issues へ

# Operation

## CI

### テスト周り

[![PHPテスト[ブラウザ(Docker版)]](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/BrowserTest_by_docker.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/BrowserTest_by_docker.yml)
[![PHPテスト[結合]](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/CombinedTest.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/CombinedTest.yml)
[![PHPテスト[単体]](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/unitTest.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/unitTest.yml)

### コード解析

[![PHPコーディング規約遵守チェック](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/php-cs-fixer.yml)
[![PHP静的解析](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/larastanReviewdog.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/larastanReviewdog.yml)

[![Total alerts](https://img.shields.io/lgtm/alerts/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/alerts/)
[![Language grade: JavaScript](https://img.shields.io/lgtm/grade/javascript/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:javascript)
[![Language grade: Python](https://img.shields.io/lgtm/grade/python/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:python)

### デプロイ

[![自動デプロイと初期構築](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/automatic_deploy.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/automatic_deploy.yml)

[![かどで日記wiki生成](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/pages/pages-build-deployment/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/pages/pages-build-deployment)

### 他

[![PRに自動でラベル付けるCI](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/label.yml/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/label.yml)

## Website

![image](https://badgen.net/uptime-robot/status/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/day/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/week/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/month/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/response/m791749575-72b5e08236c6f4fb0d2235a7)

# 開発おたより

**現在はかどで日記 v3 系「リファクタリングのフェーズ」です!**

## 大域ロードマップ

[大域ロードマップ](ROADMAP/overall.md)

※かどで日記 3 内でのバージョン。かどで日記、かどで日記 2 とは異なる
[v3 系ロードマップ(完了部分)](ROADMAP/v3.md)

## v3 系未リファクタリング

```mermaid
flowchart TD
    E_F[かどで日記v3.10]-->|ActionのUseCases分離|E_FF[かどで日記v3.11]
    E_F-->|モデル名をpascalCaseに統一|E_FF
    E_F-->|Diaryテーブルから自然言語処理データのカラムを分離|E_FF
    E_F-->|Diaryテーブルから個々の日記のカラムを分離|E_FF
    E_F-->|Userテーブルから通知既読カラムを分離|E_FF
    E_FF-->|リレーション活用でDBの無駄なアクセスの削減|F[かどで日記v3.12]
    E_FF-->|UseCasesの単体テスト整備|F
    E_FF-->|Responderの整備|F
    E_FF-->|FormRequestへの変更|F
    E_FF-->|ブラウザテストで全体の動作のテストを作成する|F
    F-->|Pythonの技術的負債の解体|G[かどで日記v3.13]
    F-->|Pythonのコード責務分割|G
    F-->|Pythonテスト導入|G
    G-->|フロントエンド部分のリファクタリング|H[かどで日記v3.14]
```

※「ブラウザテストで全体の動作のテストを作成する」は出先で Docker を構築して盛大に壊れたので一旦保留。ブラウザテスト環境を Docker で作る難易度が想像以上に高かった

※かどで日記のフロントエンド分離を v4,自然言語処理分離を v5 で予定している。

# 文章周り

## 開発者向けの情報は、かどで日記 wiki を御覧ください

[かどで日記 wiki](https://wiki.kado.day/)

## **ライセンス**

### かどで日記ライセンス

[LICENSE](./LICENSE.md)

    Copyright (c) 2021-2022 usuyuki

    Released under the MIT license

## 他

[プライバシーポリシー](https://kadode.usuyuki.net/privacyPolicy)

[利用規約](https://kadode.usuyuki.net/terms)

[このサイトについて](https://kadode.usuyuki.net/aboutThisSite)

[お問い合わせ](https://kadode.usuyuki.net/contact)

[お知らせ](https://kadode.usuyuki.net/osirase)

[リリースノート](https://kadode.usuyuki.net/releaseNote)

![かどでリリースのお知らせ](https://user-images.githubusercontent.com/63891531/124377606-ad6ba080-dce7-11eb-8cf4-af3fc95656ef.png)
