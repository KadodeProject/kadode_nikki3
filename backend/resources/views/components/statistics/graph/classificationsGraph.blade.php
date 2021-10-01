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
                        // backgroundColor: ['#4B8996', '#8A8772'],
                        borderColor: "rgba(75,137,150,0)",
                        weight: 100,
                
                      },
                    ],
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      autocolors: true,
                      colorschemes: {
                      scheme: 'tableau.HueCircle19'
                      },
                      //↓効かない
                      legend: {
                        labels: {
                            fontColor: "#f9fff9",
                        }
                      },
                      title: {
                        display: false,
                      },
                      
                    }
                  },
          });
    
    </script>

@endisset