
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
<!-- ここに置かないとコンポーネントでchar.js使えないので -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
{{-- 補助線引くためのプラグイン↓ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.min.js" integrity="sha512-FuXN8O36qmtA+vRJyRoAxPcThh/1KJJp7WSRnjCpqA+13HYGrSWiyzrCHalCWi42L5qH1jt88lX5wy5JyFxhfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="flex justify-center">
  <div>

      <p class="text-xl ml-4">総文字数 : {{$statistics->total_words}}</p>
      <p class="text-xl ml-4">総日記数 : {{$statistics->total_diaries}}</p>
      <p class="text-xl ml-4">生成日 : {{$statistics->updated_at}}</p>
  </div>
</div>




<div class="px-2">
  <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの1日記あたりの平均文字数推移<span style="font-size:0.5em">(月の合計文字数÷日記数)</span></h3>
    @component('components.statistics.numberOfCharactersGraph',["months"=>$statistics->months,"month_words_per_diaries"=>$statistics->month_words_per_diary])
    @endcomponent

  <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの日記執筆率</h3>
    @component('components.statistics.writingRateGraph',["months"=>$statistics->months,"monthWritingRates"=>$statistics->monthWritingRate])
    @endcomponent

  <!-- ここより自然言語処理の部 -->
  
  @if($statistics->statistic_progress==100)
  <div class="flex justify-center flex-wrap ">
    <div class="md:w-1/2">
      <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる名詞Top50</h3>
      @component('components.statistics.partOfSpeechGraph',["source"=>$statistics->total_noun_asc])
        @slot("slug")
        noun
        @endslot
        @slot("pof_name")
        名詞
        @endslot
      @endcomponent
    </div>
    <div class="md:w-1/2">
      <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる形容詞Top50</h3>
      @component('components.statistics.partOfSpeechGraph',["source"=>$statistics->total_adjective_asc])
      @slot("slug")
      adjective
      @endslot
      @slot("pof_name")
      形容詞
      @endslot
    @endcomponent
    </div>
  </div>
  @elseif($statistics->statistic_progress>=1)
    <h3 class="my-4 text-2xl text-center kiwi-maru">自然言語処理の進行度</h3>
    @component('components.statistics.progressGraph')
      @slot("statistic_progress")
      {{$statistics->statistic_progress}}
      @endslot
      @slot("statistic_progress_remain")
      {{100-($statistics->statistic_progress)}}
      @endslot
    @endcomponent
  @else
  <p class="text-center my-12 text-3xl">自然言語処理が機能していません</p>
  @endif

</div>
@endempty
<div>


<h1 class="text-center mt-12 text-3xl" style="">他の機能については準備中です。</h1>
<p class="text-center mt-12 text-xl mx-2" style="">このページでは、日記全体傾向の表示追加を準備しています。</p>
<img src="img/others/shigureniConstructing2.png" class="mx-auto object-contain h-80 w-80">
</div>
</div>

@endsection
 