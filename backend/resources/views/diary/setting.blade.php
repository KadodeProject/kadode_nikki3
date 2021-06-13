
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
                <form class="flex justify-center flex-wrap flex-col " method="POST" enctype="multipart/form-data" action="/import/kadode">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <input type="file"accept=".csv" value="かどで日記形式のCSVファイルをアップロード" name="kadodeCsv">
                    <input type="submit"  class="text-black" value="インポート">
                </form>
            </div>
            <div class="settingContent">
                <h4 class="text-xl">月に書く日記形式のtxtファイル</h4>
                <form class="flex justify-center flex-wrap flex-col " method="POST" enctype="multipart/form-data" action="/import/tukini">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <input type="file"accept=".txt" value="月に書く日記形式のtxtファイルをアップロード" name="tukiniTxt">
                    <input type="submit" class="text-black" value="インポート">
                </form>
            </div>
        </div>
    </div>
    <div class="setting">
        <h2 class="text-2xl">エクスポート</h2>
        <div class="settingContentWrapper">
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/export">
                @csrf
                <input type="submit" class="text-black" value="エクスポートする">
            </form>
            {{-- <div class="settingContent"><a href="/export">CSVエクスポート</a></div> --}}
        </div>
    </div>
    <div class="setting">
        <h2 class="text-2xl">ユーザー削除</h2>
        <p class="text-xl text-red-500">！！一度削除すると復元できません。日記も統計データも全て削除されます。ご注意ください！！</p>
        <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/deleteUser">
            @csrf
            <input type="submit" class="text-black" value="かどで日記からログイン中のユーザーを削除する">
        </form>
    </div>
    

       
    
        
</div>
      
@endsection
 