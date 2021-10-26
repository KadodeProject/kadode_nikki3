@extends("layouts.noLogIn")
@section("title","418")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">

    <h1 class="text-center text-3xl my-8 kiwi-maru">418 エラーです。I'm a teapot</h1>
    <h2 class="text-center text-lg my-2 kiwi-maru">ティーポットにコーヒーを入れないでください。</h2>
    <img src="/img/errorPages/shigureni418.png" class="mx-auto object-contain h-80 w-80">
    <p class="text-center text-sm my-2 kiwi-maru">2021イースターエッグ made by うすゆき。</p>

</div>

@endsection
