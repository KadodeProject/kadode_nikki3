@extends("layouts.main")
@section("title","設定")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
    <div class="setting">
        @include('components.settingHeading',['title'=>'ユーザーランク',])
        <div class="md:ml-12 ml-4 my-4">
            <div>
                <style>
                    svg {
                        margin: 5px auto;
                        width: 900px;
                        height: auto;
                    }

                    @media screen and (max-width: 640px) {
                        svg {
                            width: 100%;
                        }
                    }

                    svg a {
                        pointer-events: all;
                        transition: 1.0s;
                        /* これ付けないと円の中に判定なくなる */
                    }

                    /* ゆっくりホバーできるようにする */
                    a[id$="harbor"] {
                        z-index: 2;
                        transition: 1.0s;
                    }

                    /* 経路はデフォルトで表示しない */
                    a[id$="route"] {
                        opacity: 0 !important;
                    }

                    /* 停泊地名デフォルトで表示しない */
                    text[id$="pname"] {
                        opacity: 0 !important;
                        pointer-events: none !important;
                        transition: 0.5s;
                        /* 文字かぶりで丸がホバーできないの防止 */

                    }

                    /* ホバー時の動作ここから */
                    a[id^="1harbor"]:hover~text[id^="1pname"] {
                        opacity: 1 !important;

                    }

                    a[id^="2harbor"]:hover~text[id^="2pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="3harbor"]:hover~text[id^="3pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="4harbor"]:hover~text[id^="4pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="5harbor"]:hover~text[id^="5pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="6harbor"]:hover~text[id^="6pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="7harbor"]:hover~text[id^="7pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="8harbor"]:hover~text[id^="8pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="9harbor"]:hover~text[id^="9pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="10harbor"]:hover~text[id^="10pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="11harbor"]:hover~text[id^="11pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="12harbor"]:hover~text[id^="12pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="13harbor"]:hover~text[id^="13pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="14harbor"]:hover~text[id^="14pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="15harbor"]:hover~text[id^="15pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="16harbor"]:hover~text[id^="16pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="17harbor"]:hover~text[id^="17pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="18harbor"]:hover~text[id^="18pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="19harbor"]:hover~text[id^="19pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="20harbor"]:hover~text[id^="20pname"] {
                        opacity: 1 !important;
                    }

                    a[id$="harbor"] circle:hover {
                        /* content: "blog"; */
                        fill: wheat !important;
                        transition: 1.0s;
                    }

                    /* ホバー時の動作ここまで */
                </style>
                @for ($i=$user_rank->id; $i >0; $i--)
                <style>
                    /* ユーザーランクの数だけ表示する */
                    /* ルート→-1する */
                    a[id^="{{$i}}harbor"] circle {
                        fill: #4B8996 !important;
                    }

                    text[id^="{{$i}}pname"] {
                        opacity: 1 !important;
                    }

                    a[id^="{{$i-1}}route"] {
                        opacity: 1 !important;
                    }
                </style>
                @endfor
                <p class="text-center text-3xl kiwi-maru">{{$user->name}}さんの<br class="md:hidden">ユーザーランクは<br
                        class="md:hidden">「{{$user_rank->name}}」です。</p>
                <p class="text-center text-xl mt-2 mb-4 kiwi-maru text-button-main-color">{{$user_rank->description}}
                </p>

                <svg viewBox="0 0 446.16847 309.23255" version="1.1" id="svg5"
                    inkscape:version="1.1.1 (3bf5ae0d25, 2021-09-20)" sodipodi:docname="userRankMap.svg"
                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
                    xmlns:svg="http://www.w3.org/2000/svg">
                    <sodipodi:namedview id="namedview7" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0"
                        inkscape:pageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0"
                        inkscape:document-units="mm" showgrid="false" inkscape:zoom="0.5499273" inkscape:cx="780.10312"
                        inkscape:cy="367.32128" inkscape:window-width="3840" inkscape:window-height="2054"
                        inkscape:window-x="-11" inkscape:window-y="-11" inkscape:window-maximized="1"
                        inkscape:current-layer="layer5" units="px" fit-margin-top="0" fit-margin-left="0"
                        fit-margin-right="0" fit-margin-bottom="0" />
                    <defs id="defs2">
                        <rect x="-56.576019" y="-150.44078" width="79.720757" height="187.72952" id="rect29813" />
                        <linearGradient id="linearGradient3156" inkscape:swatch="solid">
                            <stop style="stop-color:#000000;stop-opacity:1;" offset="0" id="stop3154" />
                        </linearGradient>
                    </defs>
                    <g inkscape:groupmode="layer" id="layer5" inkscape:label="線地図" style="display:inline"
                        transform="translate(-28.753738,-0.17792205)">
                        <path
                            style="fill:none;stroke:#000000;stroke-width:0;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 203.9536,57.835051 24.83506,15.479381 -60.3866,65.999998 h -1.36082 l -2.55155,0.51031"
                            id="path1314" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 29.25773,182.69072 23.694395,0.82254 23.25406,1.3888 9.015463,9.35567 5.443299,1.53093 9.695873,11.2268 5.1031,12.07732 1.19072,12.24742 4.59278,12.58763 4.42268,15.81959 28.57732,-34.02062 9.37197,-6.62797 14.78267,-6.29987 9.86598,-7.82474 19.08483,0.37271 12.72445,-6.66652 h 23.81443 l -4.76289,-4.08247 4.25258,-2.04124 -10.20619,-8.50516 12.92784,0.51031 -2.89175,-19.73195 -9.01547,-4.59279 17.52062,-21.26289 3.57217,-6.80412 -11.56701,-11.2268 -11.73712,-1.53093 -6.97422,-9.18557 2.21134,-2.38144 -15.98969,-11.907217 4.25257,-9.355669 -5.4433,-5.273196 -8.33505,1.70103 5.1031,-10.716496 -7.99485,-1.530926 -8.16495,3.061856 L 165,61.917524 l -15.13918,1.360826 -0.3402,-3.402063 -30.78866,11.226805 v -3.061856 l -11.56701,-10.376289 4.59278,17.010309 -10.71649,19.73196 -25.855675,6.123714 -20.072164,-12.247426 -24.664948,1.871133 -1.190723,92.536083 0.340207,0.1701"
                            id="path1320" sodipodi:nodetypes="ccccccccccccccccccccccccccccccccccccccccccccccccc" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 324.7268,85.221648 c -5.4433,0.850516 -36.91237,15.819592 -36.91237,15.819592 l -17.35052,12.75773 -9.86597,-1.53093 c 0,0 -6.29382,15.98969 -5.4433,15.81959 0.85051,-0.17011 6.97422,1.87113 6.97422,1.87113 l -2.38144,9.69588 33.85051,-2.21134 2.21134,-25.34536 31.97939,-20.582477 z"
                            id="path1586" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 208.03608,50.690721 c -0.51031,1.19072 -4.08248,7.14433 -4.08248,7.14433 0,0 -6.80412,2.551546 -5.7835,2.551546 1.02062,0 14.45876,5.953609 14.45876,5.953609 l -5.27319,9.355669 17.18041,-6.293815 c 0,0 -0.51031,8.845362 0.34021,7.824742 0.85051,-1.020617 8.16494,-21.092782 8.16494,-21.092782 z"
                            id="path1923" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 333.23196,308.9072 c 0,0 -27.04639,-30.78866 -26.19589,-32.65979 0.85053,-1.87114 5.95363,-13.09793 4.7629,-13.43814 -1.19073,-0.3402 -7.82474,-4.93298 -7.82474,-4.93298 l 14.11854,-2.21135 -24.32473,-31.12886 -3.57217,-15.64949 -8.33504,-1.53092 c 0,0 11.7371,-10.20619 11.0567,-10.54639 -0.68043,-0.34021 -2.72166,-4.42268 -2.72166,-4.42268 l 15.30927,-3.91238 -7.14431,-10.20618 22.4536,-6.97423 -5.9536,-9.52577 -4.25259,-15.81959 11.90722,-6.46392 h 21.6031 l 21.9433,-10.03608 18.54123,-13.94845 2.89174,-14.28866 -10.71647,-15.479383 -23.30413,1.190721 -20.07217,-1.70103 -26.53609,-28.407217 -14.96907,-19.051545 -23.13403,-6.63402 -16.67009,2.72165 -4.08247,-5.103093 -13.94846,-1.701032 -6.97422,-6.974226 -2.38145,1.701031 5.61341,5.273195 -21.433,4.252579 9.69588,6.293813 -19.56185,-1.190721 -11.90722,-10.036083 -8.50516,-0.340206 v 7.484537 l 10.7165,-2.041237 5.6134,4.762886 -12.41752,5.6134 -5.95361,-0.340204 -5.6134,7.484536 -12.75774,-8.335052 -5.4433,6.463916 -14.37371,-12.16237 0.25516,-10.46134 -25.46779,3.334036 -10.92756,-2.745577 -12.934548,1.112572 -6.292322,9.19823 -7.017369,-4.611868 -8.015154,-4.242121 2.975194,-7.776241 -19.498285,2.158804 -20.667526,-8.335051 2.381443,5.443298 4.252576,5.953609 -5.103092,14.28866 7.144329,6.974226 -10.188203,2.191588 0.04982,-46.80252702 445.102594,0.0439294 0.0796,308.32054762 z"
                            id="path2098"
                            sodipodi:nodetypes="csscccccscccccccccccccccccccccccccccccccccccccccccccccccccccccccc" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 187.58118,50.520618 c 1.02062,0.170103 7.48454,3.61469 7.48454,3.61469 l -5.18815,2.551546 -3.35953,-4.337629 z"
                            id="path2703" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 253.01119,49.856495 c 0.36084,0.180422 3.84899,2.525901 3.84899,2.525901 l 1.86435,-4.931522 -3.90913,-0.360844 z"
                            id="path2892" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 261.491,47.270452 3.51823,4.781172 1.02238,-5.502857 z" id="path3313" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 260.43854,50.698463 c -0.15035,-0.06014 -1.86436,0.03007 -1.86436,0.03007 l -0.9021,2.826604 c 0,0 1.53358,1.683936 1.714,1.593723 0.18042,-0.09021 2.43569,-3.969274 2.43569,-3.969274 z"
                            id="path3315" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 268.28689,51.780992 c -0.0301,0.781826 0.66154,3.428008 0.66154,3.428008 l 2.16505,-0.09021 0.99232,-2.706322 -2.79654,-1.894427 z"
                            id="path3317" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 268.08247,149.77577 3.4871,-1.87113 -2.6366,-2.38145 z" id="path3504" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 249.77512,127.74742 c 0,0 -2.08376,7.71843 -2.19007,7.61212 -0.10632,-0.10632 -3.3808,-6.86792 -3.3808,-6.86792 l 2.33892,-1.59471 -4.76289,-1.12694 4.08248,-4.08247 1.33956,5.01804 z"
                            id="path3640" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 176.93342,49.074667 -0.90211,4.029417 c 0,0 5.95392,-0.751758 5.8637,-0.902108 -0.0902,-0.150352 -4.96159,-3.127309 -4.96159,-3.127309 z"
                            id="path3776" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 141.33023,47.781646 0.15035,5.111946 5.38258,-1.774145 z" id="path3912" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 135.88751,44.71448 -5.41264,4.119626 2.07485,2.706325 5.50285,-4.991664 z"
                            id="path3916" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 129.69304,40.11373 -0.0301,4.360188 3.90914,-3.397941 z" id="path3920" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 114.267,61.644037 c 0,0 5.53292,0.721686 5.62314,0.601406 0.0902,-0.120282 0.6014,-2.375551 0.6014,-2.375551 l -4.7511,-1.473443 z"
                            id="path3924" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 81.430269,59.74961 5.172086,2.616113 c 0,0 0.781827,-3.698643 0.631475,-3.788852 -0.150352,-0.09021 -4.029416,-0.962248 -4.029416,-0.962248 z"
                            id="path3926" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 35.041236,35.849226 c 1.956187,2.12629 6.251289,5.74098 6.251289,5.74098 0,0 4.592783,-1.40335 4.677836,-2.50902 0.08505,-1.10567 -7.271908,-7.867269 -7.271908,-7.867269 z"
                            id="path3928" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 40.399483,28.024484 4.507732,2.764176 8.420103,-4.847939 -6.506443,-4.550257 z"
                            id="path3932" />
                        <path
                            style="display:inline;fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 128.15946,37.527687 3.72871,-1.804215 -0.54127,-2.886747 -3.66857,2.225202 z"
                            id="path3934" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 104.4433,40.654639 3.82732,4.42268 1.44587,-1.275774 -2.38144,-1.19072 2.21134,-2.381443 -1.44588,-1.445876 z"
                            id="path5955" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 104.10309,36.402062 -1.02062,2.126287 2.97681,-0.425257 0.25515,-2.041236 z"
                            id="path5957" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 89.72938,44.056702 2.551547,0.510307 -2.12629,-2.636597 z" id="path5959" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 70.762886,36.657216 7.399483,-2.126289 -3.91237,-1.871134 -5.188143,0.935567 z"
                            id="path5961" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 65.19201,35.742911 3.040591,0.361469 c 0,0 0.80799,-1.488401 0.744202,-1.573453 -0.06379,-0.08505 -1.40335,-0.999356 -1.40335,-0.999356 z"
                            id="path5965" />
                        <path
                            style="fill:#624466;fill-opacity:0.5;stroke:#624466;stroke-width:1;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 67.169458,28.768685 0.106315,2.827965 2.019974,-1.148197 -2.168816,-1.552191 z"
                            id="path5967" />
                    </g>
                    <g inkscape:groupmode="layer" id="layer4" inkscape:label="経路" style="display:inline"
                        transform="translate(-28.753738,-0.17792205)">
                        <a id="1route"
                            transform="matrix(2.1252939,1.8952844,-0.1390028,0.11264285,-106.69293,-26.275623)"
                            xlink:href="">
                            <rect style="fill:#4b8996;fill-opacity:1;fill-rule:evenodd;stroke-width:0.264583"
                                id="rect3240" width="1.3230915" height="12.268667" x="92.203651" y="168.75432" />
                        </a>
                        <a id="2route"
                            transform="matrix(1.6164025,2.2966926,-0.75697285,0.58460224,39.243127,-138.90598)"
                            xlink:href="">
                            <rect style="fill:#4b8996;fill-opacity:1;fill-rule:evenodd;stroke-width:0.264583"
                                id="rect19996" width="1.3230915" height="12.268667" x="92.203651" y="168.75432" />
                        </a>
                        <a id="3route"
                            transform="matrix(-0.07069879,2.8042432,-0.43852126,-0.01012192,138.94678,-76.926166)"
                            xlink:href="">
                            <rect style="fill:#4b8996;fill-opacity:1;fill-rule:evenodd;stroke-width:0.264583"
                                id="rect20000" width="1.3230915" height="12.268667" x="92.203651" y="168.75432" />
                        </a>
                        <a id="4route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.56211;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 62.25773,183.54123 c 3.203324,0.0504 5.800757,2.17635 8.505156,3.57217 0.655013,0.33807 1.447818,0.41326 2.041236,0.85051 0.520462,0.3835 0.733584,1.07379 1.190723,1.53093 1.031375,1.03138 2.540789,2.03048 3.572164,3.06186 1.298834,1.29883 2.442601,2.7828 3.742269,4.08247 0.811136,0.81114 1.781786,1.53471 2.551546,2.38145 2.26804,3.17525 -0.680413,-0.68042 2.041237,2.04123 0.929537,0.92954 0.632219,1.3287 1.70103,2.04124 0.359299,0.23953 0.804489,0.31719 1.190723,0.51031 1.899454,0.94973 0.573926,0.47376 2.721649,1.70103 0.265113,0.15149 0.586764,0.18635 0.850514,0.3402 1.159404,0.67632 2.236137,2.08463 2.891753,3.23196 0.143444,0.25103 0.0408,0.59192 0.170103,0.85052 1.198094,2.39619 0.76712,0.64202 1.530927,2.55155 0.199776,0.49944 0.305501,1.03353 0.51031,1.53092 1.504003,3.65258 4.45995,6.90781 7.99485,8.67526 0.61279,0.3064 1.26563,0.52996 1.87113,0.85052 0.36136,0.19131 0.64698,0.51435 1.02062,0.68041 0.25907,0.11514 0.56701,0 0.85051,0"
                                id="path46660" />
                        </a>
                        <a id="5route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.56211;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 109.20618,224.02577 c -0.56701,0.2835 -1.34305,0.32732 -1.70103,0.85052 -0.70455,1.02972 -0.85051,5.40104 -0.85051,6.80412 0,2.52271 -0.30385,5.33649 0.1701,7.82474 0.42763,2.24504 2.33601,3.90072 2.89175,6.12371 0.15375,0.61501 0.27713,1.24035 0.34021,1.87114 0.0923,0.92328 -0.30668,3.56447 0.1701,4.42268 0.12315,0.22166 0.47407,0.19281 0.68041,0.3402 0.19576,0.13983 0.31786,0.36597 0.51031,0.51031 1.4905,1.11787 3.16496,1.19072 4.93299,1.19072"
                                id="path46740" />
                        </a>
                        <a id="6route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 116.35051,253.96391 c -1.58377,4.75133 0.50609,-0.50397 -2.21134,3.57217 -0.13582,0.20374 -0.2566,4.49186 -0.1701,4.59278 0.34494,0.40243 1.9963,0.80772 2.38144,0.85052 1.42456,0.15828 3.9114,0.21898 5.2732,-0.17011 1.74912,-0.49975 2.60227,-2.04421 3.57216,-3.40206 1.56131,-2.18583 3.28451,-3.98274 3.40207,-6.80412 0.0284,-0.68218 0.0571,-1.39739 -0.17011,-2.04124 -0.13344,-0.37808 -0.56701,-0.56701 -0.85051,-0.85051 -0.69974,-0.69974 -1.1684,-1.26461 -2.04124,-1.70104"
                                id="path46831" />
                        </a>
                        <a id="8route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.5833;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 154.14856,219.09883 c 5.49192,3.79215 12.55705,2.09121 17.35114,-1.78596 1.54893,-1.25268 3.00295,-2.62498 4.51128,-3.92911 0.75417,-0.65206 1.38127,-1.4979 2.25565,-1.96456 0.73515,-0.39235 1.62418,-0.33578 2.42916,-0.53578 0.8728,-0.21686 1.71625,-0.56722 2.60267,-0.71439 2.93298,-0.48692 5.93743,0.21346 8.84907,-0.53578 0.62732,-0.16143 1.15002,-0.60958 1.73512,-0.89298 1.93653,-0.93801 2.41883,-1.58966 3.47022,-3.39334"
                                id="path47116" />
                        </a>
                        <a id="7route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 153.61939,219.09883 c 0.27178,0.8485 0.71657,1.66002 0.81535,2.5455 0.17604,1.57784 0,3.17525 0,4.76288 0,2.62237 0.29328,3.96753 -1.02061,6.46392 -2.13241,4.05158 -2.5458,2.65873 -6.29382,5.10309 -1.3871,0.90463 -2.49847,2.19972 -3.91237,3.06186 -2.38384,1.45356 -2.81372,1.00261 -5.10309,1.53093 -0.80444,0.18563 -1.57072,0.5245 -2.38144,0.68041 -0.67049,0.12894 -1.36683,0.0636 -2.04124,0.1701 -2.0934,0.33054 -1.39528,1.724 -2.89175,2.72165 -0.35449,0.23633 -1.57764,0 -2.04124,0 -0.34021,-0.1134 -0.68041,-0.2268 -1.02062,-0.3402"
                                id="path47608" />
                        </a>
                        <a id="9route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 200.72165,203.4433 c 3.39516,1.25535 8.24466,1.13543 11.90721,1.36082 7.4207,0.45666 4.55201,0.34021 12.07732,0.34021 1.19072,0 2.38145,0 3.57217,0 0.79381,0 1.61303,0.19921 2.38144,0 1.88104,-0.48768 2.90584,-1.83121 4.08247,-3.23196 2.73306,-3.25364 0.99971,-0.97283 2.21134,-3.74227 0.18323,-0.41881 0.51631,-0.76405 0.68042,-1.19072 0.3006,-0.78158 0.1701,-3.02808 0.1701,-3.40206 0,-1.13402 0.17916,-2.28229 0,-3.40207 -0.0574,-0.3585 -0.45361,-0.56701 -0.68041,-0.85051 -1.14428,-1.43035 -2.18688,-2.78063 -4.08248,-3.23196 -1.78619,-0.42528 -1.84764,0.19359 -2.89175,-0.85052"
                                id="path47912" />
                        </a>
                        <a id="10route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 244.43814,135.57216 c 0.40127,3.17937 -0.22247,3.36728 -1.02062,6.29382 -0.0746,0.27351 0.0688,0.57547 0,0.85051 -0.29175,1.167 -0.95367,1.775 -1.70103,2.72165 -1.92514,2.43852 -4.39901,4.14821 -6.63402,6.29382 -0.60807,0.58375 -1.11838,1.262 -1.70103,1.87113 -1.57722,1.64891 -3.76382,2.96719 -4.42268,5.2732 -0.55862,1.95516 1.53745,2.05813 2.72165,2.55154 0.87985,0.36661 1.8005,1.31506 2.38144,2.04124 0.62849,0.78561 1.03209,1.78704 1.70103,2.55155 0.26402,0.30173 0.63526,0.51226 0.85052,0.85051 0.19253,0.30255 0.15951,0.71086 0.3402,1.02062 0.22314,0.38252 0.64056,0.6307 0.85052,1.02062 0.6609,1.22739 0.3402,3.08324 0.3402,4.42268 0,1.79008 0.11907,5.03506 -0.68041,6.63402 -0.57116,1.14232 -0.78948,1.32223 -1.53093,2.38144 -0.18373,0.26249 -0.6526,1.01755 -0.85051,1.19072 -1.10182,0.96409 -0.51287,0.24628 -1.70103,0.51031 -0.24754,0.055 -0.4366,0.27055 -0.68041,0.34021 -0.2726,0.0779 -0.58882,-0.10904 -0.85052,0 -0.58517,0.24382 -1.13402,0.567 -1.70103,0.85051"
                                id="path48002" />
                        </a>
                        <a id="11route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 244.43814,135.57216 c 3.54563,0.72397 5.80682,3.92219 9.01546,5.2732 3.80601,1.60253 2.83914,0.27471 6.63403,1.19072 0.61623,0.14875 1.12255,0.5912 1.70103,0.85051 1.06665,0.47816 2.1727,0.86651 3.23195,1.36083 1.35054,0.63025 2.46956,1.47036 3.91236,1.87113 2.76262,0.76739 5.25312,0.51031 8.16497,0.51031 2.38143,0 4.77361,0.22579 7.14433,0 1.31773,-0.1255 2.60667,-0.46279 3.91237,-0.68041 0.73564,-0.1226 1.48465,-0.17251 2.21133,-0.34021 1.48762,-0.34329 2.94846,-0.79381 4.4227,-1.19072 1.4742,-0.39691 2.99693,-0.64469 4.42266,-1.19072 2.82761,-1.08291 5.53707,-3.88303 8.50517,-4.42268 1.00414,-0.18257 2.04216,0.0434 3.06184,0 1.64676,-0.0701 3.28631,-0.26861 4.93299,-0.3402 0.96301,-0.0419 1.92932,0.0535 2.89177,0 1.08159,-0.0601 2.15124,-0.26568 3.23194,-0.34021 1.55424,-0.10719 3.20622,0 4.76289,0 0.93742,0 2.53206,-0.2649 3.40207,0.1701"
                                id="path48160" />
                        </a>
                        <a id="12route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 330,138.29381 c 0.7938,0.0567 1.60104,0.32618 2.38143,0.17011 0.35359,-0.0707 3.44075,-1.5464 4.2526,-1.87114 0.44352,-0.17741 1.28645,-0.30302 1.701,-0.51031 0.32475,-0.16236 0.51343,-0.54557 0.85053,-0.68041 0.74708,-0.29883 1.96342,0.10562 2.72164,-0.1701 0.38428,-0.13973 0.63272,-0.55112 1.02063,-0.68041 0.71956,-0.23986 2.31756,0 3.06186,0 2.49484,0 4.98968,0 7.48454,0"
                                id="path48205" />
                        </a>
                        <a id="13route" xlink:href="" transform="matrix(1,0,0,1.023294,0,-2.4326689)">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 356.70619,132 c 0.90721,-0.96392 1.88095,-1.8693 2.72164,-2.89175 2.55458,-3.10692 3.94025,-5.1097 5.7835,-8.50516 1.27762,-2.35349 2.1467,-4.88752 3.91237,-6.97423 0.74538,-0.88089 2.39059,-2.55885 3.23196,-3.23196 0.5773,-0.46183 1.26331,-0.7699 1.87113,-1.19072 0.40953,-0.2835 0.37801,-0.56701 0.85053,-0.85051 0.0972,-0.0584 0.24014,0.0534 0.34021,0 0.76366,-0.4073 1.44642,-0.95587 2.21133,-1.36083 0.20661,-0.10938 0.47604,-0.0566 0.6804,-0.1701 2.38268,-1.32371 -0.9916,-0.0145 2.04124,-1.53093 0.25357,-0.12678 0.65005,0.20047 0.85053,0 0.60174,-0.60173 -0.7742,-0.13884 0.3402,-0.51031 0.42426,-0.14142 1.33421,0.24455 1.70103,0 0.66246,-0.44163 -0.35168,-0.3402 0.5103,-0.3402"
                                id="path48299" />
                        </a>
                        <a id="14route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 387.49483,101.21134 c 0.32197,-0.8778 1.10159,-1.441782 1.70103,-2.041238 0.86929,-0.869291 -0.71324,0.237247 0.51033,-0.680413 0.14343,-0.107582 0.43011,-0.0097 0.5103,-0.170103 0.0507,-0.101431 -0.0802,-0.260019 0,-0.340206 0.0901,-0.09005 0.88053,0 1.0206,0"
                                id="path48344" />
                        </a>
                        <a id="15route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 394.97936,95.25773 c 1.49178,-0.361987 1.28831,-0.802077 2.89176,-1.530927 0.38069,-0.173032 1.49355,-0.302815 1.70104,-0.51031"
                                id="path48434" />
                        </a>
                        <a id="16route" xlink:href="" transform="translate(-0.66154578,-0.57755883)">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.49625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 404.67526,93.386597 c 1.59292,-0.07982 3.24246,0.267962 4.76287,-0.340207 0.18983,-0.07593 0.32051,-0.264279 0.51032,-0.340206 0.21059,-0.08423 0.47755,0.10143 0.68041,0 0.22241,-0.111205 0.14787,-0.861632 0.85053,-0.51031 0.47842,0.239223 0.9072,0.56701 1.3608,0.850516"
                                id="path48571" />
                        </a>
                        <a id="17route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.57583;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 416.08041,88.793814 c 2.35466,-0.227111 4.41881,-1.439738 6.15817,-2.891753 0.64993,-0.542587 1.10255,-1.565849 1.81122,-2.041237 0.20255,-0.135885 0.49566,-0.07801 0.72447,-0.170103 0.40016,-0.161065 0.68251,-0.528561 1.08672,-0.680413 0.29347,-0.110241 0.93777,0 1.26787,0"
                                id="path48616" />
                        </a>
                        <a id="18route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.78086;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 430.71269,79.937321 c 1.78361,0.462911 2.52637,-1.423188 3.9276,-2.212565 0.41658,-0.134096 0.83314,-0.268189 1.24969,-0.402285 0.11902,-0.134096 0.20652,-0.317475 0.35705,-0.402285 0.12691,-0.07148 0.80034,-0.09715 0.89265,-0.201142 0.1683,-0.18964 -0.16833,-0.614929 0,-0.804567 0.0842,-0.09482 0.27289,0.09482 0.35705,0 0.0552,-0.0622 0.17852,-0.887104 0.17852,-1.005713"
                                id="path48661" />
                        </a>
                        <a id="19route" xlink:href="">
                            <path
                                style="font-variation-settings:normal;opacity:1;vector-effect:none;fill:none;fill-opacity:1;stroke:#4b899f;stroke-width:2.68392;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;-inkscape-stroke:none;stop-color:#000000;stop-opacity:1"
                                d="m 438.69729,70.336868 c 0.22178,-1.956845 -0.32616,-3.991734 0,-5.938152 0.22644,-1.351505 1.41323,-2.569644 1.87574,-3.851778 0.11162,-0.309271 -0.14245,-0.661288 0,-0.962942 0.3072,-0.650476 0.99,-0.77837 1.45895,-1.283927 0.4616,-0.497638 0.66251,-1.298257 1.45895,-1.604905 0.1864,-0.07177 0.43175,0.0596 0.62525,0 0.18245,-0.05619 0.2411,-0.253314 0.41683,-0.320982 0.12429,-0.04786 0.28324,0.02939 0.41684,0 0.35974,-0.07914 0.67915,-0.25111 1.04212,-0.320981 1.18147,-0.227446 2.73641,0 3.95996,0"
                                id="path48706" />
                        </a>
                    </g>
                    <g inkscape:groupmode="layer" id="layer3" inkscape:label="点" style="display:inline"
                        transform="translate(-28.753738,-0.17792205)">
                        <a id="1harbor" target="" xlink:href="" transform="translate(1.0206186,2.0412371)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="path14968" cx="68.126289" cy="165" r="2.590107" />
                        </a>
                        <a id="2harbor" xlink:href="" transform="translate(0.17010309,1.7010309)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle15118" cx="63.533508" cy="170.01805" r="2.590107" />
                        </a>
                        <a id="3harbor" xlink:href="" transform="translate(0.17010309,1.5309278)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle15120" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="4harbor" xlink:href="" transform="translate(10.036082,1.3608247)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle147" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="5harbor" xlink:href="" transform="translate(59.536081,41.164949)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle159" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="6harbor" xlink:href="" transform="translate(65.829896,71.103092)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle163" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="11harbor" xlink:href="" transform="translate(194.08763,-47.969072)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle167" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="20harbor" xlink:href="" transform="translate(402.12371,-123.66495)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle179" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="19harbor" xlink:href="" transform="translate(389.19588,-107.33505)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle187" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="18harbor" xlink:href="" transform="translate(378.13918,-99.340205)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle199" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="17harbor" xlink:href="" transform="translate(363.85052,-89.814432)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle203" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="a378" xlink:href="3p" transform="translate(334.59279,-77.907216)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle376" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="13harbor" xlink:href="" transform="translate(305.33506,-45.417525)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle584" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="12harbor" xlink:href="" transform="translate(280.67011,-38.953609)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle588" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="9harbor" xlink:href="" transform="translate(147.47938,22.453608)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle861" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="8harbor" xlink:href="" transform="translate(103.76289,36.742268)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle865" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="7harbor" xlink:href="" transform="translate(74.675261,65.659794)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle869" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="10harbor" xlink:href="" transform="translate(177.58763,3.7422684)">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle972" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="14harbor" xlink:href="" transform="translate(334.59279,-77.907216)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle1386" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="15harbor" xlink:href="" transform="translate(342.41753,-84.030927)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle1390" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <a id="16harbor" xlink:href="" transform="translate(351.43299,-86.922679)"
                            inkscape:transform-center-x="2.7216495" inkscape:transform-center-y="-0.68041237">
                            <circle
                                style="fill:none;fill-opacity:1;stroke:#4b8996;stroke-width:1.32057;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                id="circle1664" cx="50.350517" cy="180.30928" r="2.590107" />
                        </a>
                        <text xml:space="preserve" transform="scale(0.26458333)" id="text29811"
                            style="font-style:normal;font-weight:normal;font-size:40px;line-height:1.25;font-family:sans-serif;white-space:pre;shape-inside:url(#rect29813);fill:#000000;fill-opacity:1;stroke:none" />
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="66.395142" y="162.01859" id="1pname">
                            <tspan sodipodi:role="line" id="tspan34925"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="66.395142" y="162.01859">国府</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="47.037617" y="168.2412" id="2pname">
                            <tspan sodipodi:role="line" id="tspan34925-5"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="47.037617" y="168.2412">大津</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="35.640705" y="177.68193" id="3pname">
                            <tspan sodipodi:role="line" id="tspan34925-5-5"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="35.640705" y="177.68193">浦戸</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="64.303078" y="180.74377" id="4pname">
                            <tspan sodipodi:role="line" id="tspan34925-5-5-0"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="64.303078" y="180.74377">大湊</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="102.19525" y="216.62582" id="5pname">
                            <tspan sodipodi:role="line" id="tspan34925-5-5-0-7"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="102.19525" y="216.62582">奈半</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="104.11974" y="245.97441" id="6pname">
                            <tspan sodipodi:role="line" id="tspan34925-5-5-0-7-9"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="104.11974" y="245.97441">室津</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="116.86954" y="240.3212" id="7pname">
                            <tspan sodipodi:role="line" id="tspan48432"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="116.86954" y="240.3212">津呂</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="139.72293" y="212.17543" id="8pname">
                            <tspan sodipodi:role="line" id="tspan48436"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="139.72293" y="212.17543">野根</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="175.5667" y="198.46338" id="9pname">
                            <tspan sodipodi:role="line" id="tspan48440"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="175.5667" y="198.46338">日和佐</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="210.92932" y="183.42825" id="10pname">
                            <tspan sodipodi:role="line" id="tspan48444"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="210.92932" y="183.42825">答島</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="217.78534" y="133.03049" id="11pname">
                            <tspan sodipodi:role="line" id="tspan48448"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="217.78534" y="133.03049">土佐泊</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="325.918" y="134.23331" id="12pname">
                            <tspan sodipodi:role="line" id="tspan48452"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="325.918" y="134.23331">灘 </tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="336.74332" y="129.66261" id="13pname">
                            <tspan sodipodi:role="line" id="tspan48456"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="336.74332" y="129.66261">佐野・貝塚</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="365.24994" y="102.4791" id="14pname">
                            <tspan sodipodi:role="line" id="tspan48460"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="365.24994" y="102.4791">澪標</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="373.78989" y="93.698586" id="15pname">
                            <tspan sodipodi:role="line" id="tspan48464"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="373.78989" y="93.698586">河尻</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="389.18585" y="87.564247" id="16pname">
                            <tspan sodipodi:role="line" id="tspan48468"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="389.18585" y="87.564247">江口</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="403.61957" y="84.677505" id="17pname">
                            <tspan sodipodi:role="line" id="tspan48472"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="403.61957" y="84.677505">鳥飼</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="411.91895" y="77.340363" id="18pname">
                            <tspan sodipodi:role="line" id="tspan48476"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="411.91895" y="77.340363">鵜殿</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:7.05556px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="422.38339" y="69.762657" id="19pname">
                            <tspan sodipodi:role="line" id="tspan48480"
                                style="font-size:7.05556px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="422.38339" y="69.762657">山崎</tspan>
                        </text>
                        <text xml:space="preserve"
                            style="font-size:10.5833px;line-height:1.25;font-family:'Kiwi Maru';-inkscape-font-specification:'Kiwi Maru';display:inline;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                            x="446.80045" y="50.517689" id="20pname">
                            <tspan sodipodi:role="line" id="tspan48484"
                                style="font-size:10.5833px;fill:#f9fff9;fill-opacity:1;stroke-width:0.264583"
                                x="446.80045" y="50.517689">京</tspan>
                        </text>
                    </g>
                </svg>
                <p class="text-center kiwi-maru">{{$user->name}}さんの現在の位置</p>




            </div>
        </div>
        @include('components.settingHeading',['title'=>'アカウント情報・設定',])
        <div class="md:ml-12 ml-4 my-4">
            <p class="text-xl my-2">ユーザー名 : {{$user->name}}</p>
            <p class="text-xl my-2">ユーザーID : {{$userDB->id}}</p>
            <p class="text-xl my-2">ご登録のメールアドレス : {{$userDB->email}}</p>
            <p class="text-xl my-2">アカウント作成日時 : {{$userDB->created_at}}</p>
            <div class="flex justify-start items-center mt-12  flex-wrap ">
                <p class="text-xl mr-4">メールアドレス変更</p>
                <form class="flex justify-center flex-wrap flex-col " method="POST" action="/updateEmail">
                    {{-- エラー --}}
                    @if($errors->has('email'))
                    <p class="text-red-500 kiwi-maru">
                        {{$errors->first('email')}}
                    </p>
                    @endif
                    @csrf
                    <div class="flex justify-start items-center flex-wrap">
                        <input type="email" name="email" class="mr-2" autocomplete="off" placeholder="新しいメールアドレス">
                        <input type="submit" class="text-black" value="メールアドレスを変更する">
                    </div>
                </form>
            </div>
            <div class="flex justify-start items-center my-4 flex-wrap">
                <p class="text-xl mr-4">パスワード変更　　</p>
                <form class="flex justify-center flex-wrap flex-col " method="POST" action="/updatePassWord">
                    {{-- エラー --}}
                    @if($errors->has('password'))
                    <p class="text-red-500 kiwi-maru">
                        {{$errors->first('password')}}
                    </p>
                    @endif
                    @csrf
                    <div class="flex justify-start items-center flex-wrap">
                        <input type="password" name="password" class="mr-2" autocomplete="off" placeholder="新しいパスワード">
                        <input type="submit" class="text-black" value="パスワードを変更する">
                    </div>
                </form>
                <p class="kiwi-maru text-sm">※8文字以上100文字未満</p>
            </div>

        </div>


    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'日記のインポート',])
        <div class="settingContentWrapper flex justify-center items-center flex-wrap">

            <div class="settingContent md:w-1/2 w-full">
                <h4 class="text-xl text-center mt-4">かどで日記形式の<br class="md:hidden">CSVファイル</h4>
                <p class="text-sm text-center mb-4">かどで日記からエクスポートしていないものは動作保証外です</p>
                <form class="text-center flex justify-center flex-wrap flex-col " method="POST"
                    enctype="multipart/form-data" action="/import/diary/kadode">
                    {{-- エラー --}}
                    @if($errors->has('kadodeCsv'))
                    <p class="text-red-500 kiwi-maru">
                        {{$errors->first('kadodeCsv')}}
                    </p>
                    @endif
                    @csrf
                    <label class="flex md:justify-center flex-wrap" for="kadode-csv">
                        <div class="md:w-full mt-4 mb-2">
                            <span class="file-input-wrapper">ファイルを選択</span>
                        </div>
                        <input id="kadode-csv" type="file" accept=".csv" class="mx-auto" value="かどで日記csv形式でインポート"
                            name="kadodeCsv">
                    </label>
                    <input type="submit" class="text-black w-full" value="インポート">
                </form>
            </div>
            <div class="settingContent md:w-1/2 w-full">
                <h4 class="text-xl text-center mt-4">月に書く日記形式の<br class="md:hidden">txtファイル</h4>
                <p class="text-sm text-center mb-4">月に書く日記からエクスポートしていないものは動作保証外です</p>
                <form class="text-center flex justify-center flex-wrap flex-col " method="POST"
                    enctype="multipart/form-data" action="/import/diary/tukini">
                    {{-- エラー --}}
                    @if($errors->has('tukiniTxt'))
                    <p class="text-red-500 kiwi-maru">
                        {{$errors->first('tukiniTxt')}}
                    </p>
                    @endif
                    @csrf
                    <label class="flex md:justify-center flex-wrap" for="tuki-txt">
                        <div class="md:w-full mt-4 mb-2">
                            <span class="file-input-wrapper">ファイルを選択</span>
                        </div>
                        <input id="tuki-txt" type="file" accept=".txt" class="mx-auto" value="月に書く日記txt形式でインポート"
                            name="tukiniTxt">
                    </label>
                    <input type="submit" class="text-black w-full" value="インポート">
                </form>
            </div>
        </div>
    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'日記のエクスポート'])
        <p class="text-sm text-center kiwi-maru">※エクスポート時に文字コードをutf-8からWindows-31J(拡張Shift-JIS)に変換してCSVを作成します</p>
        <div class="settingContentWrapper">
            <form class="flex justify-center flex-wrap flex-col " method="POST" action="/export/diary">
                @csrf
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto" value="csv形式でエクスポート">
            </form>
            {{-- <div class="settingContent"><a href="/export/diary">CSVエクスポート</a></div> --}}
        </div>
    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'各種操作'])

        <form class="flex justify-center flex-wrap flex-col my-2" method="POST" action="/logout">
            @csrf
            <input type="submit" class="text-black bg-status-good md:w-1/2 w-full mx-auto" value="ログアウト">
        </form>
    </div>



    <div class="setting">
        @include('components.settingHeading',['title'=>'Danger Zone'])
        <p class="text-xl text-red-500 kiwi-maru text-center">！！一度削除すると復元できません。日記も統計データも全て削除されます。ご注意ください！！</p>
        <form class="flex justify-center flex-wrap flex-col" method="POST" action="/deleteUser">
            @csrf
            <input type="submit" class="text-black bg-status-poor md:w-1/2 w-full mx-auto" value="アカウント削除">
        </form>
    </div>

    <div class="setting">
        @include('components.settingHeading',['title'=>'全体情報'])
        <p class="ml-4 kiwi-maru">現在の総ユーザー数:{{$userCounter}}人</p>
    </div>





</div>

@endsection
