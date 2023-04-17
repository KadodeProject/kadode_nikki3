<header class="px-4 relative w-screen flex justify-center sm:justify-between flex-wrap "
    style="box-shadow: 0px 8px 8px -5px rgba(0,0,0,0.5);">
    <a class="md:flex-1 flex-none" href="{{route('ShowHome')}}"><img class="logo-header" src="/img/kadode_logo.svg"
            title="エーデルワイスの花言葉は「大切な思い出」です"></a>

    </div>
    <div class="fmd:flex-1 flex-none flex items-center">

        <h2 class="text-3xl kiwi-maru"><a href="{{route('ShowTop')}}">かどで日記3</a></h2>
    </div>
    <div class="md:flex-1 flex-none p-2 sm:w-auto sm:mb-0 mb-4 md:w-auto w-full">
        <div class="flex justify-center md:justify-end">
            @auth
            <a href="{{ route('ShowHome') }}" class="kiwi-maru kadode-normal-button">ホームへ</a>
            @else
            {{-- <a href="{{ route('login') }}" class="kiwi-maru mr-2 kadode-normal-button">ログイン</a> --}}

            {{-- @if (Route::has('register'))
            <a href="{{ route('register') }}" class="kiwi-maru kadode-normal-button">新規登録</a>
            @endif --}}
            @endauth
        </div>
    </div>
</header>
