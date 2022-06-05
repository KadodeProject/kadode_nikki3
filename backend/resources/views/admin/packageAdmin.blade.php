@extends("layouts.main")
@section("title","パッケージセンター")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージ管理'])

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
                    <th>パッケージ名</th>
                    <th>ジャンル</th>
                    <th>説明</th>
                    <th>公開設定</th>
                    <th>追加変更</th>
                    <th>削除</th>
                </tr>
                @php
                $i=0;
                @endphp
                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/create">
                        @csrf
                        <td>
                            -
                        </td>
                        <td>
                            <input type="text" name="name" autocomplete="off" placeholder="パッケージ名"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="NlpPackageGenre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($NlpPackageGenre as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="is_publish">
                                <option value="公開">公開</option>
                                <option value="非公開">非公開</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>



                {{-- 登録済みデータ表示 --}}
                @isset($NlpPackageName)
                @foreach($NlpPackageName as $PackageObj)
                @php
                $i+=1;
                @endphp
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/update">
                        @csrf
                        <input type="hidden" name="NlpPackageName_id" value="{{$PackageObj->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input type="text" name="name" autocomplete="off" value="{{$PackageObj->name}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="NlpPackageGenre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($NlpPackageGenre as $packageGenre)
                                @if($packageGenre->id==$PackageObj->genre_id)
                                <option selected value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @else
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endif
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <input type="text" name="description" autocomplete="off"
                                value="{{$PackageObj->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="is_publish">
                                @if($PackageObj->is_publish=="公開")
                                <option selected value="公開">公開</option>
                                <option value="非公開">非公開</option>
                                @elseif($PackageObj->is_publish=="非公開")
                                <option value="公開">公開</option>
                                <option selected value="非公開">非公開</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/packages/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="NlpPackageName_id" value="{{$PackageObj->id}}">
                            <input type="submit" class="text-black" value="削除">
                        </td>
                    </form>
                </tr>
                @endforeach
                @endisset


            </table>
        </div>
    </div>










    <div class="statistic-content" id="packageGenreTable">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージジャンル管理'])
        {{-- 表示 --}}
        <div class="overflow-x-auto">
            <table class="nlp-normal-table mx-auto" border="1">
                <tr>
                    <th>番号</th>
                    <th>ジャンル名</th>
                    <th>説明</th>
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
                    <td>--</td>
                    @endforeach
                </tr>
                @endif
                @php
                $i=0;
                @endphp
                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/genre/create">
                        @csrf
                        <td>
                            -
                        </td>
                        <td>
                            <input type="text" name="name" autocomplete="off" placeholder="パッケージ名"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>

                        <td>
                            <input type="text" name="description" autocomplete="off" placeholder="説明"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>
                {{-- 登録済みデータ表示 --}}
                @isset($NlpPackageGenre)
                @foreach($NlpPackageGenre as $PackageGenre)
                @php
                $i+=1;
                @endphp
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/genre/update">
                        @csrf
                        <input type="hidden" name="NlpPackageGenre_id" value="{{$PackageGenre->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input type="text" name="name" autocomplete="off" value="{{$PackageGenre->name}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>

                        <td>
                            <input type="text" name="description" autocomplete="off"
                                value="{{$PackageGenre->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/packages/genre/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="NlpPackageGenre_id" value="{{$PackageGenre->id}}">
                            <input type="submit" class="text-black" value="削除">
                        </td>
                    </form>
                </tr>

                @endforeach
                @endisset


            </table>
        </div>
    </div>









    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージ中身'])

        <h2 class="text-center kiwi-maru mt-12 mb-2 text-2xl ">固有表現ルール</h2>
        <p class="text-center my-4 mx-2 kiwi-maru text-sm">ラベルについては関根の拡張固有表現階層 ver7.1.2をベースとしております。下記をご覧ください。</p>
        <p class="text-center my-4 mx-2 kiwi-maru text-sm hover:text-button-main-color">
            <a rel="norefferrer" target="_blank"
                href="https://github.com/Usuyuki/kadode_nikki3/wiki/12_%E5%9B%BA%E6%9C%89%E8%A1%A8%E7%8F%BE%E3%83%AB%E3%83%BC%E3%83%AB%E3%81%AE%E3%83%A9%E3%83%99%E3%83%AB%E5%90%8D">
                かどで日記wiki_固有表現ルールのラベル名
            </a>
        </p>
        <p class="text-center mt-8 mb-2 mx-2 kiwi-maru text-sm">Ajax通信非対応のため、1件ずつ追加や変更を行うようお願い申し上げます。</p>

        <div class="border-button-color border-2 mx-2 my-4 py-4 px-6 border-dotted" id="nerTable">
            @isset($NlpPackageName)
            @foreach($NlpPackageName as $PackageObj)
            @if($PackageObj->genre_id==1)
            <h3 class="text-center kiwi-maru mt-6 mb-2 text-xl">{{$PackageObj->name}}<span
                    class="text-sm">[id:{{$PackageObj->id}}]</span></h3>

            {{-- 表示 --}}
            <div class="overflow-x-auto">
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
                    $i=0;
                    @endphp
                    {{-- 追加 --}}
                    <tr>
                        <form class="" method="POST" action="/statistics/settings/named_entity/package/create">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$PackageObj->id}}">
                            <td>
                                -
                            </td>
                            <td>
                                <select name="label_id">
                                    <option disabled value>ラベルを選ぶ</option>
                                    {!! $NERLabelsInOptionTabFormat !!}
                                </select>
                            </td>
                            <td>
                                <input type="text" name="name" autocomplete="off" placeholder="単語名"
                                    onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitPackageNER_{{$i}}').click();return false};">
                            </td>
                            <td>
                                <input type="submit" id="submitPackageNER_{{$i}}" class="text-black" value="追加">
                            </td>
                            <td>
                                --
                            </td>
                        </form>
                    </tr>
                    {{-- 登録済みデータ表示 --}}
                    @isset($PackageObj->packageNER)
                    @foreach($PackageObj->packageNER as $NER)
                    @php
                    $i+=1;
                    @endphp
                    <tr>
                        <form class="" method="POST" action="/statistics/settings/named_entity/package/update">
                            @csrf
                            <input type="hidden" name="PackageNER_id" value="{{$NER->id}}">
                            <td>
                                {{$i}}
                            </td>
                            <td>
                                <select name="label_id">
                                    @php
                                    /**
                                    * 正規表現で該当するところにselectedをつける
                                    * mb_ereg_replaceはセパレータ不要
                                    */
                                    $willSelect='<option value="'.$NER->label_id.'">';
                                        $selected='
                                    <option selected value="'.$NER->label_id.'">';

                                        $NERLabelsInOptionTabFormatWithSelected=mb_ereg_replace($willSelect,$selected,$NERLabelsInOptionTabFormat);
                                        @endphp
                                        {!! $NERLabelsInOptionTabFormatWithSelected !!}
                                </select>
                            </td>
                            <td>
                                <input type="text" name="name" autocomplete="off" value="{{$NER->name}}"
                                    onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitPackageNER_{{$i}}').click();return false};">
                            </td>
                            <td>
                                <input type="submit" id="submitPackageNER_{{$i}}" class="text-black" value="変更">
                            </td>
                        </form>
                        <form class="" method="POST" action="/statistics/settings/named_entity/package/delete">
                            @csrf
                            <td>
                                <input type="hidden" name="PackageNER_id" value="{{$NER->id}}">
                                <input type="submit" class="text-black" value="削除">
                            </td>
                        </form>
                    </tr>

                    @endforeach
                    @endisset


                </table>
            </div>
            @endif
            @endforeach
        </div>
        @endisset
    </div>

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


</div>


</div>

@endsection
