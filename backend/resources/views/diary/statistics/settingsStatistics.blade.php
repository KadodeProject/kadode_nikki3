@extends("layouts.main")
@section("title","統計設定")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main mb-12 mt-12">
    {{-- <div class="my-12 flex justify-center ">
        <a href="/statistics/home" class="mt-12 ">
            <div class="w-60 h-30 rounded-2xl button-border-main-color border-2 flex items-center justify-center py-12">
                <p class="kiwi-maru ">統計ホームに戻る</p>
                <p class="material-icons">open_in_new</p>
            </div>
        </a>
    </div> --}}


    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'固有表現パッケージの追加'])
        <div class="flex justify-center items-center flex-wrap">
            @isset($NlpPackageName)
            @foreach ($NlpPackageName as $packageObj)
            @if($packageObj->is_publish == "公開")
            <div>
                @if (in_array($packageObj->id,$havingPackageList))
                {{-- 削除のボタン表示 --}}

                <form class=" text-right" method="POST" action="/statistics/settings/packages/release">
                    @csrf
                    <td>
                        <input type="hidden" name="package_id" value="{{$packageObj->id}}">
                        <input type="submit" class="text-black user-package-select-button bg-logo-main-color"
                            value="解除">
                    </td>
                </form>

                @else
                {{-- 登録のボタン表示 --}}
                <form class=" text-right" method="POST" action="/statistics/settings/packages/use">
                    @csrf
                    <td>
                        <input type="hidden" name="package_id" value="{{$packageObj->id}}">
                        <input type="submit" class="user-package-select-button bg-status-good " value="登録">
                    </td>
                </form>


                @endif
                {{-- ユーザー保持のif--}}
                <div class="nlp-normal-package kiwi-maru text-center">
                    @if (in_array($packageObj->id,$havingPackageList))
                    <p class="text-sm my-2 p-2 border-2 button-bg-main-color">使用中</p>
                    @else
                    <p class="text-sm my-2 p-2 border-2 bg-logo-main-color">未使用</p>
                    @endif
                    <p class="text-sm my-2">[{{$packageObj->genre}}]</p>
                    <p class="material-icons">inventory</p>
                    <p class="text-lg my-2">{{$packageObj->name}}</p>
                    <p class="text-sm my-2">{{$packageObj->description}}</p>
                </div>
            </div>
            @endif
            {{-- 公開かのif --}}
            @endforeach
            @endisset
        </div>
    </div>



    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザー固有表現ルール追加'])
        <p class="text-center my-4 mx-2 kiwi-maru text-sm">ラベルについては関根の拡張固有表現階層 ver7.1.2をベースとしております。下記をご覧ください。</p>

        <p class="text-center my-4 mx-2 kiwi-maru text-sm hover:text-button-main-color">
            <a rel="norefferrer" target="_blank"
                href="https://github.com/Usuyuki/kadode_nikki3/wiki/21_%E5%9B%BA%E6%9C%89%E8%A1%A8%E7%8F%BE%E3%83%AB%E3%83%BC%E3%83%AB%E3%81%AE%E3%83%A9%E3%83%99%E3%83%AB%E5%90%8D">
                かどで日記wiki_固有表現ルールのラベル名
            </a>
        </p>
        {{-- 表示 --}}
        <table class="nlp-normal-table mx-auto" border="1">
            <tr>
                <th>番号</th>
                <th>ラベル(日本語)</th>
                <th>単語</th>
                <th>追加変更</th>
                <th>削除</th>
            </tr>

            {{-- エラー --}}
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <tr class="text-red-500 kiwi-maru">
                @foreach($errors->all() as $error)
                <td>エラー</td>
                <td>エラー</td>
                <td>{{$error}}</td>
                <td>--</td>
                @endforeach
            </tr>
            @endif
            @php
            $i=1;
            @endphp

            {{-- 登録済みデータ表示 --}}
            @isset($CustomNER)
            @foreach($CustomNER as $NER)
            <tr>
                <form class="" method="POST" action="/statistics/settings/named_entity/custom/update">
                    @csrf
                    <input type="hidden" name="customNER_id" value="{{$NER->id}}">
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <select name="label_id">
                            @foreach($NERLabel as $NERLabel_single)
                            @if($NERLabel_single->id==$NER->label_id)
                            <option selected value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                            @else
                            <option value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$NER->name}}"
                            onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit" id="submitCustomNER_{{$i}}" class="text-black" value="変更">
                    </td>
                </form>
                <form class="" method="POST" action="/statistics/settings/named_entity/custom/delete">
                    @csrf
                    <td>
                        <input type="hidden" name="customNER_id" value="{{$NER->id}}">
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
                <form class="" method="POST" action="/statistics/settings/named_entity/custom/create">
                    @csrf
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <select name="label_id">
                            <option disabled value>ラベルを選ぶ</option>
                            @foreach($NERLabel as $NERLabel_single)
                            <option value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" placeholder="単語名"
                            onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit" id="submitCustomNER_{{$i}}" class="text-black" value="追加">
                    </td>
                    <td>
                        --
                    </td>
                </form>
            </tr>
        </table>
    </div>


    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パイプライン'])
        @component('components.statistics.statisticOverallView')
        @endcomponent
    </div>
    <!--
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'登録した固有表現のインポート'])
        <div class="mt-12 mb-4">
            <p class="text-sm text-center mb-4 kiwi-maru">かどで日記からエクスポートしていないものは動作保証外です</p>
            <form class="text-center flex justify-center flex-wrap flex-col " method="POST"
                enctype="multipart/form-data" action="/import/diary/kadode">
                @if(count($errors)>0)
                {{-- エラーの表示 --}}
                <ul class="text-red-500 kiwi-maru">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                @csrf
                <label class="flex md:justify-center flex-wrap text-main-color" for="kadode-csv">
                    <div class="md:w-full mt-4 mb-2">
                        <span class="file-input-wrapper ">ファイルを選択</span>
                    </div>
                    <input id="kadode-csv" type="file" accept=".csv" class="mx-auto" value="かどで日記csv形式でインポート"
                        name="kadodeCsv">
                </label>
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto" value="インポート">
            </form>
        </div>
    </div>

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'登録した固有表現のエクスポート'])
        <div class="mt-12 mb-4">
            <p class="text-sm text-center kiwi-maru">※エクスポート時に文字コードをutf-8からWindows-31J(拡張Shift-JIS)に変換してCSVを作成します
            </p>
            <form class="flex justify-center flex-wrap flex-col " method="POST" action="/export/statistics/namedEntity">
                @csrf
                <input type="submit" class="text-black px-2 md:w-1/2 w-full mx-auto" value="csv形式でエクスポート">
            </form>
            {{-- <div class="settingContent"><a href="/export/diary">CSVエクスポート</a></div> --}}

        </div>
    </div>
-->


</div>

@endsection
