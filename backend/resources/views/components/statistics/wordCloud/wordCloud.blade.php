<div>

    <div class="mx-auto p-4 md:w-2/3">
        <div id="wordCloudImportantWords">
        </div>
        <!-- d3.js -->
        <script src="https://d3js.org/d3.v5.js"></script>

        <!-- d3-cloud -->
        <script src="https://cdn.jsdelivr.net/gh/holtzy/D3-graph-gallery@master/LIB/d3.layout.cloud.js"></script>
        <!-- 描画 -->
        <script type="text/javascript">
            var TARGET_ELEMENT_ID = '#wordCloudImportantWords'; // 描画先
            var data={!!$wordCloud_json!!};
            var h = 300;
            var w = 300;

            var random = d3.randomIrwinHall(2);
            var countMax = d3.max(data, function(d){ return d.count} );
            var sizeScale = d3.scaleLinear().domain([0, countMax]).range([10, 100])

            var words = data.map(function(d) {
                return {
                text: d.word,
                size: sizeScale(d.count) //頻出カウントを文字サイズに反映
                };
            });

            d3.layout.cloud().size([w, h])
                .words(words)
                .rotate(function() { return (~~(Math.random() * 6) - 3) * 30; })
                .font("Impact")
                .fontSize(function(d) { return d.size; })
                .on("end", draw) //描画関数の読み込み
                .start();

            // wordcloud 描画
            function draw(words) {
                d3.select(TARGET_ELEMENT_ID)
                .append("svg")
                    .attr("class", "ui fluid image") // style using semantic ui
                    .attr("viewBox", "0 0 " + w + " " + h )  // ViewBox : x, y, width, height
                    .attr("width", "100%")
                    .attr("height", "100%")
                .append("g")
                    .attr("transform", "translate(" + w / 2 + "," + h / 2 + ")")
                .selectAll("text")
                    .data(words)
                .enter().append("text")
                    .style("font-size", function(d) { return d.size + "px"; })
                    .style("font-family", "Kiwi Maru")
                    .style("fill", function(d, i) { return d3.schemeCategory10[i % 10]; })
                    .attr("text-anchor", "middle")
                    .attr("transform", function(d) {
                    return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                    })
                    .text(function(d) { return d.text; });
            }

        </script>
    </div>

</div>
