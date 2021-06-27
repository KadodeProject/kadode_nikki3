@extends("layouts.noLogIn")
@section("title","お知らせ")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">お知らせ</h1>
<div class="mx-auto px-4" style="max-width: 1200px">
   
    

@include('components.noLogIn.news',
['title'=>'利用規約改定',
'date'=>'2021年6月27日',
'explain'=>'利用規約を一部改定いたしました。
'])
@include('components.noLogIn.news',
['title'=>'かどで日記ポスター作成',
'date'=>'2021年6月19日',
'explain'=>'かどで日記ポスターを作ってみました。よろしければ御覧ください。
'])
@include('components.noLogIn.news',
['title'=>'かどで日記公開',
'date'=>'2021年6月14日',
'explain'=>'かどで日記を一般公開しました。
'])

</div>
      
@endsection
 
 