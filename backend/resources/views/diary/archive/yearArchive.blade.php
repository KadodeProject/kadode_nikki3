
@extends("layouts.main")
@section("title","アーカイブ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
    <h1 class="text-center text-3xl my-4">{{$year}}年</h1>
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
 