@extends("layouts.main")
@section("title","統計")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main mb-12 mt-12">



    @empty($statistics)
    <div class="statistic-content">

        @include('components.statisticHeading',['icon'=>'report_problem','title'=>'統計データはありません'])
        <div class="mt-12">
            <div class="setting">
                @if($number_of_nikki<30) <p class="text-xl my-2 text-center kiwi-maru">
                    あなたの日記は{{$number_of_nikki}}件です。統計に必要な最低限の日記数を下回っています。<br>日記 が30件を超えるとご利用いただけるようになります。</p>
                    @else
                    <p class="text-xs mt-4 mb-2">日記数が少ない場合は正しくデータを表示できないことがありますのでご了承ください。</p>
                    <form class="flex justify-center flex-wrap flex-col " method="POST"
                        action="{{route('CreateAllStatistic')}}">
                        @csrf
                        <input type="submit" class="text-black bg-kn_2" value="統計データを生成する">
                    </form>
                    @endif

            </div>
        </div>
    </div>

    @else
    <!-- ここに置かないとコンポーネントでchar.js使えないので -->
    @vite(['resources/js/statistics/totalStatistics.js'])


    <div>
        <div class="statistic-content">
            @include('components.statisticHeading',['icon'=>'update','title'=>'統計データ更新'])
            <p class="text-xl text-center my-4 kiwi-maru">※24時間以内に更新済みの場合、新たに生成はされません。</p>
            @if($statistics->statistic_progress>=1 && $statistics->statistic_progress<=99) <h3
                class=" ml-2 text-2xl kiwi-maru align-middle text-center"><span
                    class="material-icons hourglass_animation"
                    style="margin-right:0.25em">hourglass_bottom</span>自然言語処理の進行度</h3>
                <p class="text-center kiwi-maru my-2">※ページをリロードすると更新されます</p>
                <p class="text-center kiwi-maru my-2">※ページを閉じたり他のページに移動しても問題ありません。</p>
                @component('components.statistics.progress.progressDiariesCount')
                @slot("ended_diaries_count")
                {{$ended_diaries_count}}
                @endslot
                @slot("number_of_nikki")
                {{$number_of_nikki}}
                @endslot
                @slot("percecntage")
                {{($ended_diaries_count/$number_of_nikki)*100}}
                @endslot
                @endcomponent
                @component('components.statistics.progress.progressGraph')
                @slot("statistic_progress")
                {{$statistics->statistic_progress}}
                @endslot
                @slot("statistic_progress_remain")
                {{100-($statistics->statistic_progress)}}
                @endslot
                @endcomponent
                @else
                @if($number_of_nikki<30) <p class="text-xl my-2 text-center kiwi-maru">
                    あなたの日記は{{$number_of_nikki}}件です。統計に必要な最低限の日記数を下回っています。<br>日記 が30件を超えるとご利用いただけるようになります。</p>
                    @else
                    <form class="flex justify-center flex-wrap flex-col " method="POST"
                        action="{{route('UpdateAllStatistic')}}">
                        @csrf
                        <input type="submit" class="text-black bg-kn_2" value="統計データを更新する">
                    </form>
                    @endif
                    @endif
                    <p class="text-lg my-2 ml-4 text-center kiwi-maru">前回データ更新日 :
                        {{$statistics->updated_at}}</p>
        </div>
    </div>
    @if($statistics->statistic_progress==100)
    <div class="statistic-content">
        <div class="flex justify-center flex-wrap ">
            <div class="md:w-1/2">
                @include('components.statisticHeading',['icon'=>'info','title'=>'基本情報'])
                <div class="md:ml-24 ml-4">
                    <p class="text-xl ml-4">総文字数 : {{$statistics->total_words}}字</p>
                    <p class="text-xl ml-4">総日記数 : {{$statistics->total_diaries}}日記</p>
                    @php
                    $average=round($statistics->total_words/$statistics->total_diaries,2);
                    @endphp
                    <p class="text-xl ml-4">平均文字数 : {{$average}}字</p>
                    <p class="text-xl ml-4">最古の日記 : {{$oldest_diary_date}}</p>
                </div>
            </div>
            <div class="md:w-1/2 my-12 md:mt-0">
                @include('components.statisticHeading',['icon'=>'settings','title'=>'統計設定'])
                <div class="md:ml-24 ml-4">
                    <a href="/statistics/settings" class="mt-12">
                        <div class="w-60 h-30 rounded-2xl border-kn_2 border-2 flex items-center justify-center py-12">
                            <p class="kiwi-maru ">統計設定を開く</p>
                            <p class="material-icons">open_in_new</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="statistic-content">
        <!-- ここより自然言語処理の部 -->
        @include('components.statisticHeading',['icon'=>'clear_all','title'=>'全体のテキストマイニング'])
        <div class="flex justify-center flex-wrap ">
            <div class="w-full">
                <h3 class="my-4 text-2xl text-center kiwi-maru">分類</h3>
                <div class="chartWrapper mx-auto block" style="padding-top:0px!important">
                    @component('components.statistics.graph.classificationsGraph',['classifications'=>$statistics->classifications])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">お気持ち</h3>
                <div class="p-4 flex items-center justify-center flex-wrap">
                    @component('components.statistics.char.emotionsRateChar',['emotions'=>$statistics->emotions])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">お気持ち推移</h3>
                <div class="chartWrapper_small mx-auto block">
                    @component('components.statistics.graph.emotionsChangeGraph',['emotions'=>$statistics->emotions])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">人物</h3>
                <div>
                    @component('components.statistics.rank.topRank',['count'=>31,'ranked_array'=>$statistics->special_people])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">重要そうな単語</h3>
                <div class="flex justify-center">
                    @component('components.statistics.rank.topRank',['count'=>31,'ranked_array'=>$statistics->important_words])
                    @endcomponent
                </div>
            </div>


            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる<br class="md:hidden">名詞Top50</h3>
                <div class="chartWrapper_nlp_long">
                    @component('components.statistics.graph.partOfSpeechGraph',["source"=>$statistics->total_noun_asc])
                    @slot("slug")
                    noun
                    @endslot
                    @slot("pof_name")
                    名詞
                    @endslot
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">全日記の中でよく使われる<br class="md:hidden">形容詞Top50</h3>
                <div class="chartWrapper_nlp_long">
                    @component('components.statistics.graph.partOfSpeechGraph',["source"=>$statistics->total_adjective_asc])
                    @slot("slug")
                    adjective
                    @endslot
                    @slot("pof_name")
                    形容詞
                    @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>


    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'bar_chart','title'=>'全体の傾向'])
        <div class="flex justify-center flex-wrap ">
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの1日記あたりの<br class="md:hidden">平均文字数推移<br
                        class="md:hidden"><span style="font-size:0.5em">(月の合計文字数÷日記数)</span></h3>
                <div class="chartWrapper">
                    @component('components.statistics.graph.numberOfCharactersGraph',["months"=>$statistics->months,"month_words_per_diaries"=>$statistics->month_words_per_diary])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">月ごとの日記執筆率</h3>
                <div class="chartWrapper">
                    @component('components.statistics.graph.writingRateGraph',["months"=>$statistics->months,"monthWritingRates"=>$statistics->monthWritingRate])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">文字数ヒストグラム</h3>

                <div class="chartWrapper">
                    @component('components.statistics.graph.charLengthHistogram',["char_length_frequency_distribution"=>$char_length_frequency_distribution])
                    @endcomponent
                </div>
            </div>
            <div class="md:w-1/2 mb-6 ">
                <h3 class="my-4 text-2xl text-center kiwi-maru">文字数の多い日記<br class="md:hidden">トップ10</h3>
                <div>
                    @component('components.statistics.char.charLengthRank',["biggerDiaries"=>$biggerDiaries])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

    @empty($anime_timeline)
    @else
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'pets','title'=>'アニメの登場タイムライン'])
        <div>
            @component('components.statistics.graph.animeTimeline',["anime_timeline"=>$anime_timeline])
            @endcomponent
        </div>

    </div>
    @endempty


    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'bar_chart','title'=>'WordCloud'])
        <div>
            @component('components.statistics.visualize.wordCloud',['wordCloud_array'=>$wordCloud_array])
            @endcomponent
        </div>

    </div>
    @elseif($statistics->statistic_progress>=1)
    <p class="text-center my-12 text-3xl kiwi-maru align-middle"><span class="material-icons"
            style="margin-right:0.25em">hourglass_bottom</span>データ生成中<span class="material-icons"
            style="margin-left:0.25em">hourglass_bottom</span></p>
    @else
    <p class="text-center my-12 text-3xl">自然言語処理が機能していません</p>
    @endif
    @endempty
</div>

@endsection
