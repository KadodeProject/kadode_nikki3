@extends("layouts.noLogIn")
@section("title","429")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">429 エラーです。大量のリクエストをさばききれませんでした。</h1>
    <img src="/img/errorPages/shigureni429.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 