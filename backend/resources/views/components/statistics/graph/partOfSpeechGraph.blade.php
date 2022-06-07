@isset($source)

<canvas id="chartTotal{{$slug}}Asc" width="400px" height="1200px"></canvas>

<script>
    //ここからNLP周り
      // {{$pof_name}}登場順
             const chartTotal{{$slug}}Asc_id = document.getElementById('chartTotal{{$slug}}Asc');
              var chartTotal{{$slug}}Asc = new Chart(chartTotal{{$slug}}Asc_id, {
                type: 'bar',
                data: {
                labels: [
                        @foreach( $source as $value)
                        "{{$value[0]}}",
                        @endforeach
                ],
                yAxisID: "{{$slug}}_name",

                datasets: [
                    {
                      xAxisID: "{{$slug}}_count",
                      label: "{{$pof_name}}登場順",
                      data:  [
                        @foreach( $source as $value)
                        {{$value[1]}},
                      @endforeach
                      ],
                      borderColor: "rgba(75,137,150,1)",
                      backgroundColor:  "rgba(75,137,150,0)",
                      hoverBackgroundColor:"rgba(75,137,150,0.9)",
                    },
                  ],
                },
                options: {

                  indexAxis: 'y',
                  categoryPercentage: 1.0,
                  barPercentage: 1.0,
                  scales: {

                    // "{{$slug}}_name":[{
                    //   categoryPercentage: 1.0,
                    //   barPercentage: 1.0
                    // }]
                  },
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
                    },
                    decimation:{
                      enabled: false,
                    },

                  }
                },
              });
</script>

@endisset
