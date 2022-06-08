@extends("layouts.main")
@section("title","パッケージセンター")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">

    <div class="statistic-content">

        <h1 class="text-center text-3xl mx-2 my-2 kiwi-maru">{{ $packageObj->name}}</h1>
        {{-- エラー --}}
        @if(count($errors)>0)
        {{-- エラーの表示 --}}
        @foreach($errors->all() as $error)
        <p class="text-red-500 kiwi-maru text-center">{{$error}}</p>
        @endforeach
        @endif


        <div class="statistic-content">

            <h2 class="text-center kiwi-maru mt-12 mb-2 text-2xl ">固有表現ルール</h2>
            <p class="text-center my-4 mx-2 kiwi-maru text-sm">ラベルについては関根の拡張固有表現階層 ver7.1.2をベースとしております。下記をご覧ください。</p>
            <p class="text-center my-4 mx-2 kiwi-maru text-sm hover:text-kn_2">
                <a rel="norefferrer" target="_blank"
                    href="https://github.com/Usuyuki/kadode_nikki3/wiki/12_%E5%9B%BA%E6%9C%89%E8%A1%A8%E7%8F%BE%E3%83%AB%E3%83%BC%E3%83%AB%E3%81%AE%E3%83%A9%E3%83%99%E3%83%AB%E5%90%8D">
                    かどで日記wiki_固有表現ルールのラベル名
                </a>
            </p>
            <p class="text-center mt-8 mb-2 mx-2 kiwi-maru text-sm">Ajax通信非対応のため、1件ずつ追加や変更を行うようお願い申し上げます。</p>

            <div class="border-button-color border-2 mx-2 my-4 py-4 px-6 border-dotted" id="nerTable">
                @if($packageObj->genre_id==1)
                <h3 class="text-center kiwi-maru mt-6 mb-2 text-xl">{{$packageObj->name}}<span
                        class="text-sm">[id:{{$packageObj->id}}]</span></h3>

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
                                    <input type="hidden" name="packageId" value="{{$packageObj->id}}">
                                    <input type="submit" id="submitPackageNER_{{$i}}" class="text-black bg-kn_2"
                                        value="追加">
                                </td>
                                <td>
                                    --
                                </td>
                            </form>
                        </tr>
                        {{-- 登録済みデータ表示 --}}
                        @isset($packageObj->packageNER)
                        @foreach($packageObj->packageNER as $NER)
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
                                    <input type="hidden" name="packageId" value="{{$packageObj->id}}">
                                    <input type="submit" id="submitPackageNER_{{$i}}" class="text-black bg-kn_2"
                                        value="変更">
                                </td>
                            </form>
                            <form class="" method="POST" action="/statistics/settings/named_entity/package/delete">
                                @csrf
                                <td>
                                    <input type="hidden" name="PackageNER_id" value="{{$NER->id}}">
                                    <input type="hidden" name="packageId" value="{{$packageObj->id}}">
                                    <input type="submit" class="text-black bg-kn_poor" value="削除">
                                </td>
                            </form>
                        </tr>

                        @endforeach
                        @endisset


                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
