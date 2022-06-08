@extends("layouts.main")
@section("title","インポート結果")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="setting">

        @include('components.settingHeading',['title'=>'インポート結果',])
        <p class="text-center mx-2 my-2 text-2xl kiwi-maru">{{$importResult}}</p>
    </div>





</div>

@endsection
