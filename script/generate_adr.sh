#!/bin/bash
# タイトルの入力を求める
read -p "タイトルを入力してください: " TITLE
#
# ステータスの入力を求める
echo "ADRのStatusを選択してください:"
echo "1. 🟡提案"
echo "2. 🟢承認"
read -p "全角番号で指定してください (１-２): " choice

# ステータスの設定
if [ "$choice" == "１" ]; then
    STATUS="🟡提案"
elif [ "$choice" == "２" ]; then
    STATUS="🟢承認"
else
    echo "不正な値です"
    exit 1
fi

# docs/arcディレクトリのファイル数を取得
FILE_COUNT=$(ls -1q ./docs/arc/*.md | wc -l)

# 次のファイル番号
NEXT_NUM=$((FILE_COUNT))
NEXT_NUM_FORMAT=$(printf "%04d" $((FILE_COUNT)))

# 新規ファイル名
FILE_NAME="${NEXT_NUM_FORMAT}-${TITLE}"
NEW_FILE="./docs/arc/${FILE_NAME}.md"

# テンプレート内容
TEMPLATE="# ADR ${NEXT_NUM} : ${TITLE}

## Status : ${STATUS}

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


## Decision
<!-- 提案、すること -->


## Consequences
<!-- Decisionによって得られるもの -->


### Pros

### Cons

## Notes

## References
"

# 新規ファイルの作成とテンプレートの書き込み
echo "$TEMPLATE" >$NEW_FILE
echo "新しいADRを作成しました: ${NEW_FILE}"

# README.mdに新しいファイルへのリンクを追加
ENCODED_FILE=$(printf %s ${FILE_NAME} | jq -sRr @uri)
# GitHub Pagesで生成するときに.mdだと文字化けしたファイルになるので、パスのみを記載する
echo "-   [${NEXT_NUM_FORMAT}-${TITLE}](${ENCODED_FILE})" >>./docs/arc/README.md
