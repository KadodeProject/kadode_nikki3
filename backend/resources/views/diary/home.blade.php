
@extends("layouts.main")
@section("title","ホーム")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    

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
                       
                    @component('components.diary.submitForm')
                    @slot("db_method")
                    create
                    @slot("original_uuid")
                    @endslot
                    @endslot
                    @slot("original_date")
                    null
                    @endslot
                    @slot("original_title")
                    @endslot
                    @slot("original_feel")
                    4
                    {{-- ここは5だがjsの都合で-1してる --}}
                    @endslot
                    @slot("original_content")
                    @endslot
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
            <div class="flex w-auto m-4 overflow-y-auto" style="height: 500px;">
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
      
@endsection
 