@extends("layouts.noLogIn")
@section("title","リリースノート")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">リリースノート</h1>
<div class="mx-auto px-4 mb-12" style="max-width: 1200px">
   
    

@include('components.noLogIn.releaseNote',
['title'=>'一般向けサービスローンチ',
'date'=>'2021年6月14日',
'genre'=>'Feature',
'explain'=>'会員登録してご利用いただけます。
'])
@include('components.noLogIn.releaseNote',
['title'=>'日記のインポート機能を追加しました',
'date'=>'2021年6月10日',
'genre'=>'Feature',
'explain'=>'かどで日記形式のCSVファイル、月に書く日記のTXTファイルがご利用いただけます。
'])
@include('components.noLogIn.releaseNote',
['title'=>'日記のエクスポート機能を追加しました',
'date'=>'2021年6月4日',
'genre'=>'Feature',
'explain'=>'かどで日記形式のCSVファイルを出力できます。
'])

</div>
      
@endsection
 
 