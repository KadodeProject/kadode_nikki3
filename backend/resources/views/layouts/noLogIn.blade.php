<!DOCTYPE html>
<html lang="ja"  prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title') | かどで日記</title>
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

    
    {{-- GoogleFonts --}}
 {{-- kiwi maru --}}
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
    {{-- 検索インデックスさせない --}}
    <meta name=”robots” content=”noindex,nofollow”>

    {{-- OGP --}}
    <meta property="og:title" content="@yield('title') | かどで日記">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kadode_nikki3.usuyuki.net/">
    <meta property="og:image" content="https://kadode_nikki3.usuyuki.net/img/ogp.png">
    <meta property="og:site_name" content="かどで日記">
    <meta property="og:description" content="かどで日記は日記を管理できるwebアプリです">
    <meta name="twitter:card" content="summary">
    {{-- マテリアルアイコン --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href="{{ asset('css/kadodeMain.css') }}">
</head>
<body>
    

    @section('header')
    <header class="px-4 relative w-screen flex justify-between ">
        <a href="{{url("/home")}}"><img style="object-fit:contain;width:auto;height:64px"src="/img/kadode_logo.png"></a>
        
        </div>
        <div class="flex items-center">

            <h2 class="text-3xl kiwi-maru"><a href="{{url("/")}}">かどで日記3</a></h2>
        </div>
        <div class="px-6 py-4 sm:block">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="kadode-normal-button">ホームへ</a>
                    @else
                        <a href="{{ route('login') }}" class="kadode-normal-button">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="kadode-normal-button">新規登録</a>
                        @endif
                    @endauth
                </div>
            @endif
            
    

        
        </div>
      
    </header>
   
    <main>

        @yield('content')
        
        
    </main>
    <footer class="py-4">
    <div class="py-8 flex justify-between items-center mx-auto flex-wrap footer-menu kiwi-maru" style="max-width: 1200px">
        <p><a href="{{url("/privacyPolicy")}}">プライバシーポリシー</a></p>
        <p><a href="{{url("/terms")}}">利用規約</a></p>
        <p><a href="{{url("/aboutThisSite")}}">このサイトについて</a></p>
        <p><a href="{{url("/contact")}}">お問い合わせ</a></p>
        <p><a href="{{url("/")}}">トップ</a></p>
        <p><a href="{{url("/news")}}">お知らせ</a></p>
        <p><a href="{{url("/releaseNote")}}">リリースノート</a></p>
    </div>
     <p class="text-center mt-4 copyright">{{"@"}}usuyuki{{date("Y")}}</p>
    </footer>

    <script type="text/javascript" src="{{ asset('js/kadodeMain.js') }}"></script>
</body>
</html>