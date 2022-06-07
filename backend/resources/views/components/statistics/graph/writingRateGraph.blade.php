<canvas id="chartWritingRatePerMonth" width="400px" height="400px"></canvas>

<script>
    // 月ごとの日記執筆率
    const chartWritingRatePerMonth_id = document.getElementById('chartWritingRatePerMonth');
    var chartWritingRatePerMonth = new Chart(chartWritingRatePerMonth_id, {
        type: 'bar',
        data: {
            labels: [
            @foreach( $months as $month)
            "{{$month}}",
            @endforeach
            ],

            datasets: [
                {
                label: '月ごとの日記執筆率',
                data:  [
                @foreach( $monthWritingRates as $monthWritingRate)
                {{$monthWritingRate}},
                @endforeach],
                borderColor: "rgba(75,137,150,1)",
                backgroundColor: "rgba(0,0,0,0)",
                hoverBackgroundColor:"rgba(75,137,150,0.9)",
                },
            ],
        },
        options: {
        indexAxis: 'y',
        categoryPercentage: 1.0,
        barPercentage: 1.0,
        elements: {
            bar: {
                borderWidth: 1,
            }
        },
        responsive: true,
        plugins: {
            autocolors: false,
            legend: {
                display:false
            },
            title: {
                display: false,
                text: '月ごとの日記執筆率'
            },
                    // 補助線用ここから
            annotation: {
                annotations: {
                line100: {
                    type: 'line',
                    dada: 'y',
                    value:100,
                    borderColor: '#624464',
                    borderWidth: 3,
                    label: { // ラベルの設定
                        backgroundColor: '#624464',
                        // bordercolor: 'rgba(200,60,60,0.8)',
                        borderwidth: 2,
                        fontSize: 8,
                        fontStyle: 'bold',
                        fontColor: '#f9fff9',
                        xPadding: 10,
                        yPadding: 10,
                        cornerRadius: 3,
                        position: 'left',
                        xAdjust: 0,
                        yAdjust: 0,
                        enabled: true,
                        content: '100%'
                        }
                    }
                }
            },
            // ここまで補助線用
        }
    },
});
</script>
