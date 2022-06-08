@extends("layouts.main")
@section("title","通知センター")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content ">
        @include('components.statisticHeading',['icon'=>'category','title'=>'アップデート情報更新通知'])
        @php
        $original_title="";
        $original_date="";
        $original_genre="";
        $original_description="";
        @endphp
        {{-- エラー --}}
        @if(count($errors)>0)
        {{-- 以前入力した内容を打ち込む --}}
        @php
        $original_title=old("title");
        $original_date=old("date");
        $original_genre=old("releasenote_genre_id");
        $original_description=old("description");
        @endphp
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

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/releasenote/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid value="{{$original_title}}" type="text" name="title" autocomplete="off"
                                placeholder="タイトル"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="releasenote_genre_id" value="{{$original_genre}}">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($releasenoteGenres as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <textarea name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">{{$original_description}}</textarea>
                        </td>
                        <td>
                            <input requreid type="date" value="{{$original_date}}"
                                class="text-xl mx-auto mb-4  kiwi-maru" name="date">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>
                {{-- 登録済みデータ表示 --}}
                @isset($releasenotes)
                @foreach($releasenotes as $releasenote)
                <tr>
                    <form class="" method="POST" action="/administrator/settings/releasenote/update">
                        @csrf
                        <input type="hidden" name="releasenote_id" value="{{$releasenote->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" value="{{$releasenote->title}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="releasenote_genre_id">
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
                            <textarea name="description" autocomplete="off"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">{{$releasenote->description}}</textarea>
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date"
                                value="{{$releasenote->date->format('Y-m-d')}}">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/releasenote/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="releasenote_id" value="{{$releasenote->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
                        </td>
                    </form>
                </tr>
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset


            </table>
        </div>
    </div>



    <div class="statistic-content ">
        @include('components.statisticHeading',['icon'=>'category','title'=>'お知らせ'])
        @php
        $original_title="";
        $original_date="";
        $original_genre="";
        $original_description="";
        @endphp
        {{-- エラー --}}
        @if(count($errors)>0)
        {{-- 以前入力した内容を打ち込む --}}
        @php
        $original_title=old("title");
        $original_date=old("date");
        $original_genre=old("osirase_genre_id");
        $original_description=old("description");
        @endphp
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

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/osirase/create">
                        @csrf
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input requreid type="text" name="title" autocomplete="off" placeholder="タイトル"
                                value="{{$original_title}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="osirase_genre_id" value="{{$original_genre}}">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($osiraseGenres as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <textarea name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">{{$original_description}}</textarea>
                        </td>
                        <td>
                            <input requreid type="date" value="{{$original_date}}"
                                class="text-xl mx-auto mb-4  kiwi-maru" name="date" value="{{$original_date}}">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>

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
                            <textarea name="description" autocomplete="off"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitosirase_{{$i}}').click();return false};">{{$osirase->description}}</textarea>
                        </td>
                        <td>
                            <input requreid type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date"
                                value="{{$osirase->date->format('Y-m-d')}}">
                        </td>
                        <td>
                            <input type="submit" id="submitosirase_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/osirase/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="osirase_id" value="{{$osirase->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
                        </td>
                    </form>
                </tr>
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset


            </table>
        </div>
    </div>


</div>

@endsection
