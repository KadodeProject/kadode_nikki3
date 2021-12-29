@extends("layouts.main")
@section("title","管理者ページ")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content ">
        @include('components.statisticHeading',['icon'=>'category','title'=>'アップデート情報更新通知'])
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
                    <th>タイトル</th>
                    <th>ジャンル</th>
                    <th>説明</th>
                    <th>日付</th>
                    <th>追加変更</th>
                    <th>削除</th>
                </tr>


                @php
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($releasenotes)
                @foreach($releasenotes as $releasenote)
                <tr>
                    <form class="" method="POST" action="/administrator/settings/releasenote/update">
                        @csrf
                        <input type="hidden" name="osirase_id" value="{{$releasenote->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" value="{{$releasenote->title}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="osirase_genre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($releasenoteGenres as $releasenoteGenre)
                                @if($releasenoteGenre->id==$releasenote->genre_id)
                                <option selected value="{{$releasenoteGenre->id}}">{{$releasenoteGenre->name}}</option>
                                @else
                                <option value="{{$releasenoteGenre->id}}">{{$releasenoteGenre->name}}</option>
                                @endif
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off"
                                value="{{$releasenote->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date"
                                value="{{$releasenote->date->format('Y-m-d')}}">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/releasenote/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="osirase_id" value="{{$releasenote->id}}">
                            <input type="submit" class="text-black" value="削除">
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
                    <form class="" method="POST" action="/administrator/settings/releasenote/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" placeholder="タイトル"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="osirase_genre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($releasenoteGenres as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black" value="追加">
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
        @include('components.statisticHeading',['icon'=>'category','title'=>'お知らせ'])
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
                    <th>タイトル</th>
                    <th>ジャンル</th>
                    <th>説明</th>
                    <th>日付</th>
                    <th>追加変更</th>
                    <th>削除</th>
                </tr>


                @php
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($osirases)
                @foreach($osirases as $osirase)
                <tr>
                    <form class="" method="POST" action="/administrator/settings/osirase/update">
                        @csrf
                        <input type="hidden" name="osirase_id" value="{{$osirase->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" value="{{$osirase->title}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="osirase_genre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($osiraseGenres as $releasenoteGenre)
                                @if($releasenoteGenre->id==$osirase->genre_id)
                                <option selected value="{{$releasenoteGenre->id}}">{{$releasenoteGenre->name}}</option>
                                @else
                                <option value="{{$releasenoteGenre->id}}">{{$releasenoteGenre->name}}</option>
                                @endif
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off"
                                value="{{$osirase->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date"
                                value="{{$osirase->date->format('Y-m-d')}}">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/osirase/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="osirase_id" value="{{$osirase->id}}">
                            <input type="submit" class="text-black" value="削除">
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
                    <form class="" method="POST" action="/administrator/settings/osirase/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" placeholder="タイトル"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="osirase_genre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($osiraseGenres as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input requreid type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black" value="追加">
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
