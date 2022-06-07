<canvas id="chartEmotionsGraph" width="400px" height="400px"></canvas>

<script>
    //月ごとの合計文字数
    // 月ごとの1日記あたりの平均文字数
    const chartEmotionsGraph_id = document.getElementById('chartEmotionsGraph');
    var chartEmotionsGraph = new Chart(chartEmotionsGraph_id, {
        type: 'line',
        data: {
            labels: [
            @foreach( $emotions as $emotion)
                "{{$emotion['date']}}",
                @endforeach],

            datasets: [
            {
                label: '感情推移',
                data:  [
                @foreach( $emotions as $emotion)
                {{$emotion['value']}},
                @endforeach],
                borderColor: "rgba(75,137,150,1)",
                backgroundColor: "rgba(0,0,0,0)"
            },
            ],
        },
        options:{
            responsive: true,
            scales: {
                y: {
                    min: 0,
                    max: 1,
                }
            },
            plugins:{
                            // 補助線用ここから
                annotation: {
                annotations: {
                    line0: {
                        type: 'line',
                        yMin: 0,
                        yMax: 0,
                        borderColor: 'rgba(226, 83, 74,0.4)',
                        borderWidth: 1,
                        label: { // ラベルの設定
                                // backgroundColor: '#624464',
                                backgroundColor: 'rgba(226, 83, 74,0.4)',
                                borderwidth: 2,
                                fontSize: 8,
                                fontStyle: 'bold',
                                fontColor: '#f9fff9',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'left',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'negative'
                            }
                    },
                    line50: {
                        type: 'line',
                        yMin: 0.5,
                        yMax: 0.5,
                        borderColor: 'rgba(98, 68, 100,0.4)',
                        borderWidth: 1,
                        label: { // ラベルの設定
                                // backgroundColor: '#624464',
                                backgroundColor: 'rgba(98, 68, 100,0.4)',
                                borderwidth: 2,
                                fontSize: 8,
                                fontStyle: 'bold',
                                fontColor: '#f9fff9',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'left',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'normal'
                            }
                    },
                    line100: {
                        type: 'line',
                        yMin: 1,
                        yMax: 1,
                        borderColor: 'rgba(51, 156, 118,0.4)',
                        borderWidth: 1,
                        label: { // ラベルの設定
                                // backgroundColor: '#624464',
                                backgroundColor: 'rgba(51, 156, 118,0.4)',
                                borderwidth: 2,
                                fontSize: 8,
                                fontStyle: 'bold',
                                fontColor: '#f9fff9',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'left',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'positive'
                            }
                    },
                }
                },
                // ここまで補助線用


            legend: {
                display: false,
            },

        }      }
    });
</script>
