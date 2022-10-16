<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | かどで日記</title>

    {{-- favicon --}}
    <link rel="apple-touch-icon" type="image/png" href="/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/img/favicon/icon-192x192.png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- スタイルとスクリプト -->
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<style>
    /* あんまりやりたくないけどCSS読み込みの都合、ここに書く…… */
    .auth_bg {
        background-position: center;
        background-size: 50%;
        background-image: url('/img/loginPage/bg.png');
    }

    /* タブレットサイズ切ったくらいから小さすぎて不快になるので、大きさ戻す */
    @media screen and (max-width: 830px) {
        .auth_bg {
            background-position: center;
            background-size: contain;
            background-image: url('/img/loginPage/bg.png');
        }
    }
</style>

<body>
    <div class="font-sans text-gray-900 antialiased auth_bg">
        {{ $slot }}
    </div>
</body>

</html>
