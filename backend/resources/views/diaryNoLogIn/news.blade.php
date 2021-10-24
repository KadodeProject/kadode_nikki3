@extends("layouts.noLogIn")
@section("title","お知らせ")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">お知らせ</h1>
<div class="mx-auto px-4" style="max-width: 1200px">
   
    

@include('components.noLogIn.news',
['title'=>'かどで日記wikiの作成について',
'date'=>'2021年10月21日',
'explain'=>'従来docsディレクトリ下にあった文書周りをGitHub wikiに移動しました。
'])
@include('components.noLogIn.news',
['title'=>'内部バックアップについて',
'date'=>'2021年10月21日',
'explain'=>'かどで日記では毎日夜間にデータベースのバックアップと外部ストレージへの転送を行うシステムを始動しました。しかしこれは若干のフェールセーフにすぎません。大切なデータは日記のエクスポートを行うなどして保管することを引き続きおすすめします。
'])
@include('components.noLogIn.news',
['title'=>'統計の解析時間について',
'date'=>'2021年10月2日',
'explain'=>'統計機能での日記解析にはかなりの時間を要します。1000日記(約40万字)ですと混雑なしの状態で解析終了までおよそ2時間を要します。二度目以降の解析は更新分のみ自然言語処理を通すので初回より早くなります。解析中でも日記の閲覧などご利用いただけます。
'])
@include('components.noLogIn.news',
['title'=>'Google Analyticsの部分導入',
'date'=>'2021年9月16日',
'explain'=>'より快適なサイト運用を行うため、ログインを伴わないページに限りGoogle Analyticsを導入いたしました。ログイン後のページはGoogle Analyticsが作用しませんので、安心してご利用ください。
'])
@include('components.noLogIn.news',
['title'=>'自然言語処理機能追加について',
'date'=>'2021年9月6日',
'explain'=>'かどで日記では自然言語処理の導入を進めています。本日2021年9月6日に最初の自然言語処理機能の1つである、「名詞」「形容詞」の登場順をグラフ化しました。統計コーナーでご覧いただけます。
'])
@include('components.noLogIn.news',
['title'=>'セキュリティ対策について',
'date'=>'2021年9月4日',
'explain'=>'SQLインジェクション対策、XSS攻撃対策が機能していることを改めて確認しました。
'])
@include('components.noLogIn.news',
['title'=>'プライバシーポリシー改定',
'date'=>'2021年7月3日',
'explain'=>'プライバシーポリシーを一部改定いたしました。
'])
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
@include('components.noLogIn.news',
['title'=>'かどで日記公開',
'date'=>'2021年6月14日',
'explain'=>'かどで日記を一般公開しました。
'])


</div>
      
@endsection
 
 