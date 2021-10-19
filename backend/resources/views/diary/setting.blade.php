
@extends("layouts.main")
@section("title","設定")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
    <div class="setting">
        @include('components.settingHeading',['title'=>'アカウント情報・設定',])
        <div class="md:ml-12 ml-4 my-4">
            <p class="text-xl my-2">ユーザー名 : {{$user->name}}</p>
            <p class="text-xl my-2">ユーザーID : {{$userDB->id}}</p>
            <p class="text-xl my-2">ご登録のメールアドレス : {{$userDB->email}}</p>
            <p class="text-xl my-2">アカウント作成日時 : {{$userDB->created_at}}</p>
            <div class="flex justify-start items-center mt-12  flex-wrap ">
                <p class="text-xl mr-4">メールアドレス変更</p>
                <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updateEmail">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500 kiwi-maru">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <div class="flex justify-start items-center flex-wrap">
                        <input type="email" name="email"class="mr-2" autocomplete="off"  placeholder="新しいメールアドレス">
                        <input type="submit" class="text-black" value="メールアドレスを変更する">
                    </div>
                </form>
            </div>
            <div class="flex justify-start items-center my-4 flex-wrap">
                <p class="text-xl mr-4">パスワード変更　　</p>
                <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updatePassWord">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500 kiwi-maru">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <div class="flex justify-start items-center flex-wrap">
                        <input type="password" name="password" class="mr-2" autocomplete="off" placeholder="新しいパスワード">
                        <input type="submit" class="text-black" value="パスワードを変更する">
                    </div>
                </form>
            </div>
           
        </div>
     
    
    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'日記のインポート',])
        <div class="settingContentWrapper flex justify-center items-center flex-wrap">

            <div class="settingContent md:w-1/2 w-full">
                <h4 class="text-xl text-center mt-4">かどで日記形式の<br class="md:hidden">CSVファイル</h4>
                <p class="text-sm text-center mb-4">かどで日記からエクスポートしていないものは動作保証外です</p>
                <form class="text-center flex justify-center flex-wrap flex-col " method="POST" enctype="multipart/form-data" action="/import/kadode">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500 kiwi-maru">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <label class="flex md:justify-center flex-wrap" for="kadode-csv" >
                        <div class="md:w-full mt-4 mb-2">
                            <span class="file-input-wrapper">ファイルを選択</span>
                        </div>
                        <input id="kadode-csv" type="file"accept=".csv" class="mx-auto" value="かどで日記csv形式でインポート" name="kadodeCsv">
                    </label>
                    <input type="submit"  class="text-black w-full"value="インポート">
                </form>
            </div>
            <div class="settingContent md:w-1/2 w-full">
                <h4 class="text-xl text-center mt-4">月に書く日記形式の<br class="md:hidden">txtファイル</h4>
                <p class="text-sm text-center mb-4">月に書く日記からエクスポートしていないものは動作保証外です</p>
                <form class="text-center flex justify-center flex-wrap flex-col " method="POST" enctype="multipart/form-data" action="/import/tukini">
                    @if(count($errors)>0)
                    {{-- エラーの表示 --}}
                    <ul class="text-red-500 kiwi-maru">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @csrf
                    <label class="flex md:justify-center flex-wrap" for="tuki-txt" >
                        <div class="md:w-full mt-4 mb-2">
                            <span class="file-input-wrapper">ファイルを選択</span>
                        </div>
                        <input id="tuki-txt"type="file"accept=".txt" class="mx-auto" value="月に書く日記txt形式でインポート" name="tukiniTxt">
                    </label>
                    <input type="submit" class="text-black w-full" value="インポート">
                </form>
            </div>
        </div>
    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'日記のエクスポート'])
        <p class="text-sm text-center kiwi-maru">※エクスポート時に文字コードをutf-8からWindows-31J(拡張Shift-JIS)に変換してCSVを作成します</p>
        <div class="settingContentWrapper">
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/export">
                @csrf
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto" value="csv形式でエクスポート">
            </form>
            {{-- <div class="settingContent"><a href="/export">CSVエクスポート</a></div> --}}
        </div>
    </div>
    <div class="setting">
        @include('components.settingHeading',['title'=>'各種操作'])

        <form class="flex justify-center flex-wrap flex-col my-2" method="POST"  action="/logout">
            @csrf
            <input type="submit" class="text-black bg-status-good md:w-1/2 w-full mx-auto" value="ログアウト">
        </form>
    </div>

  
    
     <div class="setting">
        @include('components.settingHeading',['title'=>'Danger Zone'])
        <p class="text-xl text-red-500 kiwi-maru text-center">！！一度削除すると復元できません。日記も統計データも全て削除されます。ご注意ください！！</p>
        <form class="flex justify-center flex-wrap flex-col" method="POST"  action="/deleteUser">
            @csrf
            <input type="submit" class="text-black bg-status-poor md:w-1/2 w-full mx-auto" value="アカウント削除">
        </form>
    </div>

    <div class="setting">
        @include('components.settingHeading',['title'=>'全体情報'])
      <p class="ml-4 kiwi-maru">現在の総ユーザー数:{{$userCounter}}人</p>
    </div>
    
 
       
    
        
</div>
      
@endsection
 