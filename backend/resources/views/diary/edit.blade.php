@extends("layouts.main")
@section("title", $diary['date']."の日記")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main  kiwi-maru ">
    <div class="dateWrapper">
        <nav class="md:order-1 ">
            @empty($dateAndUuidBA['next']['uuid'])
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-kn_3 kiwi-maru"><span
                    class="material-icons ">arrow_back</span><span class="material-icons">remove_circle_outline</span>
                日記なし</p>
            @else
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-kn_3 kiwi-maru"><a style="vertical-align: middle;"
                    href="{{route('ShowSingleDiary',['uuid'=>$dateAndUuidBA['next']['uuid']])}}"><span
                        class="material-icons">arrow_back</span>
                    {{$dateAndUuidBA['next']['date']}}</a></p>
            @endempty

        </nav>
        <nav class="order-2 md:order-3">
            @empty($dateAndUuidBA['former']['uuid'])
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-kn_3 kiwi-maru">日記なし <span
                    class="material-icons">remove_circle_outline</span><span class="material-icons">arrow_forward</span>
            </p>
            @else
            <p class="md:ml-12 md:mt-12 p-2 text-xl borer-2 border-kn_3 kiwi-maru"><a style="vertical-align: middle;"
                    href="{{route('ShowSingleDiary',['uuid'=>$dateAndUuidBA['next']['uuid']])}}">
                    {{$$dateAndUuidBA['former']['date']}}<span class="material-icons">arrow_forward</span></a></p>
            @endempty
        </nav>
        <nav class="order-3 md:order-2 ">
            <h1 class="text-center mt-6 mb-4 mx-4 text-4xl drop-shadow-3xl">
                @empty($diary['title'])
                <span class='text-gray-600'>タイトルなし</span>
                @else
                「{{$diary['title']}}」
                @endempty
            </h1>
            <h2 class="text-center mt-8 mb-2 mx-4 text-xl">
                {{$diary['date']}}
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
                {{route('UpdateDiary')}}
                @endslot
                @slot("original_uuid")
                {{$diary['uuid']}}
                @endslot
                @slot("original_date")
                {{$diary['date']}}
                @endslot
                @slot("original_title")
                {{$diary['title']}}
                @endslot
                @slot("original_content")
                {{$diary['content']}}
                @endslot
                @endcomponent
            </div>
        </div>
        @component('components.buttons.editorDiaryButton')
        @slot("delete_uuid")
        {{$diary['uuid']}}
        @endslot
        @endcomponent
    </div>
    <div class="tab_content" id="viewDiaryContent">
        <p class="kiwi-maru diaryContentWrapper">{!! nl2br(e($diary['content'])) !!}</p>
    </div>
    <div class="tab_content" id="viewStatisticContent">
        <div class="mb-12  md:w-2/3 md:mx-auto">
            <h2 class="kiwi-maru text-3xl text-center mt-4"><span class="material-icons">science</span>解析情報</h2>
            @if($diary['statisticStatus']->value === 1)
            <p class="text-right md:pr-12 px-2 text-sm mt-2 kiwi-maru">統計作成時刻:
                {{$diary['statistic_per_date']['updated_at']}}
            </p>
            <div class="flex flex-wrap mx-4 md:mx-8">
                <div class="w-full md:w-1/2">
                    @php
                    $emotions=$diary['statistic_per_date']['emotions'];
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
                    {{$diary['statistic_per_date']['classification']}}
                    @endslot
                    @endcomponent
                </div>
            </div>
            @component('components.statistics.char.importantWordsChar',["important_words"=>$diary['statistic_per_date']['important_words']])

            @endcomponent
            {{-- @component('components.statistics.char.causeEffectChar')
            @endcomponent --}}
            @component('components.statistics.char.specialPeopleChar',["special_people"=>$diary['statistic_per_date']['special_people']])

            @endcomponent
            @elseif($diary['statisticStatus']->value == 2)
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報が生成されていません</h3>
            @elseif($diary['statisticStatus']->value === 3)
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報を生成中です</h3>
            @elseif($diary['statisticStatus']->value == 4)
            <h3 class="kiwi-maru text-2xl text-center my-6">統計情報が最新でないため表示していません</h3>
            @endif
        </div>
    </div>
</div>
<div class="my-12">
    @component('components.diary.breadcrumbDate')
    @slot("date")
    {{$diary['date']}}
    @endslot
    @endcomponent
</div>

@endsection
