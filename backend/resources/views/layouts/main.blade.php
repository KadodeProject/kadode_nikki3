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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Potta+One&display=swap" rel="stylesheet">
    <meta name=”robots” content=”noindex,nofollow”>
    
    {{-- マテリアルアイコン --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href="{{ asset('css/kadodeMain.css') }}">
</head>
<body>

    @section('header')
    <header class="px-4 relative border-b-2 w-screen flex justify-between items-center">
        <div class="flex items-center justify-around">
            <a href="{{url("/home")}}"><img style="object-fit:contain;width:auto;height:64px"src="/img/kadode_logo.png"></a>
            <div class="ml-4"id="headerClock">
                現在時刻
            </div>
        </div>
        <div class="">
            <form class=" flex"method="POST" action="/diary/search">
                @csrf
                <input class="" type="search" name="search" value="検索">
                <input type="submit" value="検索">
                
            </form>
        </div>
       


        
        <div class="px-6 py-4 sm:block">
      
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">{{ Auth::user()->name }}</a>
       

         
        </div>

    </header>
   
    <main>

        @yield('content')
        
        
    </main>
    <footer>
     <p class="text-center">{{"@"}}usuyuki2021</p>
    </footer>
    <script>
     
        
        //時計用桁数調整
        function set2fig(num) {
        // 桁数が1桁だったら先頭に0を加えて2桁に調整する
        var ret;
        if (num < 10) {
        ret = "0" + num;
        } else {
        ret = num;
        }
        return ret;
        }

        function showClock() {
        var nowTime = new Date();
        var nowUnixTime = nowTime.getTime();

        var nowYear = nowTime.getFullYear();
        // getYearは2000年問題の関係で4桁返してくれないのでgetFullYearを使用
        var nowMonth = nowTime.getMonth() + 1;
        //getMonthは0~11で返ってくるので1足した
        var nowDate = nowTime.getDate();
        var nowHour = set2fig(nowTime.getHours());
        var nowMin = set2fig(nowTime.getMinutes());
        var nowSec = set2fig(nowTime.getSeconds());
        var time =
        "<span class='main-date'>" +
        nowYear +
        "年" +
        nowMonth +
        "月" +
        nowDate +
        "日" +
        "</span><span class='main-hour'>" +
        nowHour +
        ":" +
        nowMin +
        ":<span class='main-second'>" +
        nowSec +
        "</span>";
        var date="<span class='main-date'>" +
        nowYear +
        "-" +
        set2fig(nowMonth) +
        "-" +
        set2fig(nowDate) +
        "</span><span class='main-hour'>" ;
        headerClock.innerHTML = time;
        if(document.URL.match("/home")) {

            diaryDate.innerHTML = date;
        }
        
        }
        setInterval("showClock()", 1000);

       </script>
</body>
</html>