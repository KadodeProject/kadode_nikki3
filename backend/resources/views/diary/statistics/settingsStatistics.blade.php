
@extends("layouts.main")
@section("title","統計")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main mb-12 mt-12">
    <div class="my-12 flex justify-center ">
        <a href="/statistics/home" class="mt-12 " >
          <div class="w-60 h-30 rounded-2xl button-border-main-color border-2 flex items-center justify-center py-12">
            <p class="kiwi-maru ">統計ホームに戻る</p><p class="material-icons">open_in_new</p>
          </div>
        </a>
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パイプライン'])
        @component('components.statistics.statisticOverallView')
        @endcomponent
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'固有表現パッケージの追加'])
        <div class="flex justify-center items-center flex-wrap">
            <div class="nlp-normal-package kiwi-maru text-center">
                <p class="material-icons">inventory</p>
                <p class="text-lg my-2">日本のアニメ名</p>
                <p class="text-sm my-2">うすゆきが見たことあるアニメに限ります</p>
            </div>
            <div class="nlp-normal-package kiwi-maru text-center">
                <p class="material-icons">inventory</p>
                <p class="text-lg my-2">web周りの技術用語</p>
                <p class="text-sm my-2">うすゆきが使う技術に限ります</p>
            </div>
        </div>
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザー固有表現ルール追加'])
        <table class="nlp-normal-table mx-auto"border="1" >
            <tr>
              <th>番号</th><th>ラベル</th><th>単語</th>
            </tr>
            <tr>
              <td>1</td><td>Person</td><td>うすゆき</td>
            </tr>
            <tr>
              <td>2</td><td>Product_Other</td><td>ぶいちゃ</td>
            </tr>
          </table>
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'登録した固有表現のインポート'])
        <div class="mt-12 mb-4">
            <p class="text-sm text-center mb-4 kiwi-maru">かどで日記からエクスポートしていないものは動作保証外です</p>
            <form class="text-center flex justify-center flex-wrap flex-col " method="POST" enctype="multipart/form-data" action="/import/diary/kadode">
                @if(count($errors)>0)
                {{-- エラーの表示 --}}
                <ul class="text-red-500 kiwi-maru">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                @csrf
                <label class="flex md:justify-center flex-wrap text-main-color" for="kadode-csv" >
                    <div class="md:w-full mt-4 mb-2">
                        <span class="file-input-wrapper ">ファイルを選択</span>
                    </div>
                    <input id="kadode-csv" type="file"accept=".csv" class="mx-auto" value="かどで日記csv形式でインポート" name="kadodeCsv">
                </label>
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto"value="インポート">
            </form>
        </div>
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'登録した固有表現のエクスポート'])
        <div class="mt-12 mb-4">
            <p class="text-sm text-center kiwi-maru">※エクスポート時に文字コードをutf-8からWindows-31J(拡張Shift-JIS)に変換してCSVを作成します</p>
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/export/statistics/namedEntity">
                @csrf
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto" value="csv形式でエクスポート">
            </form>
            {{-- <div class="settingContent"><a href="/export/diary">CSVエクスポート</a></div> --}}

        </div>
    </div>


</div>

@endsection
 