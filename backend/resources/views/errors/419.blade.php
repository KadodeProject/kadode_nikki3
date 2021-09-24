@extends("layouts.noLogIn")
@section("title","419")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">419 エラーです。csrf関係のエラーです。</h1>
    <h2 class="text-center text-lg my-2 kiwi-maru">セキュリティの安全確保のため出ています。問題のないアクセス方法で出た場合はお手数ですが一度このページを閉じで、アクセスし直してください。</h2>
    <img src="/img/errorPages/shigureni419.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 