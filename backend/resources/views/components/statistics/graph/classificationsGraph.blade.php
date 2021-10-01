@isset($classifications)
    <div class="chartWrapper_small md:mx-0 mx-auto" style="padding-top:0px!important">
    <canvas id="chartNlpClassfications" width="400px" height="400px"></canvas>
    </div>
<!--進行中のときの動作-->
    <script>
    const chartNlpClassfications_id = document.getElementById('chartNlpClassfications');
          var chartNlpClassfications = new Chart(chartNlpClassfications_id, {
            type: 'pie',
            data: {
              labels: [
              @foreach( $classifications as $classification)
              "{{$classification[0]}}",
              @endforeach],
    
              datasets: [
                {
                    label: '分類',
          
                    data: [
                    @foreach( $classifications as $classification)
                    {{$classification[1]}},
                      @endforeach],
                    backgroundColor: ['#1BA3C6', '#2CB5C0','#30BCAD','#21B087','#33A65C','#A2B627','#D5BB21','#F8B620','#F89217','#F06719'],
                    borderColor: "rgba(75,137,150,0)",
                    weight: 100,
            
                  },
                ],
            },
            options: {
              responsive: true,
              plugins: {
                //公式ドキュメント通りに書いているがうまく行かない
                //https://www.chartjs.org/docs/latest/configuration/legend.html
                  legend: {
                      display: true,
                      labels: {
                          color: '#f9fff9'
                      }
                  }
              }

            },
          });
    
    </script>

@endisset