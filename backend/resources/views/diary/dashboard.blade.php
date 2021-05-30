
@extends("layouts.main")
@section("title","sun_dock_new")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    <div class="flex flex-wrap m-12">
            <div class="w-40 h-40">
                <p class=" dark:text-white">
                    {{$user->name}}/{{$user->id}}
                </p>
            </div>
            <div class="flex flex-wrap m-12 darl:bg-gray-100">
                @empty($diaries)
                    <h3 class="text-center text-3xl my-20">日記が1つもありません！</h3>
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
    </div>
      
@endsection
 