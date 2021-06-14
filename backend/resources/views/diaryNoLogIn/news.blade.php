@extends("layouts.noLogIn")
@section("title","お知らせ")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">お知らせ</h1>
<div class="mx-auto px-4" style="max-width: 1200px">
   
    

@include('components.noLogIn.news',
['title'=>'かどで日記公開',
'date'=>'2021年6月14日',
'explain'=>'かどで日記を一般公開しました。
'])

</div>
      
@endsection
 
 