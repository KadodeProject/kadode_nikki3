
@extends("layouts.main")
@section("title","検索")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">


@empty($keyword)
<h1 class="text-center text-3xl my-4">検索ページ</h1>
<div style="min-height:100vh">
    @if(count($errors)>0)
    {{-- エラーの表示 --}}
    <ul class="text-red-500 text-center">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="search-form my-12 flex justify-center">
        <form class="move-label-wrapper flex items-center "method="POST" action="/search">
            @csrf
            <p class="text-xl">キーワード検索</p>
            <div>
                <input  autocomplete="off"class="search-keyword" type="search" name="keyword"  placeholder="キーワード(2~20字)">
            </div>
            <input type="submit" class="h-full"value="検索">
            
        </form>
    </div>
</div>
@else
<h1 class="text-center text-3xl my-4">「{{$keyword}}」の検索結果 <span class="text-sm">[{{$counter}}件(最大200件)]</span><span class="text-xs">[クエリ時間:{{$queryTime}}ミリ秒]</span></h1>
    @if(count($errors)>0)
    {{-- エラーの表示 --}}
    <ul class="text-red-500 text-center">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
<div class="search-form my-12 flex justify-center">
    <form class="move-label-wrapper flex items-center "method="POST" action="/search">
        @csrf
    <p class="text-xl">キーワード検索</p>
    <div>
        <input  autocomplete="off"class="search-keyword" type="search" name="keyword" value="{{$keyword}}" placeholder="キーワード(2~20字)">
    </div>
    <input type="submit" class="h-full"value="検索">
        
</form>
</div>

<div class="flex w-full m-4 justify-center flex-wrap" >
    @empty($diaries)
        <h3 class="text-center text-3xl my-20">「{{$keyword}}」を含む日記はありません！</h3>
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
                @slot("feel")
                {{$diary->feel}}
                @endslot
            @endcomponent
        @endforeach
    @endempty
</div>

@endempty
</div>
      
@endsection
 