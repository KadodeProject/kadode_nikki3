@extends("layouts.main")
@section("title","ホーム")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
    @empty($new_infos)
    <!--新着通知なし-->
    @else
    <div class="fixed top-over-header right-4 lg:w-1/6 ">
        <!--通知センター-->
        @foreach($new_infos as $new_info)
        @component('components.notification.notification')
        @slot("bg_color")
        {{$new_info["bg_color"]}}
        @endslot
        @slot("url")
        {{$new_info["url"]}}
        @endslot
        @slot("type")
        {{$new_info["type"]}}
        @endslot
        @slot("date")
        {{$new_info["date"]->format('Y年n月j日')}}
        @endslot
        @slot("title")
        {{$new_info["title"]}}
        @endslot
        @endcomponent
        @endforeach
    </div>
    @endempty


    <div class="diary-main">
        <div class="sm:order-1 order-2">
            @php
            /**
            * 昨日の日記も同一ページで編集したいが、JSの切り替えが手間なため一旦この機能はリバートした。
            * id被りによるJSの意図しない動作（保存時のアニメーションと、ショートカットキーで別日の日記保存)はidかぶらせずすれば治るので、応急処置はできるがコード汚くなるので。
            */
            @endphp
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
            {{$yesterday->date->format("Y年n月j日")}}
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
            {{date("Y-m-d")}}
            @endslot
            @slot("original_title")
            @endslot

            @slot("original_content")
            @endslot
            @endcomponent

            @else
            <!--今日の日記あるときも、日記枠を表示-->
            @component('components.diary.submitForm')
            @slot("db_method")
            update
            @endslot
            @slot("original_uuid")
            {{$today->uuid}}
            @endslot
            @slot("original_date")
            {{$today->date->format("Y-m-d")}}
            @endslot
            @slot("original_title")
            {{$today->title}}
            @endslot
            @slot("original_content")
            {{$today->content}}
            @endslot
            @endcomponent

            @endempty
        </div>

    </div>
    @empty($diaries)
    <h3 class="text-center text-3xl my-20 kiwi-maru">直近の日記はありません！</h3>
    @else
    <h3 class="text-center text-3xl mt-16 mb-2 kiwi-maru">直近の日記</h3>
    <div class="flex w-auto m-4 overflow-x-auto " style="height: 500px!important">
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
        {{$diary->date->format('Y年n月j日')}}
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
    <div class="flex w-auto m-4 overflow-x-auto ">
        @foreach($oldDiaries as $oldDiary )

        <article>
            <p class="text-center kiwi-maru">
                {{$oldDiary["explain"]}}
            </p>
            @empty($oldDiary["uuid"])

            <div class="diary_dashboard m-2 flex justify-center items-center ">
                <p class="text-2xl text-kn_3 kiwi-maru">なし</p>
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