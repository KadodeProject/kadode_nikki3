@isset($statistic_progress)
    <p class="text-center kiwi-maru mt-12 mb-2">統計全体の解析状況</p>
    <div class="chartWrapper_small" style="padding-top:0px!important">
    <canvas id="chartNlpAnalyzing" width="400px" height="400px"></canvas>
    </div>
<!--進行中のときの動作-->
    <script>
    const chartNlpAnalyzing_id = document.getElementById('chartNlpAnalyzing');
          var chartNlpAnalyzing = new Chart(chartNlpAnalyzing_id, {
              type: 'pie',
              data: {
        labels: ['分析済み','未分析'],
    
        datasets: [
          {
            label: 'NLP進行度',
  
            data:  [{{$statistic_progress}},{{$statistic_progress_remain}}],
            backgroundColor: ['#4B8996', '#8A8772'],
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