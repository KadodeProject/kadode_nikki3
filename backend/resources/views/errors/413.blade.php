@extends("layouts.noLogIn")
@section("title","404")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl my-8 kiwi-maru">413 エラーです。ファイルサイズおっきすぎます。</h1>
    <h2 class="text-center text-lg my-2 kiwi-maru">製作者の容量見積もりミスです。下記よりアップロードサイズ・アップロード箇所を報告いただけますと助かります。</h2>
    <p class="text-center text-lg mb-8 kiwi-maru"><a target="_blank" rel="norefferrer"  href="https://forms.gle/PXPynwdAZjP5d3pA6">かどで日記お問い合わせフォーム</a></p>
    <img src="/img/errorPages/shigureni404.png" class="mx-auto object-contain h-80 w-80">
</div>
      
@endsection
 