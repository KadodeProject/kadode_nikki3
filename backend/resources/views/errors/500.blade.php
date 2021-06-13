@extends("layouts.noLogIn")
@section("title","500")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">500 エラーです。サーバー側の処理やコードに問題があります。</h1>
    <img src="img/errorPages/shigureni500.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 