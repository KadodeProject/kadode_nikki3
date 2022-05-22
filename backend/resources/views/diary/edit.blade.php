@extends("layouts.main")
@section("title", $diary->date->format("Y年n月j日")."の日記")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main  kiwi-maru ">
    <div class="dateWrapper">
        <nav class="md:order-1 ">
            @isset($next)
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color kiwi-maru"><a
                    style="vertical-align: middle;" href="{{url('/edit/'.$next->uuid)}}"><span
                        class="material-icons">arrow_back</span> {{$next->date->format("Y年n月j日")}}</a></p>
            @else
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color kiwi-maru"><span
                    class="material-icons ">arrow_back</span><span class="material-icons">remove_circle_outline</span>
                日記なし</p>
            @endisset

        </nav>
        <nav class="order-2 md:order-3">
            @isset($previous)
            <p class="md:ml-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color kiwi-maru"><a
                    style="vertical-align: middle;" href="{{url('/edit/'.$previous->uuid)}}">
                    {{$previous->date->format("Y年n月j日")}}<span class="material-icons">arrow_forward</span></a></p>
            @else
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color kiwi-maru">日記なし <span
                    class="material-icons">remove_circle_outline</span><span class="material-icons">arrow_forward</span>
            </p>
            @endisset
        </nav>
        <nav class="order-3 md:order-2 ">
            <h1 class="text-center mt-6 mb-4 mx-4 text-4xl drop-shadow-3xl">
                @empty($diary->title)
                <span class='text-gray-600'>タイトルなし</span>
                @else
                「{{$diary->title}}」
                @endempty
            </h1>
            <h2 class="text-center mt-8 mb-2 mx-4 text-xl">
                {{$diary->date->format('Y年n月j日')}}
            </h2>
        </nav>
    </div>
    <input id="editDiary" type="radio" name="tab_item">
    <label class="tab_item" for="editDiary"><span class="material-icons">edit</span>編集</label>
    <input id="viewDiary" type="radio" name="tab_item" checked>
    <label class="tab_item" for="viewDiary"><span class="material-icons">library_books</span>閲覧</label>
    <input id="viewStatistic" type="radio" name="tab_item">
    <label class="tab_item" for="viewStatistic"><span class="material-icons">analytics</span>統計</label>
    <div class="tab_content" id="editDiaryContent">
        <div class="diary-main">
            <div class="order-3 md:order-2 ">
                @component('components.diary.submitForm')
                @slot("db_method")
                update
                @endslot
                @slot("original_uuid")
                {{$diary->uuid}}
                @endslot
                @slot("original_date")
                {{$diary->date->format("Y-m-d")}}
                @endslot
                @slot("original_title")
                {{$diary->title}}
                @endslot
                @slot("original_content")
                {{$diary->content}}
                @endslot
                @endcomponent
            </div>
        </div>
        @component('components.buttons.editorDiaryButton')
        @slot("delete_uuid")
        {{$diary->uuid}}
        @endslot
        @endcomponent
    </div>
    <div class="tab_content" id="viewDiaryContent">
        @if($diary->statistic_progress==100)
        @if($diary->is_latest_statistic==true)
        <p class="kiwi-maru diaryContentWrapper">{{$diary->content}}</p>
        @else
        <h3 class="kiwi-maru text-sm text-status-poor text-center my-6 mx-2">統計情報が最新でないため、<br
                class="md:hidden">ハイライトはありません</h3>
        <p class="kiwi-maru diaryContentWrapper">{{$diary->content}}</p>
        @endif
        @elseif($diary->statistic_progress==0)
        <h3 class="kiwi-maru text-sm text-status-poor text-center my-6 mx-2">統計情報が生成されていないため、<br
                class="md:hidden">ハイライトはありません</h3>
        <p class="kiwi-maru diaryContentWrapper">{{$diary->content}}</p>
        @else
        <h3 class="kiwi-maru text-sm text-status-poor text-center my-6 mx-2">統計情報を生成中のため、<br
                class="md:hidden">ハイライトはありません</h3>
        <p class="kiwi-maru diaryContentWrapper">{{$diary->content}}</p>
        @endif

    </div>
    <div class="tab_content" id="viewStatisticContent">
        <div class="mb-12  md:w-2/3 md:mx-auto">
            <h2 class="kiwi-maru text-3xl text-center mt-4"><span class="material-icons">science</span>解析情報</h2>
            @if($diary->statistic_progress==100)
            @if($diary->is_latest_statistic==true)
            <p class="text-right md:pr-12 px-2 text-sm mt-2 kiwi-maru">統計作成時刻: {{$diary->updated_statistic_at}}
            </p>
            <div class="flex flex-wrap mx-4 md:mx-8">
                <div class="w-full md:w-1/2">
                    @php
                    $emotions=$diary->emotions;
                    if($emotions>=0.5){
                    $emotions_chr="ポジティブ";
                    }else{
                    $emotions_chr="ネガティブ";
                    }

                    @endphp
                    @component('components.statistics.char.emotionsChar')
                    @slot("emotions_chr")
                    {{$emotions_chr}}
                    @endslot
                    @slot("emotions_num")
                    {{$emotions}}
                    @endslot
                    @endcomponent
                </div>
                {{-- <div class="w-full md:w-1/2">
                    @component('components.statistics.flavorChar')
                    @endcomponent
                </div> --}}
                <div class="w-full md:w-1/2">
                    @component('components.statistics.char.classificationsChar')
                    @slot("classification")
                    {{$diary->classification}}
                    @endslot
                    @endcomponent
                </div>
            </div>
            @component('components.statistics.char.importantWordsChar',["important_words"=>$diary->important_words])

            @endcomponent
            {{-- @component('components.statistics.char.causeEffectChar')
            @endcomponent --}}
            @component('components.statistics.char.specialPeopleChar',["special_people"=>$diary->special_people])

            @endcomponent
            @else
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報が最新でないため表示していません</h3>
            @endif
            @elseif($diary->statistic_progress==0)
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報が生成されていません</h3>
            @else
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報を生成中です</h3>
            @endif
        </div>


        @if($diary->is_latest_statistic==true)
        <div class="mb-4   md:mx-auto">
            @empty($resembleDiaries)
            <h3 class="text-center text-sm my-20 kiwi-maru">関連日記は見つかりませんでした。</h3>
            @else
            <h2 class="kiwi-maru text-3xl text-center mt-4 mb-4"><span class="material-icons">groups</span>関連日記
            </h2>
            <p class="kiwi-maru text-sm text-center mt-4 mb-4 mx-2">※この機能はベータ版です。<br class="md:hidden">日記内に登場する人物から<br
                    class="md:hidden">関連付けしています。
            </p>
            <div class="flex justify-center items-center flex-wrap">
                @foreach($resembleDiaries as $resembleDiary )
                @component('components.diary.diaryFrame')
                @slot("uuid")
                {{$resembleDiary->uuid}}
                @endslot
                @slot("title")
                {{$resembleDiary->title}}
                @endslot
                @slot("content")
                {{$resembleDiary->content}}
                @endslot
                @slot("date")
                {{$resembleDiary->date->format("Y年n月j日")}}
                @endslot
                <!--統計部分の処理ここから-->
                @if($resembleDiary->is_latest_statistic)
                @slot("is_latest_statistic")
                true
                @endslot
                @php
                $emotions=$resembleDiary->emotions;
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
                $words=$resembleDiary->important_words;
                @endphp
                @slot("important_words")
                @if(count($words)>=1)
                {{$words[0]['name']}}
                @else
                false
                @endif
                @endslot
                @php
                $people=$resembleDiary->special_people;
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
        </div>
        @endempty
        @else
        {{-- <h3 class="text-center text-sm my-20 kiwi-maru">統計情報が最新でないため、関連日記も表示していません。</h3> --}}
        @endif
    </div>
</div>
<div class="my-12">
    @component('components.diary.breadcrumbDate')
    @slot("date")
    {{$diary->date->format("Y-n-j")}}
    @endslot
    @endcomponent
</div>

@endsection