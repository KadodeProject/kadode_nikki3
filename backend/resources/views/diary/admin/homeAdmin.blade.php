@extends("layouts.main")
@section("title","管理者ページ")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'リンク集'])

        <p class="text-center my-12 mx-4 text-3xl"><a href="">パッケージ</a></p>
        <p class="text-center my-12 mx-4 text-3xl"><a href="">通知管理</a></p>
        <p class="text-center my-12 mx-4 text-3xl"><a href="">ロール</a></p>
    </div>
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'php情報'])

        <?php //phpinfo(); ?>
    </div>
</div>

@endsection
