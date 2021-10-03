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

    @section('header')
    <header class="px-4 relative border-b-2 w-screen flex justify-between items-center">
        <div class="flex items-center justify-around">
            <a href="{{url("/home")}}"><img style="object-fit:contain;width:auto;height:64px"src="/img/kadode_logo.png"></a>
            <div class="flex  flex-row flex-wrap justify-center">
                <p id="headerYear">年</p>
                <p id="headerMontDate">月</p>
                <p id="headerTime">日</p>
            </div>
        </div>
        <div class="">
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <ul class="text-red-500 kiwi-maru">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <form class=" flex"method="POST" action="/diary/search">
                @csrf
                <input class="" type="search" name="keyword" placeholder="キーワード(2~20字)">
                <input type="submit" value="検索">
                
            </form>
        </div>
       


        
        <div class="px-6 py-4 sm:block">
      
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">{{ Auth::user()->name }}</a>
       

         
        </div>

    </header>
   
    <div>

        @yield('content')
        
        
    </div>
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
        // var nowUnixTime = nowTime.getTime();

        var nowYear = nowTime.getFullYear();
        // getYearは2000年問題の関係で4桁返してくれないのでgetFullYearを使用
        var nowMonth = nowTime.getMonth() + 1;
        //getMonthは0~11で返ってくるので1足した
        var nowDate = nowTime.getDate();
        var nowHour = set2fig(nowTime.getHours());
        var nowMin = set2fig(nowTime.getMinutes());
        var nowSec = set2fig(nowTime.getSeconds());
        headerYear.innerHTML=nowYear;
        headerMonthDate.innerHTML=nowMonth+"<span class='' style='font-size:1.5em'>月</span>"+nowDate+"<span class='' style='font-size:1.5em'>日</span>";
        headerTime.innerHTML=nowHour+":"+nowMin+":"+nowSec;
        // var time =
        // "<span class='main-date'>" +
        // nowYear +
        // "年" +
        // nowMonth +
        // "月" +
        // nowDate +
        // "日" +
        // "</span><span class='main-hour'>" +
        // nowHour +
        // ":" +
        // nowMin +
        // ":<span class='main-second'>" +
        // nowSec +
        // "</span>";
        // headerClock.innerHTML = time;
        // var date="<span class='main-date'>" +
        // nowYear +
        // "-" +
        // set2fig(nowMonth) +
        // "-" +
        // set2fig(nowDate) +
        // "</span><span class='main-hour'>" ;
        // if(document.URL.match("/home")) {

        //     diaryDate.innerHTML = date;
        // }
        
        }
        setInterval("showClock()", 1000);

       </script>
</body>
</html>