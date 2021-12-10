<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P6MDK8XCEE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-P6MDK8XCEE');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | かどで日記</title>
    {{-- favicon --}}
    <link rel="apple-touch-icon" type="image/png" href="/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/img/favicon/icon-192x192.png">
    {{-- GoogleFonts --}}
    {{-- kiwi maru --}}
    {{--
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet"> --}}
    {{-- 検索インデックスさせない --}}
    <meta name=”robots” content=”noindex,nofollow”>
    {{-- マテリアルアイコン --}}
    {{--
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    {{-- OGP --}}
    <meta property="og:title" content="@yield('title') | かどで日記">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kadodenikki3.usuyuki.net/">
    <meta property="og:image" content="https://kadodenikki3.usuyuki.net/img/ogp.png">
    <meta property="og:site_name" content="かどで日記">
    <meta property="og:description" content="かどで日記は日記を管理できるwebアプリです">
    <meta name="twitter:card" content="summary">
    {{-- CSS読み込み --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kadodeMain.css') }}?ver=20.1">
</head>

<body>


    @section('header')
    <header class="px-4 relative w-screen flex justify-center sm:justify-between flex-wrap ">
        <a href="{{url("/home")}}"><img class="logo-header" src="/img/kadode_logo.png"></a>

        </div>
        <div class="flex items-center">

            <h2 class="text-3xl kiwi-maru"><a href="{{url("/")}}">かどで日記3</a></h2>
        </div>
        <div class="p-2 sm:w-auto sm:mb-0 mb-4 md:w-auto w-full">
            @if (Route::has('login'))
            <div class="flex justify-center">
                @auth
                <a href="{{ url('/home') }}" class="kiwi-maru kadode-normal-button">ホームへ</a>
                @else
                <a href="{{ route('login') }}" class="kiwi-maru mr-2 kadode-normal-button">ログイン</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="kiwi-maru kadode-normal-button">新規登録</a>
                @endif
                @endauth
            </div>
            @endif




        </div>

    </header>

    <div class="main-wrapper">

        @yield('content')


    </div>
    @component('components.footer')
    @endcomponent


    <script type="text/javascript" src="{{ asset('js/kadodeMain.js') }}?ver=20.1"></script>
</body>

</html>
