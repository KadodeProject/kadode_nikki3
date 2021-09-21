
@extends("layouts.main")
@section("title","編集")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
    <div class="diary-main">
        <nav class="md:order-1 ">
            @isset($next)
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><a style="vertical-align: middle;" href="{{url('/edit')}}/{{$next->uuid}}"><span class="material-icons">arrow_back</span> {{$next->date}}</a></p>
            @else
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><span class="material-icons ">arrow_back</span><span class="material-icons">remove_circle_outline</span> 日記なし</p>
            @endisset
        
        </nav>
        <nav class="order-2 md:order-3">
            @isset($previous)
            <p class="md:ml-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><a style="vertical-align: middle;" href="{{url('/edit')}}/{{$previous->uuid}}"> {{$previous->date}} <span class="material-icons">arrow_forward</span></a></p>
            @else
            <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" >日記なし <span class="material-icons">remove_circle_outline</span><span class="material-icons">arrow_forward</span></p> 
            @endisset
        </nav>
        <div class="order-3 md:order-2 ">
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
            @endcomponent
        </div>
    </div>
    @component('components.buttons.editorDiaryButton')
    @slot("delete_uuid")
    {{$diary->uuid}}
    @endslot
    @endcomponent
    
    <div class="my-12  border button-border-main-color md:w-2/3 md:mx-auto">
        <h2 class="kiwi-maru text-3xl text-center mt-4">この日記の解析情報</h2>
        <p class="text-right md:pr-12 px-2 text-sm mt-2 kiwi-maru">統計作成時刻:</p>
        <div class="flex flex-wrap mx-4 md:mx-8">
            <div class="w-full md:w-1/2">
                @component('components.statistics.emotionsChar')
                    {{-- @slot("ended_diaries_count")
                    {{$ended_diaries_count}}
                    @endslot --}}
                @endcomponent
            </div>
            <div class="w-full md:w-1/2">
                @component('components.statistics.flavorChar')
                    {{-- @slot("ended_diaries_count")
                    {{$ended_diaries_count}}
                    @endslot --}}
                @endcomponent
            </div>
            <div class="w-full md:w-1/2">
                @component('components.statistics.classificationsChar')
                    {{-- @slot("ended_diaries_count")
                    {{$ended_diaries_count}}
                    @endslot --}}
                @endcomponent
            </div>
        </div>
        @component('components.statistics.importantWordsChar')
            {{-- @slot("ended_diaries_count")
            {{$ended_diaries_count}}
            @endslot --}}
        @endcomponent
        @component('components.statistics.causeEffectChar')
            {{-- @slot("ended_diaries_count")
            {{$ended_diaries_count}}
            @endslot --}}
        @endcomponent
        @component('components.statistics.specialPeopleChar')
            {{-- @slot("ended_diaries_count")
            {{$ended_diaries_count}}
            @endslot --}}
        @endcomponent
    </div>


</div>
      
@endsection
 