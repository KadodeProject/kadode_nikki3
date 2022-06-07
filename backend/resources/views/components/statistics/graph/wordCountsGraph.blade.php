<canvas id="chartCharactersPerMonth" width="400px" height="400px"></canvas>

<script>
    //月ごとの合計文字数
    // 月ごとの1日記あたりの平均文字数
    const chartCharactersPerMonth_id = document.getElementById('chartCharactersPerMonth');
    let chartCharactersPerMonth = new Chart(chartCharactersPerMonth_id, {
      type: 'line',
      data: {
          labels: [
            @foreach( $word_counts as $word_count)
              "{{$word_count['date']}}",
              @endforeach],

          datasets: [
            {
              label: '文字数推移',
              data:  [
              @foreach( $word_counts as $word_count)
              {{$word_count['words']}},
              @endforeach],
              borderColor: "rgba(75,137,150,1)",
              backgroundColor: "rgba(0,0,0,0)"
            },
          ],
        },
      options:{
          responsive: true,
          plugins:{


          legend: {
              display: false,

          }

        },
      }
    });
</script>
