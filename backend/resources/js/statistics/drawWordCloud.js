import * as d3 from "d3";
import * as d3_cloud from "d3-cloud";
//JSON_UNESCAPED_UNICODEで日本語文字化け防止
window.drawWordCloud = function drawWordCloud(TARGET_ELEMENT_ID, data) {
    // TARGET_ELEMENT_ID→描画先
    const h = 300;
    const w = 300;

    let random = d3.randomIrwinHall(2);
    let countMax = d3.max(data, function (d) {
        return d.count;
    });
    let sizeScale = d3.scaleLinear().domain([0, countMax]).range([10, 100]);

    let words = data.map(function (d) {
        return {
            text: d.word,
            size: sizeScale(d.count), //頻出カウントを文字サイズに反映
        };
    });
    d3_cloud()
        .size([w, h])
        .words(words)
        .rotate(function () {
            return (~~(Math.random() * 6) - 3) * 30;
        })
        .font("Impact")
        .fontSize(function (d) {
            return d.size;
        })
        .on("end", draw) //描画関数の読み込み
        .start();

    // wordcloud 描画
    function draw(words) {
        d3.select(TARGET_ELEMENT_ID)
            .append("svg")
            .attr("class", "ui fluid image") // style using semantic ui
            .attr("viewBox", "0 0 " + w + " " + h) // ViewBox : x, y, width, height
            .attr("width", "100%")
            .attr("height", "100%")
            .append("g")
            .attr("transform", "translate(" + w / 2 + "," + h / 2 + ")")
            .selectAll("text")
            .data(words)
            .enter()
            .append("text")
            .style("font-size", function (d) {
                return d.size + "px";
            })
            .style("font-family", "Kiwi Maru")
            .style("fill", function (d, i) {
                return d3.schemeCategory10[i % 10];
            })
            .attr("text-anchor", "middle")
            .attr("transform", function (d) {
                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
            })
            .text(function (d) {
                return d.text;
            });
    }
};
