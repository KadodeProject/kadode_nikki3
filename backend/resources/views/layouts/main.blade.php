<!DOCTYPE html>
<html lang="ja">

<head>
    <title>@yield('title') | かどで日記</title>
    @component('components.basis.headMeta')
    @endcomponent
    {{-- @component('components.basis.ogp')
    @endcomponent --}}
    {{-- 検索インデックスさせない --}}
    <meta name="robots" content="noindex,nofollow">

</head>

<body>

    <!---ヘッダーここから--->
    @component('components.basis.header')
    @endcomponent
    <!---ヘッダーここまで--->
    <!---コンテンツここから--->
    <div class="main-wrapper">
        @yield('content')
    </div>
    <!----コンテンツここまで--->

    <!----フッターここから--->
    @component('components.basis.footer')
    @endcomponent
    @component('components.basis.smFooter')
    @endcomponent
    <!----フッターここまで--->
    @component('components.basis.roadJS')
    @endcomponent

</body>

</html>