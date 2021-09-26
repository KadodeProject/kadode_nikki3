@isset($classifications)
    <div class="chartWrapper_small" style="padding-top:0px!important">
    <canvas id="chartNlpClassfications" width="400px" height="400px"></canvas>
    </div>
<!--進行中のときの動作-->
    <script>
    const chartNlpClassfications_id = document.getElementById('chartNlpClassfications');
          var chartNlpClassfications = new Chart(chartNlpClassfications_id, {
              type: 'pie',
              data: {
        labels: ['分析済み','未分析'],
    
        datasets: [
          {
            label: 'NLP進行度',
  
            data:  [{{$statistic_progress}},{{$statistic_progress_remain}}],
            // backgroundColor: ['#4B8996', '#8A8772'],
            borderColor: "rgba(75,137,150,0)",
            weight: 100,
    
          },
        ],
      },
    options: {
      responsive: true,
      plugins: {
        autocolors: false,
       
        title: {
          display: false,
        },
        
      }
    },
    });
    
    </script>

@endisset