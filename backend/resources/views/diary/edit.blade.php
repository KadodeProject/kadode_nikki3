
@extends("layouts.main")
@section("title","編集")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    

            <div class="diary-main">
               
                <div>
                    @component('components.diary.submitForm')
                    @slot("db_method")
                    update
                    @endslot
                    @slot("original_uuid")
                    {{$diary->uuid}}
                    @endslot
                    @slot("original_date")
                    {{$diary->date}}
                    @endslot
                    @slot("original_title")
                    {{$diary->title}}
                    @endslot
                    @slot("original_content")
                    {{$diary->content}}
                    @endslot
                    @slot("original_feel")
                    {{$diary->feel}}
                    @endslot
                    @endcomponent
                </div>
              
     
            </div>
            {{-- <div class="flex w-auto m-4 overflow-y-auto" style="height: 500px;">
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
            </div> --}}
    
        
    </div>
      
@endsection
 