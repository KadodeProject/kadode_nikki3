
@extends("layouts.main")
@section("title","統計")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main" style="min-height: 100vh">



@empty($statistics)
    <h2 class="text-center text-2xl">統計データはありません。</h2>

    <div class="mt-12">
        <div class="setting">
            <h2 class="text-2xl">統計データ作成(α版)</h2>
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/makeStatistics">
                @csrf
                <input type="submit" class="text-black" value="統計データを生成する">
            </form>
        </div>
    </div>
    
@else
<div>
    <div class="setting">
        <h2 class="text-2xl">統計データ更新</h2>
        <p class="text-xl ">※24時間以内に更新済みの場合、新たに生成はされません。</p>
        <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updateStatistics">
            @csrf
            <input type="submit" class="text-black" value="統計データを更新する">
        </form>
    </div>
</div>

<div class="flex justify-center">
    <div>

        <p class="text-xl ml-4">総文字数 : {{$statistics->total_words}}</p>
        <p class="text-xl ml-4">総日記数 : {{$statistics->total_diaries}}</p>
        <p class="text-xl ml-4">生成日 : {{$statistics->updated_at}}</p>
    </div>
</div>
@endempty
<div>


<h1 class="text-center mt-12 text-3xl" style="">他の機能については準備中です。</h1>
<p class="text-center mt-12 text-xl mx-2" style="">このページでは、文字数のグラフ化や形態素解析を用いた品詞の傾向の表示を検討しています。</p>
<img src="img/others/shigureniConstructing2.png" class="mx-auto object-contain h-80 w-80">
</div>
</div>

@endsection
 