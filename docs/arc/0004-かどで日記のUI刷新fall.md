# ADR 4 : かどで日記の UI 刷新 2022fall

<!-- ADR ナンバー : タイトル -->

## Status :🟡 提案

<!--
※ここから選んでステータスの横に貼っ付ける
🟡提案
🟢承認
🔴廃止
-->

## Context

<!--
問題の背景や定義
事実だけを描く
-->

かどで日記の UI を全面刷新する。

## Decision

<!-- 提案、すること -->

かどで日記のフロントエンドを変えるタイミングで UI を刷新する。
SPA に最適化された UI を提供する。
ダークモード変更対応も行う。

## Consequences

<!-- Decisionによって得られるもの -->

### Pros

-   SPA 前提での UI が作れる
-   初期 UI 構築後に作成した UI との統一感を持たせられる
-   利用ユーザーがほぼいない状態での変更のため、ユーザー周知の手間が省ける
-   根底が変わるため移植の手間が省ける
-   ダークモード対応を最初からしておける貴重なタイミング
-   カラースキーマの名称がひどすぎるので整えたい

### Cons

-   工数増加
-   UI 設計によりフロントエンドの導入が遅れる

## Notes

Win11 の 22H2 や VRChat など最近のモダン UI 要素を取り込みたい。

## References

https://github.com/KadodeProject/kadode_nikki3/issues/349

VRChat の新しい UI
https://hello.vrchat.com/blog/main-menu-open-beta

Win11 の UI
https://blogs.windows.com/japan/2021/07/30/windows-11-designing-the-next-generation-of-windows/
