
@extends("layouts.main")
@section("title","ホーム")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    

            <div class="diary-main">
                <div class="sm:order-1 order-2">
                    @empty($yesterday)
                        <h3 class="text-center text-3xl my-20 kiwi-maru">昨日の日記なし</h3>
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
             
                        @endcomponent
                    @endempty
                </div>
                <div class="sm:order-2 order-1">
                    @empty($today)
                    <!--今日の日記無いときは、日記フォームを表示-->
                    @component('components.diary.submitForm')
                    @slot("db_method")
                    create
                    @slot("original_uuid")
                    @endslot
                    @endslot
                    @slot("original_date")
                    {{$this_day}}
                    @endslot
                    @slot("original_title")
                    @endslot
                    
                    @slot("original_content")
                    @endslot
                    @endcomponent
                    
                    @else
                    <!--今日の日記あるときは、日記枠を表示-->
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
                
                        @endcomponent
                    @endempty
                </div>
                    
     
            </div>
            @empty($diaries)
                <h3 class="text-center text-3xl my-20 kiwi-maru">直近の日記はありません！</h3>
                @else
            <h3 class="text-center text-3xl mt-16 mb-2 kiwi-maru">直近の日記</h3>
            <div class="flex w-auto m-4 overflow-x-auto " style="height: 500px!important" >
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
                </div>
            @endempty

            @empty($oldDiaries)
                <h3 class="text-center text-xl my-20 kiwi-maru">過去の日記が増えると過去の日記が表示されます。</h3>
                @else
            <h3 class="text-center text-3xl mt-16 mb-2 kiwi-maru">過去の日記</h3>
            <div class="flex w-auto m-4 overflow-x-auto " >
                    @foreach($oldDiaries as $oldDiary )
            
                    <article>
                        <p class="text-center kiwi-maru">
                            {{$oldDiary["explain"]}}
                        </p>
                        @empty($oldDiary["uuid"])

                        <div class="diary_dashboard m-2 flex justify-center items-center ">
                            <p class="text-2xl border-main-color kiwi-maru">なし</p>
                        </div>
                        @else
                            @component('components.diary.diaryFrame')
                                @slot("uuid")
                                {{$oldDiary["uuid"]}}
                                @endslot
                                @slot("title")
                                {{$oldDiary["title"]}}
                                @endslot
                                @slot("content")
                                {{$oldDiary["content"]}}
                                @endslot
                                @slot("date")
                                {{$oldDiary["date"]}}
                                @endslot
                                <!--統計部分の処理ここから-->
                                    @if($oldDiary["is_latest_statistic"])
                                    @slot("is_latest_statistic")
                                    true
                                    @endslot 
                                    @php
                                        $emotions=$oldDiary["emotions"];
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
                                    $words=$oldDiary["important_words"];
                                    @endphp
                                    @slot("important_words")
                                        @if(count($words)>=1)
                                        {{$words[0]['name']}}
                                        @else
                                        false
                                        @endif
                                    @endslot
                                    @php
                                    $people=$oldDiary["special_people"];
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
                        @endempty
                    </article>
                    @endforeach
                </div>
            @endempty
    
        
    </div>
      
@endsection
 