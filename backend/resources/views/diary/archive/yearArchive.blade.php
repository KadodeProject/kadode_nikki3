
@extends("layouts.main")
@section("title","アーカイブ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">

{{-- コンポーネントにするとエラーができるので切り出さずそのまま
    年と月の選択バーここから --}}
    <div class="mt-4 mb-12">
        <div class="flex  justify-around archive-year-menu w-full items-center mx-auto" >
            <p class="mx-2 text-xl sm:block hidden"><a href="{{url("/diary")."/".($year+2)}}">{{$year+2}}</a></p>
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year+1)}}">{{$year+1}}</a></p>
            <h1 class="text-center text-5xl my-4 mx-4 pb-2 border-b-2 border-border-main-color">{{$year}}<span style="font-size:0.5em">年</span></h1>
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year-1)}}">{{$year-1}}</a></p>
            <p class="mx-2 text-xl sm:block hidden"><a href="{{url("/diary")."/".($year-2)}}">{{$year-2}}</a></p>
        </div>
        <div class="mt-4 flex justify-center items-center archive-month-menu  mx-auto sm:flex-nowrap flex-wrap ">
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/1"}}">１月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/2"}}">２月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/3"}}">３月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/4"}}">４月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/5"}}">５月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/6"}}">６月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/7"}}">７月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/8"}}">８月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/9"}}">９月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/10"}}">10月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/11"}}">11月</a></p>
            <p class="mx-2 sm:mb-0 mb-4"><a href="{{url("/diary")."/".($year)."/12"}}">12月</a></p>
        </div>
    </div>
    {{-- 年と月の選択バーここまで--}}
    
            <div class="flex w-full justify-center flex-wrap" >
                @empty($diaries)
                    <h3 class="text-center text-3xl my-20">{{$year}}年の日記はありません！</h3>
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
                            {{$diary->content}}
                            @endslot
                            @slot("date")
                            {{$diary->date}}
                            @endslot
                 
                        @endcomponent
                    @endforeach
                @endempty
            </div>
    
        
    </div>
      
@endsection
 