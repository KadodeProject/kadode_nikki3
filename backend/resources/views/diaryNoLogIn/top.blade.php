@extends("layouts.noLogIn")
@section("title","トップ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main py-4 mx-auto" style="max-width: 1200px">
    <div class="mb-4 mt-12">
        <h2 class="text-center text-3xl my-4 kiwi-maru">かどで日記</h2>
        <div class="flex justify-center md:w-1/2 px-4 mx-auto">
            <p class="">かどで日記では日記の作成・管理だけでなく、<br class="md:hidden">日記の分析もできます。</p>
        </div>
        <h2 class="pt-12 text-3xl md:text-5xl text-center h-auto norepeact kiwi-maru" id="kadodeCatchphrase">
            <span>自分で</span><span>作る</span><span>統計データ</span>
        </h2>
    </div>
    <h2 class="mt-24 mb-12 text-center text-4xl kiwi-maru">--流れ--</h2>
    <!--区切り-->
    @component('components.noLogIn.introFrame')
    @slot('icon')
    history_edu
    @endslot
    @slot('title')
    日記を書く
    @endslot
    <img src="/img/topDiscribe/kadodeImageMain.jpg" class="object-contain border-2 button-border-main-color">
    @endcomponent
    <!--区切り-->
    @component('components.noLogIn.introFrame')
    @slot('icon')
    settings
    @endslot
    @slot('title')
    統計の設定を行う
    @endslot
    <p class="text-center my-2 mx-8 ">一般的な辞書にない単語などを<br class="md:hidden">固有表現として登録できます。</p>
    <img src="/img/topDiscribe/kadodeImageSettingStatistic.jpg"
        class="object-contain border-2 button-border-main-color">
    @endcomponent
    <!--区切り-->
    @component('components.noLogIn.introFrame')
    @slot('icon')
    loop
    @endslot
    @slot('title')
    統計を生成する
    @endslot
    <p class="text-center my-2 mx-8">自然言語処理ライブラリ、<br class="md:hidden">GiNZAをベースに用いています。</p>
    <img src="/img/topDiscribe/kadodeImageGeneratingStatistics.jpg"
        class="object-contain border-2 button-border-main-color">


    <h4 class="relative top-12 ml-8 my-4 kiwi-maru text-2xl mt-20 bg-main-color inline-block"><span
            class="material-icons">category</span>処理の流れ</h4>
    <div class="p-8 m-4 border-dashed border-2 border-border-main-color rounded-xl">
        @component('components.statistics.statisticOverallView')
        @endcomponent
    </div>

    @endcomponent
    <!--区切り-->
    @component('components.noLogIn.introFrame')
    @slot('icon')
    menu_book
    @endslot
    @slot('title')
    統計を閲覧する
    @endslot
    <p class="text-center my-2 mx-8">個別、月別、年別、トータルの<br class="md:hidden">統計情報をご覧いただけます。</p>
    <div class="flex justify-center imtes-center flex-wrap my-8">
        <div class="md:w-1/2 w-full ">
            <img src="/img/topDiscribe/kadodeImageNlpTotal.jpg"
                class="object-contain border-2 button-border-main-color">
        </div>
        <div class="md:w-1/2 w-full flex items-center justify-center">
            <p class="text-3xl kiwi-maru">統計(全体)</p>
        </div>
    </div>
    <div class="flex justify-center imtes-center flex-wrap my-8">
        <div class="md:w-1/2 w-full md:order-2">
            <img src="/img/topDiscribe/kadodeImageNlpYear.jpg" class="object-contain border-2 button-border-main-color">
        </div>
        <div class="md:w-1/2 w-full md:order-1 flex items-center justify-center">
            <p class="text-3xl kiwi-maru">統計(年別・月別)</p>
        </div>
    </div>
    <div class="flex justify-center imtes-center flex-wrap my-8">
        <div class="md:w-1/2 w-full ">
            <img src="/img/topDiscribe/kadodeImageNlpDiary.jpg"
                class="object-contain border-2 button-border-main-color">
        </div>
        <div class="md:w-1/2 w-full flex items-center justify-center">
            <p class="text-3xl kiwi-maru">統計(個別)</p>
        </div>
    </div>
    @endcomponent
    <!--区切り-->
    @component('components.noLogIn.introFrame')
    @slot('icon')
    settings
    @endslot
    @slot('title')
    他にも……
    @endslot
    <h4 class="text-center my-4 kiwi-maru text-2xl"><span class="material-icons">military_tech</span>ユーザーランク制度</h4>
    <p class="text-center my-2 mx-8">かどで日記での停泊地に沿った<br class="md:hidden">ユーザーランクが付与されます。</p>
    <div>
        <style>
            object {
                margin: 5px auto;
                width: 900px;
                height: auto;
            }

            @media screen and (max-width: 640px) {
                object {
                    width: 100%;
                }
            }
        </style>
        <object type="image/svg+xml" data="/img/userRank/userRankMap.svg" viewBox="0 0 446.16847 309.23255"></object>
    </div>
    <h4 class="text-center my-4 kiwi-maru text-2xl mt-20"><span class="material-icons">import_export</span>インポート、エクスポート
    </h4>

    <img src="/img/topDiscribe/kadodeImageExport.jpg" class="object-contain border-2 button-border-main-color">
    @endcomponent


    <!--
     Copyright (c) June 1, 2015 Tuomas Pöyry
     Released under the MIT license
     http://opensource.org/licenses/mit-license.php
     -->
    <canvas id="top-animation"></canvas>
    <div class="mb-24 mt-4">
        <p class="text-center mt-4">あくまで個人が作った<br class="md:hidden">趣味の遊びサービスです。<br>ご理解の上、ご利用ください。</p>
        <p class="text-center mt-12">
            <a class="border-2 border-border-main-color p-2 text-3xl  kiwi-maru rounded-2xl" href="{{url("register")}}">新規登録</a>
        </p>
    </div>
    <div class="mt-4 mb-12">
        <h2 class="text-center text-3xl my-4 kiwi-maru"><span class="material-icons">face</span>開発者より</h2>
        <div class="flex justify-center  md:w-1/2 px-4 mx-auto">
            <p class="">開発者のうすゆきと申します。<br>Twitter:@usuyuki26<br>日記書くの、おすすめです！</p>
        </div>
    </div>
    <div class="mt-4 mb-24">
        <h2 class="text-center text-3xl my-4 kiwi-maru"><span class="material-icons">straighten</span>コンセプト</h2>
        <div class="flex justify-start  md:w-1/2 px-4 mx-auto">
            <p class="mx-4">
                人は忘れてしまいます。でも記録は残ります。<br>10世紀に書かれた土佐日記も私達へ受け継がれています。<br>かどで日記の「かどで」は土佐日記に登場する最初の章？「門出」より引用しました。一方で、ページデザインはちょっとSFチックな色を選びました。近未来っぽさと古代っぽさを掛け合わせたコンセプトです。
            </p>
        </div>
    </div>

    {{--
    <div class="w-full h-80 flex items-center justify-center">
        <div>
            <span class="kaihatusya material-icons text-main-color text-xl">
                face
            </span>
        </div>
    </div> --}}


</div>
<script type="text/javascript" src="{{ asset('js/topPerticle.js') }}"></script>

@endsection
