<!DOCTYPE html>
<html lang="ja">
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
    
    {{-- マテリアルアイコン --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href="{{ asset('css/kadodeMain.css') }}">

</head>
<body>
    <style>
        .header-links p{
            margin:0 0.5em;
            padding-bottom: 0.2em;
            font-size: 20px;
            border-bottom:2px solid var(--bg-main-color);
        }
        @if(Request::is('home'))
        .header-links p:nth-of-type(1){
            border-bottom:2px solid var(--button-main-color);
        }
        @elseif(Request::is('diary/*'))
        .header-links p:nth-of-type(2){
            border-bottom:2px solid var(--button-main-color);
        }
        @elseif(Request::is('search'))
        .header-links p:nth-of-type(3){
            border-bottom:2px solid var(--button-main-color);
        }
        @elseif(Request::is('statistics/*'))
        .header-links p:nth-of-type(4){
            border-bottom:2px solid var(--button-main-color);
        }
        @elseif(Request::is('settings'))
        .header-links p:nth-of-type(5){
            border-bottom:2px solid var(--button-main-color);
        }
        @endif

    </style>

    @section('header')
    <header class="px-4 relative w-screen flex justify-between ">
        <div class="flex justify-center items-center" style="height:var(--header-height)">
            <a href="{{url("/home")}}"><img style="object-fit:contain;width:auto;height:64px"src="/img/kadode_logo.png"></a>
            <div class="ml-4 flex  flex-col flex-wrap justify-center items-center">
                <p id="headerYear">年</p>
                <p class="text-xl"id="headerMonthDate">月日</p>
                <p id="headerTime">時刻</p>
            </div>
        </div>

        <div class="flex justify-between items-end header-links h-full" style="height:var(--header-height)">
            <p><a href="{{url("/home")}}">ホーム</a></p>
            <p><a href="{{url("/diary").date("/Y/n")}}">アーカイブ</a></p>
            <p><a href="{{url("/search")}}">検索</a></p>
            <p><a href="{{url("/statistics")}}">統計</a></p>
            <p><a href="{{url("/setting")}}">設定</a></p>   
        </div>
        <div class="flex justify-end items-end">
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <ul class="text-red-500">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <form class="move-label-wrapper flex"method="POST" action="/search">
                @csrf
                <div>
                    <label id="moveLabelJs"class="move-label text-main-color text-sm" for="keywordLabel">日記検索</label>
                    <input id="keywordLabel" autocomplete="off"class="search-keyword" type="search" name="keyword" placeholder="キーワード(2~20字)">
                </div>
                <input type="submit" value="検索">
                
            </form>
        </div>
       


        
        <div class="px-6 py-4 sm:block">
            <p> <a href="{{ url('/dashboard') }}" class="text-sm  underline">{{ Auth::user()->name }}</a></p>
               
       

         
        </div>

    </header>
   
    <main>

        @yield('content')
        
        
    </main>
    <footer>
     <p class="text-center">{{"@"}}usuyuki{{date("Y")}}</p>
    </footer>

    <script type="text/javascript" src="{{ asset('js/kadodeMain.js') }}"></script>
</body>
</html>