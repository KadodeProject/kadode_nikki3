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

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <style>
        /* あんまりやりたくないけどCSS読み込みの都合、ここに書く…… */
        .auth_bg{
            background-position:center;
            background-size: contain;
            background-image: url('/img/loginPage/bg.png');
        }
        @
    </style>
    <body>
        <div class="font-sans text-gray-900 antialiased auth_bg" >
            {{ $slot }}
        </div>
    </body>
</html>
