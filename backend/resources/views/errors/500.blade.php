@extends("layouts.noLogIn")
@section("title","500")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">500 エラーです。サーバー側の処理やコードに問題があります。</h1>
    <h2 class="text-center text-2xl  kiwi-maru">製作者の責任です。申し訳ございません。<br>もしよろしければ、発生したときの操作や経緯を下記フォームの「バグ」よりご報告していただけないでしょうか</h2>
    <p class="text-center text-2xl my-8 kiwi-maru"><a target="_blank" rel="norefferrer"  href="https://forms.gle/PXPynwdAZjP5d3pA6">かどで日記お問い合わせフォーム</a></p>
    <img src="/img/errorPages/shigureni500.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 