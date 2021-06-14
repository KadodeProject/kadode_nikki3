@extends("layouts.noLogIn")
@section("title","503")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">500 エラーです。サーバーのアクセス上限に達しました。しばらく時間をおいてからアクセスしてみてください。</h1>
    <img src="/img/errorPages/shigureni500.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 