@extends("layouts.main")
@section("title","権限ランクセンター")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザーロールと説明の表'])
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
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($NlpPackageName)
                @foreach($NlpPackageName as $PackageObj)
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
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/create">
                        @csrf
                        <td>
                            {{$i}}
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
            </table>
        </div>
    </div>










    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザー権限と説明の表'])
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
                $i=1;
                @endphp

                {{-- 登録済みデータ表示 --}}
                @isset($NlpPackageGenre)
                @foreach($NlpPackageGenre as $PackageGenre)
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
                @php
                $i+=1;
                @endphp
                @endforeach
                @endisset

                {{-- 追加 --}}
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/genre/create">
                        @csrf
                        <td>
                            {{$i}}
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
            </table>
        </div>
    </div>









    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'ユーザーと権限の一覧'])

        <h2 class="text-center kiwi-maru mt-12 mb-2 text-2xl ">固有表現ルール</h2>
        <p class="text-center my-4 mx-2 kiwi-maru text-sm">ラベルについては関根の拡張固有表現階層 ver7.1.2をベースとしております。下記をご覧ください。</p>
        <p class="text-center my-4 mx-2 kiwi-maru text-sm hover:text-button-main-color">
            <a rel="norefferrer" target="_blank"
                href="https://github.com/Usuyuki/kadode_nikki3/wiki/21_%E5%9B%BA%E6%9C%89%E8%A1%A8%E7%8F%BE%E3%83%AB%E3%83%BC%E3%83%AB%E3%81%AE%E3%83%A9%E3%83%99%E3%83%AB%E5%90%8D">
                かどで日記wiki_固有表現ルールのラベル名
            </a>
        </p>
        <p class="text-center mt-8 mb-2 mx-2 kiwi-maru text-sm">Ajax通信非対応のため、1件ずつ追加や変更を行うようお願い申し上げます。</p>

        <div class="border-button-color border-2 mx-2 my-4 py-4 px-6 border-dotted">
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
                    $i=1;
                    @endphp

                    {{-- 登録済みデータ表示 --}}
                    @isset($PackageObj->packageNER)
                    @foreach($PackageObj->packageNER as $NER)
                    <tr>
                        <form class="" method="POST" action="/statistics/settings/named_entity/package/update">
                            @csrf
                            <input type="hidden" name="PackageNER_id" value="{{$NER->id}}">
                            <td>
                                {{$i}}
                            </td>
                            <td>
                                <select name="label_id">
                                    @foreach($NERLabel as $NERLabel_single)
                                    @if($NERLabel_single->id==$NER->label_id)
                                    <option selected value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}
                                    </option>
                                    @else
                                    <option value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                                    @endif
                                    @endforeach
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
                    @php
                    $i+=1;
                    @endphp
                    @endforeach
                    @endisset

                    {{-- 追加 --}}
                    <tr>
                        <form class="" method="POST" action="/statistics/settings/named_entity/package/create">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$PackageObj->id}}">
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
                </table>
            </div>
            @endif
            @endforeach
        </div>
        @endisset
    </div>


</div>


</div>

@endsection
