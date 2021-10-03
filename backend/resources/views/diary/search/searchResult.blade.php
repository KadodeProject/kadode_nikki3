
@extends("layouts.main")
@section("title","検索")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">


@empty($keyword)
<h1 class="text-center text-3xl my-4 kiwi-maru">検索ページ</h1>
<div style="min-height:100vh">
    @if(count($errors)>0)
    {{-- エラーの表示 --}}
    <ul class="text-red-500 kiwi-maru text-center">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="search-form my-12 flex justify-center">
        <form class="move-label-wrapper flex items-center flex-col flex-wrap "method="POST" action="/search">
            @csrf
        <p class="text-xl sm:text-left text-center kiwi-maru">キーワード検索</p>
        <div>
            <input  autocomplete="off"class="search-keyword" type="search" name="keyword" placeholder="キーワード(2~20字)">
            <input type="submit" class="h-full kiwi-maru"value="検索">
        </div>
        
    </form>
    </div>
</div>
@else
<h1 class="text-center text-3xl my-4 kiwi-maru">「{{$keyword}}」の検索結果 <span class="text-sm">[{{$counter}}件(最大200件)]</span><span class="text-xs">[クエリ時間:{{$queryTime}}ミリ秒]</span></h1>
    @if(count($errors)>0)
    {{-- エラーの表示 --}}
    <ul class="text-red-500 kiwi-maru text-center">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<div class="search-form my-12 flex justify-center">
    <form class="move-label-wrapper flex items-center flex-col flex-wrap "method="POST" action="/search">
            @csrf
        <p class="text-xl sm:text-left text-center kiwi-maru">キーワード検索</p>
        <div>
            <input  autocomplete="off"class="search-keyword" type="search" name="keyword" value="{{$keyword}}" placeholder="キーワード(2~20字)">
            <input type="submit" class="h-full kiwi-maru"value="検索">
        </div>
        
    </form>
</div>

<div class="flex w-full justify-center flex-wrap" >
    @empty($diaries)
        <h3 class="text-center text-3xl my-20 kiwi-maru">「{{$keyword}}」を含む日記はありません！</h3>
    @else
        @foreach($diaries as $diary )
            @component('components.diary.diaryFrame')
                @slot("uuid")
                {{$diary->uuid}}
                @endslot
                @slot("title")
                {{$diary->title}}
                @endslot
                @slot("content")
                {!! $diary->content !!}
                @endslot
                @slot("date")
                {{$diary->date}}
                @endslot
                <!--統計部分の処理ここから-->
                    @if($diary->is_latest_statistic)
                    @slot("is_latest_statistic")
                    true
                    @endslot 
                    @php
                        $emotions=$diary->emotions;
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
                    $words=$diary->important_words;
                    @endphp
                    @slot("important_words")
                        @if(count($words)>=1)
                        {{$words[0]['name']}}
                        @else
                        false
                        @endif
                    @endslot
                    @php
                    $people=$diary->special_people;
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

@endempty
</div>
      
@endsection
 