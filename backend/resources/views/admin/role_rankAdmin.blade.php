@extends("layouts.main")
@section("title","権限ランクセンター")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content ">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザーロール'])
        {{-- エラー --}}
        @if(count($errors)>0)
        {{-- エラーの表示 --}}
        @foreach($errors->all() as $error)
        <p class="text-red-500 kiwi-maru text-center">{{$error}}</p>
        @endforeach
        @endif

        {{-- 表示 --}}
        <div class="overflow-x-auto">
            <table class="nlp-normal-table mx-auto" border="1">
                <tr>
                    <th>番号</th>
                    <th>名前</th>
                    <th>説明</th>
                    <th>追加変更</th>
                    <th>削除</th>
                </tr>


                @php
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($user_roles)
                @foreach($user_roles as $user_role)
                <tr>
                    <form class="" method="POST" action="/administrator/settings/user/role/update">
                        @csrf
                        <input type="hidden" name="user_role_id" value="{{$user_role->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="name" autocomplete="off" value="{{$user_role->name}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off"
                                value="{{$user_role->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/user/role/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="user_role_id" value="{{$user_role->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
                        </td>
                    </form>
                </tr>
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/user/role/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="name" autocomplete="off" placeholder="タイトル"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>

    <div class="statistic-content ">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザーランク'])
        {{-- エラー --}}
        @if(count($errors)>0)
        {{-- エラーの表示 --}}
        @foreach($errors->all() as $error)
        <p class="text-red-500 kiwi-maru text-center">{{$error}}</p>
        @endforeach
        @endif

        {{-- 表示 --}}
        <div class="overflow-x-auto">
            <table class="nlp-normal-table mx-auto" border="1">
                <tr>
                    <th>番号</th>
                    <th>名前</th>
                    <th>説明</th>
                    <th>追加変更</th>
                    <th>削除</th>
                </tr>


                @php
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($user_ranks)
                @foreach($user_ranks as $user_rank)
                <tr>
                    <form class="" method="POST" action="/administrator/settings/user/rank/update">
                        @csrf
                        <input type="hidden" name="user_rank_id" value="{{$user_rank->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="name" autocomplete="off" value="{{$user_rank->name}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off"
                                value="{{$user_rank->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/user/rank/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="user_rank_id" value="{{$user_rank->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
                        </td>
                    </form>
                </tr>
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/user/rank/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="name" autocomplete="off" placeholder="タイトル"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
