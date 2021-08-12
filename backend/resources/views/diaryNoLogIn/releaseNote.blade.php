@extends("layouts.noLogIn")
@section("title","リリースノート")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">リリースノート</h1>
<div class="mx-auto px-4 mb-12" style="max-width: 1200px">
   
    

@include('components.noLogIn.releaseNote',
['title'=>'日記編集ページ改善',
'date'=>'2021年8月12日',
'genre'=>'Fix',
'explain'=>'前後の日記のリンクが表示されるようになりました。ただし、一番最新の日記だけ過去の日記へのリンクが正しく表示されないバグがあります。熟考した結果直近では実用上問題ないと判断し、導入しました。
'])
@include('components.noLogIn.releaseNote',
['title'=>'日記表示文字数変更',
'date'=>'2021年8月12日',
'genre'=>'Fix',
'explain'=>'ホームページやアーカイブページなどで日記の表示文字数を最大2000文字に変更しました。
'])
@include('components.noLogIn.releaseNote',
['title'=>'統計機能追加',
'date'=>'2021年6月19日',
'genre'=>'Feature',
'explain'=>'月ごとの1日記あたりの平均文字数推移、月ごとの日記執筆率のグラフが表示できるようになりました。
'])
@include('components.noLogIn.releaseNote',
['title'=>'レスポンシブ対応',
'date'=>'2021年6月19日',
'genre'=>'Feature',
'explain'=>'スマホでもかどで日記をご利用いただけるようになりました。
'])
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
 
 