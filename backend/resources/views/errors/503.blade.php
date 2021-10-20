@extends("layouts.noLogIn")
@section("title","503")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main error-page">
   
    <h1 class="text-center text-3xl mt-20 kiwi-maru">503 エラーです。</h1>
    <h1 class="text-center text-3xl mt-2 kiwi-maru">かどで日記は現在<br class=" md:hidden">メンテナンス中です。</h1>
    <h1 class="text-center text-3xl mt-8 kiwi-maru">お手数ですが<br class=" md:hidden">後ほどアクセスください。</h1>
    <h1 class="text-center text-3xl mt-20 kiwi-maru">終了時刻などについては下記お知らせを御覧ください。</h1>
    <p class="text-center text-2xl my-8 kiwi-maru"><a target="_blank" rel="norefferrer"  href="https://github.com/Usuyuki/kadode_nikki3/blob/main/Maintenance.md">かどで日記メンテナンスお知らせページ(仮)</a></p>
    {{-- <img src="/img/errorPages/shigureni500.png" class="mx-auto object-contain h-80 w-80"> --}}
</div>
      
@endsection
 