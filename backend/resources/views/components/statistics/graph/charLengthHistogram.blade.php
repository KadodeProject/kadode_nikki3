<canvas id="charLengthHistogram" width="400px" height="400px"></canvas>

<script>
    //月ごとの合計文字数
    // 月ごとの1日記あたりの平均文字数
    const charLengthHistogram_id = document.getElementById('charLengthHistogram');
    let charLengthHistogram = new Chart(charLengthHistogram_id, {
              type: 'bar',
    data: {
        labels: [
            @foreach( array_keys($char_length_frequency_distribution) as $frequency)
            "{{$frequency}}",
            @endforeach],

        datasets: [
          {
            label: '度数',
            data:  [
                @foreach( array_values($char_length_frequency_distribution) as $value)
            {{$value}},
            @endforeach],
            borderColor: "rgba(75,137,150,1)",
            backgroundColor: "rgba(75,137,150,1)"
          },
        ],
      },
    options: {
        indexAxis: 'x',
                  categoryPercentage: 1.0,
                  barPercentage: 1.0,
      responsive: true,
      plugins: {
        legend: {
          display:false
        },
      }
    },
    });
</script>
