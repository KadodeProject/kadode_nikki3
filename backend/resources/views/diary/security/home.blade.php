@extends("layouts.main")
@section("title","設定")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
    @include('components.settingHeading',['title'=>'ログイン情報',])
    @include('components.settingHeading',['title'=>'アカウント情報',])
    <div class="md:ml-12 ml-4 my-4">
        <p class="text-xl my-2">ユーザー名 : {{$user->name}}</p>
        <p class="text-xl my-2">ユーザーID : {{$user->id}}</p>
        <p class="text-xl my-2">ご登録のメールアドレス : {{$user->email}}</p>
        <p class="text-xl my-2">アカウント作成日時 : {{$user->email_verified_at}}</p>
        <p class="text-xl my-2">メール認証日時 : {{$user->created_at}}</p>
        <p class="text-xl my-2">ユーザーランクID : {{$user->user_rank_id}}</p>
        <p class="text-xl my-2">ユーザーロールID : {{$user->user_role_id}}</p>
        <p class="text-xl my-2">--フラグ--</p>
        <p class="text-xl my-2 ml-4">is_showed_update_user_rank : {{$user->is_showed_update_user_rank}}</p>
        <p class="text-xl my-2 ml-4">is_showed_update_system_info : {{$user->is_showed_update_system_info}}</p>
        <p class="text-xl my-2 ml-4">is_showed_service_info : {{$user->is_showed_service_info}}</p>
    </div>
    @include('components.settingHeading',['title'=>'アカウント情報変更',])
    <div class="md:ml-12 ml-4 my-4">

        <div class="flex justify-start items-center mt-12  flex-wrap ">
            <p class="text-xl mr-4">メールアドレス変更</p>
            <form class="flex justify-center flex-wrap flex-col " method="POST" action="/updateEmail">
                {{-- エラー --}}
                @if($errors->has('email'))
                <p class="text-red-500 kiwi-maru">
                    {{$errors->first('email')}}
                </p>
                @endif
                @csrf
                <div class="flex justify-start items-center flex-wrap">
                    <input type="email" name="email" class="mr-2" autocomplete="off" placeholder="新しいメールアドレス">
                    <input type="submit" class="text-black" value="メールアドレスを変更する">
                </div>
            </form>
        </div>
        <div class="flex justify-start items-center my-4 flex-wrap">
            <p class="text-xl mr-4">パスワード変更　　</p>
            <form class="flex justify-center flex-wrap flex-col " method="POST" action="/updatePassWord">
                {{-- エラー --}}
                @if($errors->has('password'))
                <p class="text-red-500 kiwi-maru">
                    {{$errors->first('password')}}
                </p>
                @endif
                @csrf
                <div class="flex justify-start items-center flex-wrap">
                    <input type="password" name="password" class="mr-2" autocomplete="off" placeholder="新しいパスワード">
                    <input type="submit" class="text-black" value="パスワードを変更する">
                </div>
            </form>
            <p class="kiwi-maru text-sm">※8文字以上100文字未満</p>
        </div>

    </div>
</div>
@endsection
