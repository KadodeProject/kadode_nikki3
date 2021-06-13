@extends("layouts.noLogIn")
@section("title","お問い合わせ")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">お問い合わせ</h1>
<div class="mx-auto px-4" style="max-width: 1200px">
    <div class="mb-12">
        <div class="flex items-center">
            <div class="border-bg-main-color w-2 h-8"></div>
            <h2 class="ml-2 text-2xl">作者</h2>
        </div>
        <div class="py-4">
            <p class="my-2">Twitter : <a href="https://twitter.com/usuyuki26">https://twitter.com/usuyuki26</a></p>
            <p class="my-2">ポートフォリオ : <a href="https://portfolio.usuyuki.com">https://portfolio.usuyuki.com</a></p>
        </div>
    </div>
    <div class="mb-12">
        <div class="flex items-center">
            <div class="border-bg-main-color w-2 h-8"></div>
            <h2 class="ml-2 text-2xl">お問い合わせフォーム</h2>
        </div>
        <div class="py-4 ">
            <iframe class="mx-auto" src="https://docs.google.com/forms/d/e/1FAIpQLSetsFGNIdrWn_idgQrkqP8BkrtJfD22H1p3963tRJTKE8NwNg/viewform?embedded=true" width="640" height="698" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
        </div>
    </div>
</div>
      
@endsection
 
 