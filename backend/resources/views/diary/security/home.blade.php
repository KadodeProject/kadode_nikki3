@extends("layouts.main")
@section("title","設定")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    @include('components.settingHeading',['title'=>'アカウント情報',])
    <div class="md:ml-12 ml-4 my-4">
        <p class="text-xl mt-4 mb-2"><span class="material-icons">bubble_chart</span>基本情報</p>
        <div class="ml-4">
            <p class="text-xl my-2">ユーザー名 : {{$user->name}}</p>
            <p class="text-xl my-2">ご登録のメールアドレス : {{$user->email}}</p>
            <p class="text-xl my-2">アカウント作成日時 : {{$user->email_verified_at}}</p>
            <p class="text-xl my-2">メール認証日時 : {{$user->created_at}}</p>
        </div>
        <p class="text-xl mt-4 mb-2"><span class="material-icons">bubble_chart</span>メタ情報</p>
        <div class="ml-4">
            <p class="text-xl my-2">ユーザーID : {{$user->id}}</p>
            <p class="text-xl my-2">ユーザーランクID : {{$user->user_rank_id}}</p>
            <p class="text-xl my-2">ユーザーロールID : {{$user->user_role_id}}</p>
        </div>
        <p class="text-xl mt-4 mb-2"><span class="material-icons">bubble_chart</span>フラグ</p>
        <div class="ml-4">
            <p class="text-xl my-2">is_showed_update_user_rank : {{$user->is_showed_update_user_rank}}</p>
            <p class="text-xl my-2">is_showed_update_system_info : {{$user->is_showed_update_system_info}}</p>
            <p class="text-xl my-2">is_showed_service_info : {{$user->is_showed_service_info}}</p>
        </div>
    </div>
    @include('components.settingHeading',['title'=>'アカウント情報変更',])
    <div class="md:ml-12 ml-4 my-4 pb-20">

        <div class="flex justify-start items-center my-4 flex-wrap">
            <p class="text-xl mr-4">ユーザー名変更</p>
            <form class="flex justify-center flex-wrap flex-col " method="POST" action="/updateUserName">
                {{-- エラー --}}
                @if($errors->has('name'))
                <p class="text-red-500 kiwi-maru">
                    {{$errors->first('name')}}
                </p>
                @endif
                @csrf
                <div class="flex justify-start items-center flex-wrap">
                    <input type="text" name="name" class="mr-2" autocomplete="off" placeholder="新しいユーザー名"
                        value="{{$user->name}}">
                    <input type="submit" class="text-black" style="border-radius:4px" value="ユーザー名を変更する">
                </div>
            </form>
        </div>
        <div class="flex justify-start items-center my-4  flex-wrap ">
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
                    <input type="email" name="email" class="mr-2" autocomplete="off" placeholder="新しいメールアドレス"
                        value="{{$user->email}}">
                    <input type="submit" class="text-black" style="border-radius:4px" value="メールアドレスを変更する">
                </div>
            </form>
        </div>
        <div class="flex justify-start items-center my-4 flex-wrap">
            <p class="text-xl mr-4">パスワード変更</p>
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
                    <input type="submit" class="text-black" style="border-radius:4px" value="パスワードを変更する">
                </div>
            </form>
            <p class="kiwi-maru text-sm">※8文字以上100文字未満</p>
        </div>

    </div>
    @include('components.settingHeading',['title'=>'ログイン情報',])
    @isset($user_ips)
    <div class="flex flex-wrap mb-4 items-center">
        @php
        $i=1;
        @endphp
        @foreach ($user_ips as $user_ip)
        <div>
            <div
                class="relative top-10 left-2    text-xl bg-main-color w-10 h-10 rounded-full border-2 flex justify-center items-center kiwi-maru">
                <p> {{$i++}}</p>
            </div>
            <div class="flex border-2 border-dotted p-4 m-4 rounded-2xl">
                <div class="flex items-center flex-col md:w-1/4">
                    <p class="kiwi-maru text-xl">時刻</p>
                    <p class="material-icons mb-2">
                        schedule
                    </p>
                    <p>{{$user_ip->created_at}}</p>
                </div>
                <div class="flex items-center flex-col md:w-1/4">
                    <p class="kiwi-maru text-xl">IP</p>
                    <p class="material-icons mb-2">
                        language
                    </p>
                    <p>{{$user_ip->ip}}</p>
                </div>
                <div class="flex items-center flex-col md:w-1/4">
                    <p class="kiwi-maru text-xl">推定地域</p>
                    <p class="material-icons mb-2">
                        place
                    </p>
                    <p>{{$user_ip->geo}}</p>
                </div>
                <div class="flex items-center flex-col md:w-1/4">
                    <p class="kiwi-maru text-xl">UA</p>
                    <p class="material-icons mb-2">
                        devices
                    </p>
                    <p>{{$user_ip->ua}}</p>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    @else
    <p class="kiwi-maru text-center">ログイン情報なし</p>
    @endisset
</div>
@endsection
