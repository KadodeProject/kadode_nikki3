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
            <div class="bg-kn_3 w-2 h-8"></div>
            <h2 class="ml-2 text-2xl">作者</h2>
        </div>
        <div class="py-4">
            <p class="my-2">Twitter : <br class="md:hidden"><a target="_blank" rel="norefferrer"
                    href="https://twitter.com/usuyuki26">https://twitter.com/usuyuki26</a></p>
            <p class="my-2">ポートフォリオ : <br class="md:hidden"><a target="_blank" rel="norefferrer"
                    href="https://pf.usuyuki.net">https://pf.usuyuki.net</a></p>
        </div>
    </div>
    <div class="mb-12">
        <div class="flex items-center">
            <div class="bg-kn_3 w-2 h-8"></div>
            <h2 class="ml-2 text-2xl">かどで日記GitHubリポジトリ</h2>
        </div>
        <div class="py-4">
            <p class="my-2">GitHub : <br class="md:hidden"><a target="_blank" rel="norefferrer"
                    href="https://github.com/Usuyuki/kadode_nikki3">https://github.com/Usuyuki/kadode_nikki3</a></p>
        </div>
    </div>
    <div class="mb-12">
        <div class="flex items-center">
            <div class="bg-kn_3 w-2 h-8"></div>
            <h2 class="ml-2 text-2xl">お問い合わせフォーム</h2>
        </div>
        <div class="py-4 ">
            <p class="mb-2">下記Googleフォームよりご記入ください。</p>
            <p><a target="_blank" rel="norefferrer"
                    href="https://forms.gle/PXPynwdAZjP5d3pA6">https://forms.gle/PXPynwdAZjP5d3pA6</a></p>
            {{-- <iframe class="mx-auto"
                src="https://docs.google.com/forms/d/e/1FAIpQLSetsFGNIdrWn_idgQrkqP8BkrtJfD22H1p3963tRJTKE8NwNg/viewform?embedded=true"
                width="640" height="698" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe> --}}
        </div>
    </div>
</div>

@endsection