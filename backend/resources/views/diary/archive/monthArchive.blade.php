@extends("layouts.main")
@section("title","月別アーカイブ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">

    {{-- コンポーネントにするとエラーができるので切り出さずそのまま
    年と月の選択バーここから --}}
    <div class="mt-4 mb-12 kiwi-maru">
        <div class="flex  justify-around archive-year-menu w-full items-center mx-auto">
            <p class="mx-2 text-xl sm:block hidden"><a
                    href="{{route('ShowMonthDiary',['year'=>$year+2,'month'=>$month])}}">{{$year+2}}</a></p>
            <p class="mx-2 text-xl"><a
                    href="{{route('ShowMonthDiary',['year'=>$year+1,'month'=>$month])}}">{{$year+1}}</a></p>
            <h1 class="text-center text-5xl my-4 mx-4 pb-2 border-b-2 border-kn_3">{{$year}}<span
                    style="font-size:0.5em">年</span><br class="sm:hidden">{{$month}}<span
                    style="font-size:0.5em">月</span></h1>
            <p class="mx-2 text-xl"><a
                    href="{{route('ShowMonthDiary',['year'=>$year-1,'month'=>$month])}}">{{$year-1}}</a></p>
            <p class="mx-2 text-xl sm:block hidden"><a
                    href="{{route('ShowMonthDiary',['year'=>$year-2,'month'=>$month])}}">{{$year-2}}</a></p>
        </div>
        <div class="mt-4 flex justify-center items-center archive-month-menu  mx-auto sm:flex-nowrap flex-wrap ">
            @php
            /** @todo ゆめみからの挑戦状で出てきてた処理に置き換える(ただし9月までは全角数字にしたほうが見やすい点が厄介) */
            @endphp
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>1])}}">１月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>2])}}">２月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>3])}}">３月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>4])}}">４月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>5])}}">５月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>6])}}">６月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>7])}}">７月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>8])}}">８月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>9])}}">９月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>10])}}">10月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>11])}}">11月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{route('ShowMonthDiary',['year'=>$year,'month'=>12])}}">12月</a></p>
        </div>
    </div>
    {{-- 年と月の選択バーここまで--}}
    {{-- 統計情報 --}}
    @empty(!$statisticPerMonth)
    @if($statisticPerMonth['statisticStatus']->value === 1)
    @component('components.statistics.frame.statisticFrameForArchive',['ArchiveData'=>$statisticPerMonth])
    @endcomponent
    @elseif($statisticPerMonth['statisticStatus']->value === 3)
    <p class="text-center text-2xl my-4 kiwi-maru">この月のまとめ統計データを生成中です</p>
    @endif
    @else
    <p class="text-center text-xl my-4 kiwi-maru">この月のまとめ統計データはありません</p>
    @endempty
    {{-- 統計情報ここまで --}}

    {{-- 日記のループ --}}
    <div class="flex w-full justify-center flex-wrap">
        @empty($diaries)
        <h3 class="text-center text-3xl my-20 kiwi-maru">{{$year}}年{{$month}}月の日記はありません！</h3>
        @else
        @foreach($diaries as $diary )
        @component('components.diary.diaryFrame')
        @slot("uuid")
        {{$diary['uuid']}}
        @endslot
        @slot("title")
        {{$diary['title']}}
        @endslot
        @slot("content")
        {{$diary['content']}}
        @endslot
        @slot("date")
        {{$diary['date']}}
        @endslot
        <!--統計部分の処理ここから-->
        @if($diary['statisticStatus']->value === 1)
        @slot("is_latest_statistic")
        true
        @endslot
        @php
        $emotions=$diary['statistic_per_date']['emotions'];
        if($emotions>=0.5){
        $emotions_icon="arrow_upward";
        }else{
        $emotions_icon="arrow_downward";
        }
        @endphp
        @slot("emotions")
        {{$emotions_icon}}
        @endslot
        @php
        $words=$diary['statistic_per_date']['important_words'];
        @endphp
        @slot("important_words")
        @if(count($words)>=1)
        {{$words[0]['name']}}
        @else
        false
        @endif
        @endslot
        @php
        $people=$diary['statistic_per_date']['special_people'];
        @endphp
        @slot("special_people")
        @if(count($people)>=1)
        {{$people[0]['name']}}
        @else
        false
        @endif
        @endslot
        @endif
        <!--統計部分の処理ここまで-->
        @endcomponent
        @endforeach
        @endempty
    </div>
    {{-- 日記のループここまで --}}


</div>

@endsection
