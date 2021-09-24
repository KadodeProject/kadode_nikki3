
@extends("layouts.noLogIn")
@section("title","403")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">403 エラーです。このページへの入構は許可されていないみたいです。</h1>
    <img src="/img/errorPages/shigureni403.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 

