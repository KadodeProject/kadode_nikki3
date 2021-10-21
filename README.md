### meta

![image](https://img.shields.io/github/stars/Usuyuki/kadode_nikki3.svg)

### language

![image](https://img.shields.io/badge/-Python-3776AB.svg?logo=python&style=plastic)
![image](https://img.shields.io/badge/-Php-777BB4.svg?logo=php&style=plastic)
![image](https://img.shields.io/badge/-Javascript-F7DF1E.svg?logo=javascript&style=plastic)
![image](https://img.shields.io/badge/-Html5-E34F26.svg?logo=html5&style=plastic)
![image](https://img.shields.io/badge/-Css3-1572B6.svg?logo=css3&style=plastic)

# この web アプリについて

個人的に欲しかった統計付き日記管理 web アプリを作っています。

https://kadodenikki3.usuyuki.net/

# 文章周り

## **ライセンス**

### かどで日記ライセンス

Copyright (c) 2021 usuyuki

Released under the MIT license

[LICENSE](./LICENSE.md)

### 使用しているソフトウェアのライセンス周り:

[usedLicense.md](./docs/99_usedLicense.md)

## 弊社の取り組み的なやつ？

[プライバシーポリシー](https://kadodenikki3.usuyuki.net/privacyPolicy)

[利用規約](https://kadodenikki3.usuyuki.net/terms)

[このサイトについて](https://kadodenikki3.usuyuki.net/aboutThisSite)

[お問い合わせ](https://kadodenikki3.usuyuki.net/contact)

[お知らせ](https://kadodenikki3.usuyuki.net/news)

[リリースノート](https://kadodenikki3.usuyuki.net/releaseNote)

## 開発者向け

開発者向け: [development.md](./docs/01_development.md)

ローカルインストールで使うコマンド: [installation.md](./docs/02_installation.md)

自然言語処理周りについて [nlp.md](./docs/07_nlp.md)

### 開発者向け機能など

-   Docker さえあればローカル開発可能
-   本番のエラーを Slack 通知
-   GitHub 自動デプロイ
-   DB の自動バックアップ＆別サーバーへ送信

## 名前の由来

かどでは土佐日記の最初の章？である「門出」より引用しました。
3 な理由は、1,2 で挫折(Next.JS を使用)したため、3 回目のリポジトリということで kadode_nikki3 です。

## ロゴ

![kadode_logo](https://user-images.githubusercontent.com/63891531/103437865-f165e600-4c6f-11eb-8d7b-70669e479706.png)

## カラー

背景カラー:<span style="color:#2F3437">#2F3437</span>

文字色:<span style="color:#F9FFF9">#F9FFF9</span>

ロゴカラー:<span style="color:#624466">#624466</span>

枠・ボタンカラー 1:<span style="color:#4B8996">#4B8996</span>

枠・ボタンカラー 2:<span style="color:#8A8772">#8A8772</span>

![image](https://user-images.githubusercontent.com/63891531/122196315-1c688d00-ced2-11eb-8f2f-0b4d04c6340d.png)

## フォント

-   ロゴ

    しょかきリン片

    鉄瓶ゴシック

-   本文

    デフォルト

-   見出し文字

    Kiwi Maru

## 画面レイアウト

Figma に記載(非公開)

# 技術スタック

-   ローカル開発:Docker
-   コード管理:GitHub
-   タスク管理:Asana+Instagantt+Notion
-   UMl 作成:Diagrams
-   デザイン作成:Figma+MSPowerPoint
-   バックエンドフレームワーク:Laravel
-   バックエンド認証:Laravel Jetstream Livewire
-   バックエンドソーシャル認証:Laravel socialite(現在不使用)
-   フロントエンド:Laravel Blade
-   CSS ライブラリ:TailwindCSS
-   アイコン:Material icons
-   フォント:Google Fonts
-   CSV インポートライブラリ:Goodby CSV(メモリ使用軽減)
-   グラフ表示:chart.js
-   形態素解析:janome(mecab ベース)、GiNZAv5
-   GiNZA 形態素解析の辞書:SudachiDict(https://github.com/WorksApplications/SudachiDict)にカスタム辞書として一部単語を追加
-   係り受け解析:GiNZAv5
-   固有表現抽出(Named Entity Recognition; NER):GiNZAv5
-   GiNZA 固有表現抽出ラベル体系、訓練コーパスなど:GiNZA(https://megagonlabs.github.io/ginza/)に一部固有表現抽出ラベルを追加
-   コサイン類似度計算:GiNZAv5
-   DB バックアップ:Laravel-backup,GCP Google Cloud Storage

![かどでリリースのお知らせ](https://user-images.githubusercontent.com/63891531/124377606-ad6ba080-dce7-11eb-8cf4-af3fc95656ef.png)
