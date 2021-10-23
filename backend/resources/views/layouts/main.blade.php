<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title') | かどで日記</title>

    {{-- favicon --}}
    <link rel="apple-touch-icon" type="image/png" href="/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/img/favicon/icon-192x192.png">

    
    {{-- GoogleFonts --}}
    {{-- kiwi maru --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
    {{-- 検索インデックスさせない --}}
    <meta name=”robots” content=”noindex,nofollow”>
    
    {{-- マテリアルアイコン --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href="{{ asset('css/kadodeMain.css') }}?ver=19.1">

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
            color: var(--button-main-color);
        }
        @elseif(Request::is('edit'))
        .header-links p:nth-of-type(2){
            color: var(--button-main-color);
        }
        @elseif(Request::is('diary/*'))
        .header-links p:nth-of-type(3){
            color: var(--button-main-color);
        }
        @elseif(Request::is('search'))
        .header-links p:nth-of-type(4){
            color: var(--button-main-color);
        }
        @elseif(Request::is('statistics'))
        .header-links p:nth-of-type(5){
            color: var(--button-main-color);
        }
        @elseif(Request::is('settings'))
        .header-links p:nth-of-type(6){
            color: var(--button-main-color);
        }
        @endif

    </style>

    @section('header')
    <header class="px-4 relative w-screen flex justify-between " style="box-shadow: 0px 8px 8px -5px rgba(0,0,0,0.5);">
        <div class="flex justify-center items-center" style="height:var(--header-height);filter:drop-shadow(0px 8px 8px -5px rgba(0,0,0,0.5));">
            <a href="{{url("/home")}}"><img class="logo-header" src="/img/kadode_logo.png"></a>
            <p class="ml-4 md:block hidden kiwi-maru">Public<br>Beta</p>
            <!-- <div class="sm:flex hidden ml-4   flex-col flex-wrap justify-center items-center">
                <p id="headerYear">年</p>
                <p class="text-xl"id="headerMonthDate">月日</p>
                <p id="headerTime">時刻</p>
            </div> -->
        </div>

        <div class="sm:flex hidden  justify-between items-end header-links h-full kiwi-maru" style="height:var(--header-height)">
            <p><a href="{{url("/home")}}">ホーム</a></p>
            <p><a href="{{url("/edit")}}">日記作成</a></p>   
            <p><a href="{{url("/diary").date("/Y/n")}}">アーカイブ</a></p>
            <p><a href="{{url("/search")}}">検索</a></p>
            <p><a href="{{url("/statistics/home")}}">統計</a></p>
            <p><a href="{{url("/settings")}}">設定</a></p>   
        </div>
        <div class="flex justify-center ">
            <div class="flex justify-end items-end sm:mb-4 sm:mr-8 mb-2">
               
                <form class="move-label-wrapper flex"method="POST" action="/search">
                    @if(count($errors)>0)
                {{-- エラーの表示 --}}
                <ul class="text-red-500 kiwi-maru">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                    @csrf
                    <div>
                        <label id="moveLabelJs"class="move-label text-main-color text-sm kiwi-maru" for="keywordLabel">日記検索</label>
                        <input id="keywordLabel" autocomplete="off"class="search-keyword " type="search" name="keyword" placeholder="キーワード(2~20字)">
                    </div>
                    <input type="submit" style=" border-radius: 0 3px 3px 0" class="kiwi-maru"value="検索">
                    
                </form>
            </div>
        


            
            <div class="flex items-center justify-center mr-4">          
                <p class="sm:block hidden kiwi-maru">{{ Auth::user()->name }}</p>
                <p class="sm:hidden block ml-4 mt-2"><a href="{{url("/settings")}}"><span class="material-icons">settings</span></a></p>  
            </div>
        </div>
    </header>
   
    <div class="main-wrapper">

        @yield('content')
        
        
    </div>
    @component('components.footer')
    @endcomponent
    <div class="sm:hidden" style="height: 60px" >
    <!-- smフッターメニューのための余白 -->
    </div>

        <div id="smFooter" class="bg-main-color w-full border-border-main-color border-t-2  fixed bottom-0 right-0 sm:hidden flex  justify-around items-center " style="height: 60px" >
            <p><a class="flex justify-center flex-col" href="{{url("/home")}}"><span class="material-icons mx-auto">home</span><span class="text-xs">ホーム</span></a></p>
            <p><a class="flex justify-center flex-col" href="{{url("/edit")}}"><span class="material-icons mx-auto">edit</span><span class="text-xs">日記作成</span></a></p>   
            <p><a class="flex justify-center flex-col" href="{{url("/diary").date("/Y/n")}}"><span class="material-icons mx-auto">collections_bookmark</span><span class="text-xs">アーカイブ</span></a></p>
            <p><a class="flex justify-center flex-col" href="{{url("/statistics/home")}}"><span class="material-icons mx-auto">poll</span><span class="text-xs">統計</span></a></p>
        </div>    


    <script type="text/javascript" src="{{ asset('js/kadodeMain.js') }}?ver=19.1"></script>
</body>
</html>