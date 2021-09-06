
@extends("layouts.main")
@section("title","統計")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main" style="min-height: 100vh">



@empty($statistics)
    <h2 class="text-center text-2xl">統計データはありません。</h2>

    <div class="mt-12">
        <div class="setting">
            <h2 class="text-2xl">統計データ作成(α版)</h2>
            <p class="text-xs">日記数が少ない場合は正しくデータを表示できないことがありますのでご了承ください。</p>
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/makeStatistics">
                @csrf
                <input type="submit" class="text-black" value="統計データを生成する">
            </form>
        </div>
    </div>
    
@else
<div>
  <div class="setting">
      <h2 class="text-2xl">統計データ更新</h2>
      <p class="text-xl ">※24時間以内に更新済みの場合、新たに生成はされません。</p>
      <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updateStatistics">
          @csrf
          <input type="submit" class="text-black" value="統計データを更新する">
      </form>
  </div>
</div>

<div class="flex justify-center">
  <div>

      <p class="text-xl ml-4">総文字数 : {{$statistics->total_words}}</p>
      <p class="text-xl ml-4">総日記数 : {{$statistics->total_diaries}}</p>
      <p class="text-xl ml-4">生成日 : {{$statistics->updated_at}}</p>
  </div>
</div>




<div class="px-2">
  <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの1日記あたりの平均文字数推移<span style="font-size:0.5em">(月の合計文字数÷日記数)</span></h3>
  <div class="chartWrapper">
      <canvas id="chartCharactersPerMonth" width="400px" height="400px"></canvas>
  </div>
  <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの日記執筆率</h3>
  <div class="chartWrapper">
      <canvas id="chartWritingRatePerMonth" width="400px" height="400px"></canvas>
  </div>
  @isset($statistics->total_adjective_asc)
  <div class="flex justify-center flex-wrap ">
    <div class="md:w-1/2">
      <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる名詞Top50</h3>
      <div class="chartWrapper_nlp_long">
        <canvas id="chartTotalNounAsc" width="400px" height="1200px"></canvas>
      </div>
    </div>
    <div class="md:w-1/2">
      <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる形容詞Top50</h3>
      <div class="chartWrapper_nlp_long"  >
        <canvas id="chartTotalAdjectiveAsc" width="400px" height="1200px"></canvas>
      </div>
    </div>
  </div>
  @endisset

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
{{-- 補助線引くためのプラグイン↓ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.min.js" integrity="sha512-FuXN8O36qmtA+vRJyRoAxPcThh/1KJJp7WSRnjCpqA+13HYGrSWiyzrCHalCWi42L5qH1jt88lX5wy5JyFxhfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      //月ごとの合計文字数
      // 月ごとの1日記あたりの平均文字数
      const chartCharactersPerMonth_id = document.getElementById('chartCharactersPerMonth');
      var chartCharactersPerMonth = new Chart(chartCharactersPerMonth_id, {
                type: 'line',
      data: {
          labels: [
              @foreach( $statistics->months as $month)
              "{{$month}}",
              @endforeach],

          datasets: [
            {
              label: '月ごとの平均文字数推移',
              data:  [
              @foreach( $statistics->month_words_per_diary as $month_words_per_diary)
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
      // 月ごとの日記執筆率
      const chartWritingRatePerMonth_id = document.getElementById('chartWritingRatePerMonth');
      var chartWritingRatePerMonth = new Chart(chartWritingRatePerMonth_id, {
          type: 'bar',
          data: {
    labels: [
        @foreach( $statistics->months as $month)
        "{{$month}}",
        @endforeach],

    datasets: [
      {
        label: '月ごとの日記執筆率',
        data:  [
        @foreach( $statistics->monthWritingRate as $monthWritingRate)
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
  // scales: {
  //             yAxes : [{
  //               id:"RateYZiku",
  //                 ticks : {
  //                     max : 100,    
  //                     min : 0,
  //                 }
  //             }],
  //             xAxes : [{
  //               id:"RateXZiku",
  //             }]
  //         },
  
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
            xMin: 100,
            xMax: 100,
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

@isset($statistics->total_adjective_asc)
<script>
  //ここからNLP周り
// 名詞登場順

       const chartTotalNounAsc_id = document.getElementById('chartTotalNounAsc');
        var chartTotalNounAsc = new Chart(chartTotalNounAsc_id, {
          type: 'bar',
          data: {
            labels: [
              @foreach( $statistics->total_noun_asc as $noun)
                "{{$noun['word']}}",
                @endforeach],
                yAxisID: 'meisi_name',

            datasets: [
              {
                xAxisID: 'meisi_count',
                label: '名詞登場順',
                data:  [
                @foreach( $statistics->total_noun_asc as $noun)
                {{$noun['count']}},
                @endforeach],
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
         
              // 'meisi_name':[{
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


const chartTotalAdjectiveAsc_id = document.getElementById('chartTotalAdjectiveAsc');
      var chartTotalAdjectiveAsc = new Chart(chartTotalAdjectiveAsc_id, {
          type: 'bar',
          data: {
    labels: [
      @foreach( $statistics->total_adjective_asc as $noun)
        "{{$noun['word']}}",
        @endforeach],

    datasets: [
      {
        fill: true,
        label: '形容詞登場順',
        data:  [
        @foreach( $statistics->total_adjective_asc as $noun)
        {{$noun['count']}},
        @endforeach],
        borderColor: "rgba(75,137,150,1)",
        backgroundColor:  "rgba(75,137,150,0)",
        hoverBackgroundColor:"rgba(75,137,150,0.9)",

      },
    ],
  },
options: {
  indexAxis: 'y',//	Y軸に対してX軸が変動量となるグラフを描画する
  categoryPercentage: 1.0,
  barPercentage: 1.0,
  scales: {
      
            },
  
  elements: {
    bar: {
      borderWidth: 1,
    }
  },
  // responsive: true,
  plugins: {
    autocolors: false,
    legend: {
      display:false
    },
    title: {
      display: false,
    },
    
  }
},
});


  </script>
@endisset
</div>
@endempty
<div>


<h1 class="text-center mt-12 text-3xl" style="">他の機能については準備中です。</h1>
<p class="text-center mt-12 text-xl mx-2" style="">このページでは、文字数のグラフ化や形態素解析を用いた品詞の傾向の表示を検討しています。</p>
<img src="img/others/shigureniConstructing2.png" class="mx-auto object-contain h-80 w-80">
</div>
</div>

@endsection
 