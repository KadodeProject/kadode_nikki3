
@extends("layouts.main")
@section("title","設定")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
      
    <div class="setting">
        <h2 class="text-2xl">インポート</h2>
        <div class="settingContentWrapper">

            <div class="settingContent">
                <h4 class="text-xl">かどで日記形式のCSVファイル</h4>
                <form class="flex justify-center flex-wrap flex-col " method="POST"action="/import/kadode">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <input type="file"accept=".csv" enctype="multipart/form-data"　value="かどで日記形式のCSVファイルをアップロード" name="kadodeCsv">
                    <input type="submit"  class="text-black" value="インポート">
                </form>
            </div>
            <div class="settingContent">
                <h4 class="text-xl">月に書く日記形式のtxtファイル</h4>
                <form class="flex justify-center flex-wrap flex-col " method="POST"action="/import/tukini">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <input type="file"accept=".txt" enctype="multipart/form-data"　value="月に書く日記形式のtxtファイルをアップロード" name="tukiniTxt">
                    <input type="submit" class="text-black" value="インポート">
                </form>
            </div>
        </div>
    </div>
    <div class="setting">
        <h2 class="text-2xl">エクスポート</h2>
        <div class="settingContentWrapper">

            <div class="settingContent"><a href="/export">CSVエクスポート</a></div>
        </div>
    </div>
    

       
    
        
</div>
      
@endsection
 