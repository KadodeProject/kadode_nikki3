
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
<div class="px-2">
    <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの1日記あたりの平均文字数推移<span style="font-size:0.5em">(月の合計文字数÷日記数)</span></h3>
    <div class="chartWrapper">
        <canvas id="chartCharactersPerMonth" width="400px" height="400px"></canvas>
    </div>
    <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの日記執筆率</h3>
    <div class="chartWrapper">
        <canvas id="chartWritingRatePerMonth" width="400px" height="400px"></canvas>
    </div>
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
          backgroundColor: "rgba(0,0,0,0)"
        },
      ],
    },
  options: {
    indexAxis: 'y',
    scales: {
                yAxes : [{
                    ticks : {
                        max : 100,    
                        min : 0,
                    }
                }]
            },
    elements: {
      bar: {
        borderWidth: 2,
      }
    },
    responsive: true,
    plugins: {
      legend: {
        display:false
      },
      title: {
        display: true,
        text: '月ごとの日記執筆率'
      }
    }
  },
});

    </script>
</div>
@endempty
<div>


<h1 class="text-center mt-12 text-3xl" style="">他の機能については準備中です。</h1>
<p class="text-center mt-12 text-xl mx-2" style="">このページでは、文字数のグラフ化や形態素解析を用いた品詞の傾向の表示を検討しています。</p>
<img src="img/others/shigureniConstructing2.png" class="mx-auto object-contain h-80 w-80">
</div>
</div>

@endsection
 