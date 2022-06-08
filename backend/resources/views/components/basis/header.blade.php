<style>
    .header-links p {
        margin: 0 0.5em;
        padding-bottom: 0.2em;
        font-size: 20px;
        border-bottom: 2px solid var(--bg-kn_b);
    }

    @if(Request::is('home')) .header-links p:nth-of-type(1) {
        color: var(--kn_2);
    }

    @elseif(Request::is('edit')) .header-links p:nth-of-type(2) {
        color: var(--kn_2);
    }

    @elseif(Request::is('diary/*')) .header-links p:nth-of-type(3) {
        color: var(--kn_2);
    }

    @elseif(Request::is('search')) .header-links p:nth-of-type(4) {
        color: var(--kn_2);
    }

    @elseif(Request::is('statistics/home')) .header-links p:nth-of-type(5) {
        color: var(--kn_2);
    }

    @elseif(Request::is('statistics/settings')) .header-links p:nth-of-type(6) {
        color: var(--kn_2);
    }

    @elseif(Request::is('settings')) .header-links p:nth-of-type(7) {
        color: var(--kn_2);
    }

    @elseif(Request::is('administrator')) .header-links p:nth-of-type(8) {
        color: var(--kn_2);
    }

    @endif
</style>
<header class="px-4 relative w-full flex justify-between " style="box-shadow: 0px 8px 8px -5px rgba(0,0,0,0.5);">
    <div class="flex justify-center items-center"
        style="height:var(--header-height);filter:drop-shadow(0px 8px 8px -5px rgba(0,0,0,0.5));">
        <a href="{{url("/home")}}"><img class="logo-header" src="/img/kadode_logo.png"></a>
        <p class="ml-4 md:block hidden kiwi-maru">Public<br>Beta</p>
        <!-- <div class="sm:flex hidden ml-4   flex-col flex-wrap justify-center items-center">
            <p id="headerYear">年</p>
            <p class="text-xl"id="headerMonthDate">月日</p>
            <p id="headerTime">時刻</p>
        </div> -->
    </div>

    <div class="sm:flex hidden  justify-between items-end header-links h-full kiwi-maru"
        style="height:var(--header-height)">
        <p><a href="{{url("/home")}}">ホーム</a></p>
        <p><a href="{{url("/edit")}}">日記作成</a></p>
        <p><a href="{{url("/diary").date("/Y/n")}}">アーカイブ</a></p>
        <p><a href="{{url("/search")}}">検索</a></p>
        <p><a href="{{url("/statistics/home")}}">統計</a></p>
        <p><a href="{{url("/statistics/settings")}}">統計設定</a></p>
        <p><a href="{{url("/settings")}}">設定</a></p>

        @if( Auth::user()->user_role_id==2)
        <p><a href="{{url("/administrator")}}">管理者</a></p>
        @endif
    </div>
    <div class="flex justify-center ">
        <div class="flex justify-end items-end sm:mb-4 sm:mr-8 mb-2">

            <form class="move-label-wrapper flex" method="POST" action="/search">

                @if($errors->has('keyword'))
                {{-- エラーの表示 --}}
                <p class="text-red-500 kiwi-maru">
                    {{$errors->first('keyword')}}
                </p>

                @endif
                @csrf
                <div>
                    <label id="moveLabelJs" class="move-label text-kn_w text-sm kiwi-maru"
                        for="keywordLabel">日記検索</label>
                    <input id="keywordLabel" autocomplete="off" class="search-keyword " type="search" name="keyword"
                        placeholder="キーワード(2~20字)">
                </div>
                <input type="submit" style=" border-radius: 0 3px 3px 0" class="bg-kn_2 kiwi-maru" value="検索">

            </form>
        </div>




        <div class="flex items-center justify-center">
            <p class="sm:block hidden kiwi-maru">{{ Auth::user()->name }}</p>
            <p class="sm:hidden block ml-4 mt-2"><a href="{{url("/settings")}}"><span
                        class="material-icons">settings</span></a></p>
        </div>
    </div>
</header>
