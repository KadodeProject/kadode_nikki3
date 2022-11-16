/**
 * /homeの今日の日記のtextareaを途中から下記始めやすいようにするJS
 * textareaの後ろまで最初にスクロールしておく
 */
const element = document.getElementById("diary-content");
element.scrollTop = element.scrollHeight;
