<a href="https://kado.day" style="text-align:center;margin:0 auto;" >
<img src="./kadodeLogoWithUgoku.svg" width="400"/>
</a>

# この web アプリについて

かどで日記は日記を振り返りやすくすることを目指して開発しているサービスです。
その時その時の感情を綴った日記を振り返りやすくする機能を中心に開発を進めています。

https://kadode.usuyuki.net

# Operation

## CI

### バックエンド

[![【backend】PHP Lint (cs-fixer)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-php-cs-fixer.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-php-cs-fixer.yml)
[![【backend】PHP静的解析 (PHPStan)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-phpstan.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-phpstan.yml)

[![【backend】PHPテスト[単体]](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-unitTest.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-unitTest.yml)
[![【backend】PHPテスト[結合]](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-CombinedTest.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/backend-CombinedTest.yml)

### フロントエンド

[![【frontend】Lint (prettier)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/frontend-lint.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/frontend-lint.yml)
[![【frontend】静的解析 (svelte-check)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/frontend-staticAnalysis.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/frontend-staticAnalysis.yml)

(テスト書きなさい！！)

### NLP

(準備中)

### 外部ツール

[![Total alerts](https://img.shields.io/lgtm/alerts/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/alerts/)
[![Language grade: JavaScript](https://img.shields.io/lgtm/grade/javascript/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:javascript)
[![Language grade: Python](https://img.shields.io/lgtm/grade/python/g/Usuyuki/kadode_nikki3.svg?logo=lgtm&logoWidth=18)](https://lgtm.com/projects/g/Usuyuki/kadode_nikki3/context:python)

## CD

[![コンテナ生成とデプロイ](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/automaticDeploy.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/automaticDeploy.yml)

[![かどで日記wiki生成](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/pages/pages-build-deployment/badge.svg)](https://github.com/Usuyuki/kadode_nikki3/actions/workflows/pages/pages-build-deployment)

## 他

[![PR自動ラベル付与](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/label.yml/badge.svg)](https://github.com/KadodeProject/kadode_nikki3/actions/workflows/label.yml)

## Website

![image](https://badgen.net/uptime-robot/status/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/day/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/week/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/month/m791749575-72b5e08236c6f4fb0d2235a7)
![image](https://badgen.net/uptime-robot/response/m791749575-72b5e08236c6f4fb0d2235a7)

# 構成

## リポジトリの構成について

-   backend : かどで日記のバックエンド・フロントエンド(PHP)
-   docs : wiki.kado.day の中身
-   frontend : かどで日記フロントエンド Next.js 化作業中に断念されたディレクトリ(削除予定)
-   frontend_discontinued : かどで日記フロントエンド SvelteKit 化をしているディレクトリ
-   infra : かどで日記のインフラ周り(開発 Docker、本番 k8s)
-   nlp : かどで日記自然言語処理部分(Python)
-   proto : かどで日記の Python と PHP で gRPC するための proto 置き場
-   sampleData : かどで日記のインポート機能の検証で使うためのサンプルデータ
-   script : 開発用のちょっとしたスクリプト置き場

## フロントエンドのコンポーネントの構成について
- atom : コンポーネントの最小単位
- molecule : atomで構成されるコンポーネント(日記のカードなど)
- organism : moleculeで構成されるコンポーネント(最近の日記コーナーなど)

## ポート

-   2000 番台：フロントエンド関連
-   2010 番台：バックエンドメイン関連
-   2020 番台：nlp 関連

# 開発支援

## エイリアスなど
[Makefile](Makefile)をご覧ください

## 開発者向け情報

https://wiki.kado.day

または docs ディレクトリ, GitHub Issues へ (個人開発のため、多くの情報はインターネット上に存在しません)

# 開発おたより

**現在はかどで日記 v3 系「リファクタリングのフェーズ」です!**

## 大域ロードマップ

[大域ロードマップ](docs/ROADMAP/overall.md)

※かどで日記 3 内でのバージョン。かどで日記、かどで日記 2 とは異なる
[v3 系ロードマップ(完了部分)](docs/ROADMAP/v3.md)

## v3 系未リファクタリング

```mermaid
flowchart TD
    312[かどで日記3.12]-->313[かどで日記3.13]
    312-->|array関数の除外|313
    312-->|cs-fixerで無駄に重い処理を消し去る設定を強化する|313
    312-->|意味のないダブルクォーテーションを消し去る|313
    313-->314[かどで日記3.14]
    313-->|既存のバリデーションをFormRequestに置き換える|314
    313-->|Responderの導入によりAPI側と旧blade側の両方で開発できるようにする|314

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
