@extends("layouts.main")
@section("title","ホーム")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
    @empty($unreadNotifications)
    <!--新着通知なし-->
    @else
    <div class="fixed top-over-header right-4 lg:w-1/6 ">
        <!--通知センター-->
        @foreach($unreadNotifications as $new_info)
        @component('components.notification.notification')
        @slot("bg_color")
        {{$new_info["bg_color"]}}
        @endslot
        @slot("url")
        {{$new_info["url"]}}
        @endslot
        @slot("actionUrl")
        {{-- この時点でroute()の値が入っている(Controllerで設定) --}}
        {{$new_info["actionUrl"]}}
        @endslot
        @slot("date")
        {{$new_info["date"]}}
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
            @empty($yesterdayDiary)
            <h3 class="text-center text-3xl my-20 kiwi-maru">昨日の日記なし</h3>
            @else
            @component('components.diary.latestDiaryContent')
            @slot("uuid")
            {{$yesterdayDiary['uuid']}}
            @endslot
            @slot("title")
            {{$yesterdayDiary['title']}}
            @endslot
            @slot("content")
            {{$yesterdayDiary['content']}}
            @endslot
            @slot("date")
            {{$yesterdayDiary['date']}}
            @endslot
            @endcomponent
            @endempty
        </div>
        <div class="sm:order-2 order-1">
            @empty($todayDiary)
            {{-- 今日の日記無いときは、日記フォームを表示 --}}
            @component('components.diary.submitForm')
            @slot("db_method")
            {{route('CreateDiary')}}
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
            {{-- 今日の日記あるときも、日記枠を表示 --}}
            @component('components.diary.submitForm')
            @slot("db_method")
            {{route('UpdateDiary')}}
            @endslot
            @slot("original_uuid")
            {{$todayDiary['uuid']}}
            @endslot
            @slot("original_date")
            {{$todayDiary['date']}}
            @endslot
            @slot("original_title")
            {{$todayDiary['title']}}
            @endslot
            @slot("original_content")
            {{$todayDiary['content']}}
            @endslot
            @endcomponent
            @endempty
        </div>

    </div>
    @empty($latestDiaries)
    <h3 class="text-center text-3xl my-20 kiwi-maru">直近の日記はありません！</h3>
    @else
    <h3 class="text-center text-3xl mt-16 mb-2 kiwi-maru">直近の日記</h3>
    <div class="flex w-auto m-4 overflow-x-auto " style="height: 500px!important">
        @foreach($latestDiaries as $latestDiary )
        @component('components.diary.diaryFrame')
        @slot("uuid")
        {{$latestDiary['uuid']}}
        @endslot
        @slot("title")
        {{$latestDiary['title']}}
        @endslot
        @slot("content")
        {{$latestDiary['content']}}
        @endslot
        @slot("date")
        {{$latestDiary['date']}}
        @endslot
        <!--統計部分の処理ここから-->
        @if($latestDiary['statisticStatus']->value === 1)
        @slot("is_latest_statistic")
        true
        @endslot
        @php
        $emotions=$latestDiary['statistic_per_date']['emotions'];
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
        $words=$latestDiary['statistic_per_date']['important_words'];
        @endphp
        @slot("important_words")
        @if(count($words)>=1)
        {{$words[0]['name']}}
        @else
        false
        @endif
        @endslot
        @php
        $people=$latestDiary['statistic_per_date']['special_people'];
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
            @if($oldDiary['statisticStatus']->value === 1)
            @slot("is_latest_statistic")
            true
            @endslot
            @php
            $emotions=$oldDiary['statistic_per_date']["emotions"];
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
            $words=$oldDiary['statistic_per_date']["important_words"];
            @endphp
            @slot("important_words")
            @if(count($words)>=1)
            {{$words[0]['name']}}
            @else
            false
            @endif
            @endslot
            @php
            $people=$oldDiary['statistic_per_date']["special_people"];
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
