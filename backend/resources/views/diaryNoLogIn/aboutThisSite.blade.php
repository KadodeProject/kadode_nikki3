@extends("layouts.noLogIn")
@section("title","このサイトについて")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">このサイトについて</h1>
<div class="mx-auto px-4" style="max-width: 1200px">
   
    
    @include('components.noLogIn.explain',
    ['title'=>'技術スタックについて',
    'explain'=>'本サイトはLaravelを用いて開発しています。
    '])
    @include('components.noLogIn.explain',
    ['title'=>'複数タブでのご利用',
    'explain'=>'複数のタブで同時に開いて日記の作成などを行うとCSRF(クロスサイトリクエストフォージェリ)対策関係のシステムの都合で409エラーが生じてあいさつなどができないことがあります。複数タブでのご利用はご遠慮ください。
    '])
    
    @include('components.noLogIn.explain',
    ['title'=>'JavaScript',
    'explain'=>'本サイトでは、時計やグラフの表示、デザインのためにJavaScript を使用しています。ご使用のブラウザ設定においてJavaScript をオン (有効) にされていない場合に、時計やグラフが正しく表示されない場合やレイアウトが崩れる場合がありますので、ご了承ください。
    '])
    
    @include('components.noLogIn.explain',
    ['title'=>'Cookie',
    'explain'=>'本サイトでは、ご利用者様が訪問された際、より快適にご利用いただくため、Cookie を使用しております。Cookie は、本サイトの運用に関連するサーバから、ご利用者さまのブラウザに送信する情報で、ご利用者さまのコンピューターに記録されますが、ご利用者さまのコンピューターへ直接的な悪影響を及ぼすことはございません。
    ご本人の希望で「Cookie」の受け取りを、ブラウザで設定することにより拒否することができますが、ログインや日記の作成が利用できない場合がありますので、予めご了承ください。
    '])
{{--     
    @include('components.noLogIn.explain',
    ['title'=>'Google Analytics',
    'explain'=>'本サービスではGoogleによるアクセス解析ツール「GoogleAnalytics」を利用しています。このGoogleAnalyticsはトラフィックデータの収集のためにクッキー（Cookie）を使用しております。トラフィックデータは匿名で収集されており、個人を特定するものではありません。この機能はCookieを無効にすることで収集を拒否することが出来ますので、お使いのブラウザの設定をご確認ください。
    '])
    <p class="mb-20"><br><a href="https://policies.google.com/technologies/partner-sites?hl=ja">GoogleAnalyticsの利用規約</a><br><a href="https://policies.google.com/technologies/partner-sites?hl=ja">Googeプライバシーポリシー</a></p>
     --}}

    
</div>
      
@endsection
 
 