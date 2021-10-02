@extends("layouts.noLogIn")
@section("title","トップ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main py-4 mx-auto" style="max-width: 1200px">
   <div class="mb-4 mt-12">
       <h2 class="text-center text-3xl my-4 kiwi-maru">かどで日記とは？</h2>
       <div class="flex justify-start md:w-1/2 px-4 mx-auto">
           <p class="">かどで日記はweb上で日記を作成、管理できるサービスです。日記の検索機能だけでなく、形態素解析などを用いた統計機能の実装も準備中です。</p>
       </div>
   </div>
   <h2 class="mt-24 mb-12 text-center text-3xl kiwi-maru">できること</h2>
   <div class="flex justify-center imtes-center flex-wrap my-8">
       <div class="md:w-1/2 w-full ">
        <img src="/img/topDiscribe/kadodeImageMain.jpg" class="object-contain border-2 button-border-main-color">
       </div>
       <div class="md:w-1/2 w-full flex items-center justify-center">
        <p class="text-3xl kiwi-maru">日記作成</p>
       </div>
   </div>
   <div class="flex justify-center imtes-center flex-wrap my-8">
       <div class="md:w-1/2 w-full md:order-2">
        <img src="/img/topDiscribe/kadodeImageArchive.jpg" class="object-contain border-2 button-border-main-color">
        </div>
        <div class="md:w-1/2 w-full md:order-1 flex items-center justify-center">
        <p class="text-3xl kiwi-maru">閲覧</p>
        </div>
   </div>
   <div class="flex justify-center imtes-center flex-wrap my-8">
       <div class="md:w-1/2 w-full ">
            <img src="/img/topDiscribe/kadodeImageNlpTotal.jpg" class="object-contain border-2 button-border-main-color">
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
             <img src="/img/topDiscribe/kadodeImageNlpDiary.jpg" class="object-contain border-2 button-border-main-color">
        </div>
        <div class="md:w-1/2 w-full flex items-center justify-center">
             <p class="text-3xl kiwi-maru">統計(個別)</p>
        </div>
    </div>
   <div class="flex justify-center imtes-center flex-wrap my-8">
       <div class="md:w-1/2 w-full md:order-2">
           <img src="/img/topDiscribe/kadodeImageExport.jpg" class="object-contain border-2 button-border-main-color">
      </div>
       <div class="md:w-1/2 w-full md:order-1 flex items-center justify-center">
            <p class="text-3xl kiwi-maru">入出力</p>
        </div>
   </div>
   <p class="text-center mb-4 kiwi-maru">などなど……</p>
      <!--
     Copyright (c) June 1, 2015 Tuomas Pöyry
     Released under the MIT license
     http://opensource.org/licenses/mit-license.php
     -->
     <canvas id="top-animation"></canvas>
   <div class="mb-24 mt-4">
       <p class="text-center">
           <a class="border-2 border-border-main-color p-2 text-3xl  kiwi-maru" href="{{url("register")}}">新規登録</a>
        </p>
        <p class="text-center mt-4">あくまで個人が作った趣味の遊びサービスです。<br>ご理解の上、ご利用ください。</p>
    </div> 
    <div class="mt-4 mb-12">
        <h2 class="text-center text-3xl my-4 kiwi-maru">開発者より</h2>
        <div class="flex justify-center  md:w-1/2 px-4 mx-auto">
            <p class="">開発者のうすゆきと申します。<br>日記書くの、おすすめです！</p>
        </div>
    </div>
    <div class="mt-4 mb-24">
        <h2 class="text-center text-3xl my-4 kiwi-maru">コンセプト</h2>
        <div class="flex justify-start  md:w-1/2 px-4 mx-auto">
            <p class="">人は忘れてしまいます。でも記録は残ります。10世紀に書かれた土佐日記も私達へ受け継がれています。かどで日記の「かどで」は土佐日記に登場する最初の章？「門出」より引用しました。一方で、ページデザインはちょっとSFチックな色を選びました。近未来っぽさと古代っぽさを掛け合わせたコンセプトです。</p>
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
 