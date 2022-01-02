<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
    <title>@yield('title') | かどで日記</title>
    @component('components.basis.headMeta')
    @endcomponent
    @component('components.basis.ogp')
    @endcomponent
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P6MDK8XCEE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-P6MDK8XCEE');
    </script>

</head>

<body>

    <!---ヘッダーここから--->
    @component('components.basis.headerNoLogin')
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
    {{-- @component('components.basis.smFooter')
    @endcomponent --}}
    <!----フッターここまで--->
    @component('components.basis.roadJS')
    @endcomponent

</body>

</html>