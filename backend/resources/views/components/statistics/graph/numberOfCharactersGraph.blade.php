<div class="chartWrapper">
    <canvas id="chartCharactersPerMonth" width="400px" height="400px"></canvas>
</div>

<script>
    //月ごとの合計文字数
    // 月ごとの1日記あたりの平均文字数
    const chartCharactersPerMonth_id = document.getElementById('chartCharactersPerMonth');
    var chartCharactersPerMonth = new Chart(chartCharactersPerMonth_id, {
              type: 'line',
    data: {
        labels: [
          @foreach( $word_counts as $word_count)
            "{{$month_words_per_diary[0]}}",
            @endforeach],

        datasets: [
          {
            label: '月ごとの平均文字数推移',
            data:  [
            @foreach( $word_counts as $word_count)
            {{$month_words_per_diary[1]}},
            @endforeach],
            borderColor: "rgba(75,137,150,1)",
            backgroundColor: "rgba(0,0,0,0)"
          },
        ],
      },
    options: {
      // animation: {
      //   onComplete: () => {
      //     delayed = true;
      //   },
      //   delay: (context) => {
      //     let delay = 0;
      //     if (context.type === 'data' && context.mode === 'default' && !delayed) {
      //       delay = context.dataIndex * 300 + context.datasetIndex * 100;
      //     }
      //     return delay;
      //   }},
      responsive: true,
      plugins: {
        legend: {
          display:false
        },
      }
    },
    });
</script>