@extends("layouts.noLogIn")
@section("title","トップ")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main py-4 mx-auto" style="max-width: 1200px">
   <div class="mb-4 mt-12">
       <h2 class="text-center text-3xl my-4 kiwi-maru">かどで日記とは？</h2>
       <div class="flex justify-start w-1/2 mx-auto">
           <p class="">かどで日記はweb上で日記を作成、管理できるサービスです。日記の検索機能だけでなく、形態素解析などを用いた統計機能の実装も準備中です。</p>
       </div>
   </div>

    <!--
    Copyright (c) June 1, 2015 Tuomas Pöyry
    Released under the MIT license
    http://opensource.org/licenses/mit-license.php
    -->
   <canvas id="top-animation"></canvas>
   <div class="mt-4">
       <h2 class="text-center text-3xl my-4 kiwi-maru">コンセプト</h2>
       <div class="flex justify-start w-1/2 mx-auto">
           <p class="">人は忘れてしまいます。でも記録は残ります。10世紀に書かれた土佐日記も私達へ受け継がれています。かどで日記の「かどで」は土佐日記に登場する最初の章？「門出」より引用しました。一方で、ページデザインはちょっとSFチックな色を選びました。近未来っぽさと古代っぽさを掛け合わせたコンセプトです。</p>
       </div>
   </div>
   <div class="w-full h-80 flex items-center justify-center">
<div>

    <span class="kaihatusya material-icons text-main-color text-xl">
        face
        
    </span>
</div>
   </div>
   <div class="mb-24">
       <h2 class="text-center text-3xl my-4 kiwi-maru">開発者より</h2>
       <div class="flex justify-start w-1/2 mx-auto">
           <p class="">開発者のうすゆきと申します。大学2年で工学部です。私は日記が好きで、高校生の頃の甘酸っぱい？思い出から現代に至るまで日記を書き続けています。開発経緯はwebで使える日記サービスの少なさです。スマホアプリとしては存在しても、webサービスタイプはありませんでした。さらに、大学の講義でデータサイエンスを学び、日記を分析することの楽しさに気づきました。</p>
       </div>
   </div>
   <div class="mb-24">
       <p class="text-center">
           <a class="kadode-normal-button text-4xl " href="{{url("register")}}">新規登録</a>
       </p>
   </div>
</div>
<script type="text/javascript" src="{{ asset('js/topPerticle.js') }}"></script>

@endsection
 