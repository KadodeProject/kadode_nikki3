
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
                    <input type="file"accept=".csv" class="w-full" value="かどで日記形式のCSVファイルをアップロード" name="kadodeCsv">
                    <input type="submit"  class="text-black w-full"value="インポート">
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
                    <input type="file"accept=".txt" class="w-full" value="月に書く日記形式のtxtファイルをアップロード" name="tukiniTxt">
                    <input type="submit" class="text-black w-full" value="インポート">
                </form>
            </div>
        </div>
    </div>
    <div class="setting">
        <h2 class="text-2xl">エクスポート</h2>
        <h3 class="text-xl">かどで日記CSV形式でエクスポート</h3>
        <div class="settingContentWrapper">
            <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/export">
                @csrf
                <input type="submit" class="text-black px-2" value="CSV形式でエクスポートする">
            </form>
            {{-- <div class="settingContent"><a href="/export">CSVエクスポート</a></div> --}}
        </div>
    </div>
    <div class="setting">
        <h2 class="text-2xl">ログアウト</h2>
        <form class="flex justify-center flex-wrap flex-col my-2" method="POST"  action="/logout">
            @csrf
            <input type="submit" class="text-black" value="ログアウトする">
        </form>
    </div>
    <div class="setting">
        <h2 class="text-2xl">ユーザー情報</h2>
    <div class="text-left flex justify-center my-4">
        <div>
            <p class="text-xl">ユーザー名 : {{$user->name}}</p>
            <p class="text-xl">ユーザーID : {{$userDB->id}}</p>
            <p class="text-xl">ご登録のメールアドレス : {{$userDB->email}}</p>
            <p class="text-xl">アカウント作成日時 : {{$userDB->created_at}}</p>
        </div>
    </div>
    </div>
  
    <div class="setting">
        <h2 class="text-2xl">パスワード変更</h2>
        
        <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updatePassWord">
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <ul class="text-red-500">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            @csrf
            <input type="password" name="password" placeholder="新しいパスワード">
            <input type="submit" class="text-black" value="パスワードを変更する">
        </form>
    </div>

    <div class="setting">
        <h2 class="text-2xl">メールアドレス変更</h2>
        <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/updateEmail">
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <ul class="text-red-500">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            @csrf
            <input type="email" name="email" placeholder="新しいメールアドレス">
            <input type="submit" class="text-black" value="メールアドレスを変更する">
        </form>
    </div>
    
     <div class="setting">
        <h2 class="text-2xl">ユーザー削除</h2>
        <p class="text-xl text-red-500">！！一度削除すると復元できません。日記も統計データも全て削除されます。ご注意ください！！</p>
        <form class="flex justify-center flex-wrap flex-col " method="POST"  action="/deleteUser">
            @csrf
            <input type="submit" class="text-black" value="ログイン中のユーザーを削除する">
        </form>
    </div>
    
 
       
    
        
</div>
      
@endsection
 