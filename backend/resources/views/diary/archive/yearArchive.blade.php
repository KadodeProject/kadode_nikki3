
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
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year+2)}}">{{$year+2}}</a></p>
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year+1)}}">{{$year+1}}</a></p>
            <h1 class="text-center text-5xl my-4 mx-4 pb-2 border-b-2 border-bg-main-color">{{$year}}年</h1>
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year-1)}}">{{$year-1}}</a></p>
            <p class="mx-2 text-xl"><a href="{{url("/diary")."/".($year-2)}}">{{$year-2}}</a></p>
        </div>
        <div class="mt-4 flex justify-center items-center archive-month-menu  mx-auto">
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/1"}}">１月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/2"}}">２月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/3"}}">３月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/4"}}">４月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/5"}}">５月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/6"}}">６月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/7"}}">７月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/8"}}">８月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/9"}}">９月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/10"}}">10月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/11"}}">11月</a></p>
            <p class="mx-2"><a href="{{url("/diary")."/".($year)."/12"}}">12月</a></p>
        </div>
    </div>
    {{-- 年と月の選択バーここまで--}}
    
            <div class="flex w-full m-4 justify-center flex-wrap" >
                @empty($diaries)
                    <h3 class="text-center text-3xl my-20">{{$year}}年{{$month}}月の日記はありません！</h3>
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
                            @slot("feel")
                            {{$diary->feel}}
                            @endslot
                        @endcomponent
                    @endforeach
                @endempty
            </div>
    
        
    </div>
      
@endsection
 