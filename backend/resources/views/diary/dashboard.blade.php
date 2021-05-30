
@extends("layouts.main")
@section("title","ダッシュボード")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    <div class="flex flex-wrap m-12">

            <div class="diary-main">
                <div>
                    @empty($yesterday)
                        <h3 class="text-center text-3xl my-20">昨日の日記なし</h3>
                    @else
                        @component('components.diary.latestDiaryContent')
                            @slot("uuid")
                            {{$yesterday->uuid}}
                            @endslot
                            @slot("title")
                            {{$yesterday->title}}
                            @endslot
                            @slot("content")
                            {{$yesterday->content}}
                            @endslot
                            @slot("date")
                            {{$yesterday->date}}
                            @endslot
                            @slot("feel")
                            {{$yesterday->feel}}
                            @endslot
                        @endcomponent
                    @endempty
                </div>
                <div>
                    @empty($today)
                        <p id="diaryDate"class=" dark:text-white">
                            本日の日付
                        </p>
                        @component('components.diary.submitForm')
                            
                        @endcomponent
                    @else
                        @component('components.diary.latestDiaryContent')
                            @slot("uuid")
                            {{$today->uuid}}
                            @endslot
                            @slot("title")
                            {{$today->title}}
                            @endslot
                            @slot("content")
                            {{$today->content}}
                            @endslot
                            @slot("date")
                            {{$today->date}}
                            @endslot
                            @slot("feel")
                            {{$today->feel}}
                            @endslot
                        @endcomponent
                    @endempty
                </div>
                    
     
            </div>
            <div class="flex flex-wrap m-12 darl:bg-gray-100">
                @empty($diaries)
                    <h3 class="text-center text-3xl my-20">直近の日記はありません！</h3>
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
 