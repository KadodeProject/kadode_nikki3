//検索フォーカス
/*
    https://codepen.io/charlyn/pen/MwRBBo

    Copyright (c) August 14, 2015 Charlyn G
    Released under the MIT license
    http://opensource.org/licenses/mit-license.php
*/

// 遊びゴコロ
console.log(
    "袖ひちて むすびし水の 凍れるを 春立つ今日の 風や解くらむ\n 紀貫之"
);

const input = document.getElementById("keywordLabel");
const label = document.getElementById("moveLabelJs");
if (input != null) {
    input.addEventListener(
        "focus",
        (event) => {
            event.target.classList.add("active-input");
            label.classList.add("active");
        },
        true
    );
    input.addEventListener(
        "blur",
        (event) => {
            event.target.classList.remove("active-input");
            label.classList.remove("active");
        },
        true
    );
}

//sp本文でバーチャルキーボードの上にfooterメニューでてしまうの防止
if (document.getElementById("diary-content") != null) {
    let textarea = document.getElementById("diary-content");
    let removeFooter = document.getElementById("smFooter");
    textarea.addEventListener("focusin", (e) => {
        removeFooter.classList.add("hidden");
    });
    textarea.addEventListener("focusout", (e) => {
        removeFooter.classList.remove("hidden");
    });
}

// /**
//  * 日記の変更あった時にページ遷移で警告だす←除外処理が手間なので一旦保留
//  */
// function diaryContentChange() {
//     window.addEventListener("beforeunload", function (event) {
//         event.preventDefault();
//         event.returnValue = "";
//     });
// }
// /**提出フォームの時は上のものを除外する */
// let submitButton = document.getElementsByTagName("button");
// $("input[type=submit]").on("click", function () {
//     $(window).off("beforeunload");
// });

/*
    送信時のボタンをかっこよくする
    https://codepen.io/nourabusoud/pen/ypZzMM

    Copyright (c) 2022 by Nour Saud (https://codepen.io/nourabusoud/pen/ypZzMM)
    Released under the MIT license
    http://opensource.org/licenses/mit-license.php
*/
if (document.getElementById("submitDiary") != null) {
    let submitDiaryAnimation = function (e) {
        e.target.classList.remove("animate");

        e.target.classList.add("animate");
        setTimeout(function () {
            e.target.classList.remove("animate");
        }, 400);
    };

    let submitDiaryButton = document.getElementById("submitDiary");

    submitDiaryButton.addEventListener("click", submitDiaryAnimation, false);
}
//ヘッダー時計用桁数調整
// function set2fig(num) {
//     // 桁数が1桁だったら先頭に0を加えて2桁に調整する
//     var ret;
//     if (num < 10) {
//         ret = "0" + num;
//     } else {
//         ret = num;
//     }
//     return ret;
// }

// function showClock() {
//     var nowTime = new Date();
//     // var nowUnixTime = nowTime.getTime();

//     var nowYear = nowTime.getFullYear();
//     // getYearは2000年問題の関係で4桁返してくれないのでgetFullYearを使用
//     var nowMonth = nowTime.getMonth() + 1;
//     //getMonthは0~11で返ってくるので1足した
//     var nowDate = nowTime.getDate();
//     var nowHour = set2fig(nowTime.getHours());
//     var nowMin = set2fig(nowTime.getMinutes());
//     var nowSec = set2fig(nowTime.getSeconds());
//     headerYear.innerHTML = nowYear;
//     headerMonthDate.innerHTML =
//         nowMonth +
//         "<span class='' style='font-size:0.8em'>月</span>" +
//         nowDate +
//         "<span class='' style='font-size:0.8em'>日</span>";
//     headerTime.innerHTML = nowHour + ":" + nowMin + ":" + nowSec;
//     // var time =
//     // "<span class='main-date'>" +
//     // nowYear +
//     // "年" +
//     // nowMonth +
//     // "月" +
//     // nowDate +
//     // "日" +
//     // "</span><span class='main-hour'>" +
//     // nowHour +
//     // ":" +
//     // nowMin +
//     // ":<span class='main-second'>" +
//     // nowSec +
//     // "</span>";
//     // headerClock.innerHTML = time;
//     // var date="<span class='main-date'>" +
//     // nowYear +
//     // "-" +
//     // set2fig(nowMonth) +
//     // "-" +
//     // set2fig(nowDate) +
//     // "</span><span class='main-hour'>" ;
//     // if(document.URL.match("/home")) {

//     //     diaryDate.innerHTML = date;
//     // }
// }
// setInterval("showClock()", 1000);
