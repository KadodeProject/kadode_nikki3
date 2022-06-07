<canvas id="chartCharactersPerMonth" width="400px" height="400px"></canvas>

<script>
    //月ごとの合計文字数
  // 月ごとの1日記あたりの平均文字数
  const chartCharactersPerMonth_id = document.getElementById('chartCharactersPerMonth');
  let chartCharactersPerMonth = new Chart(chartCharactersPerMonth_id, {
            type: 'line',
  data: {
      labels: [
          @foreach( $months as $month)
          "{{$month}}",
          @endforeach],

      datasets: [
        {
          label: '月ごとの平均文字数推移',
          data:  [
          @foreach( $month_words_per_diaries as $month_words_per_diary)
          {{$month_words_per_diary}},
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
