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
                    <th>編集</th>
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
                                @foreach($nlpPackageGenre as $packageGenre)
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
                            --
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>



                {{-- 登録済みデータ表示 --}}
                @isset($nlpPackageName)
                @foreach($nlpPackageName as $packageObj)
                @php
                $i+=1;
                @endphp
                <tr>
                    <form class="" method="POST" action="/administrator/settings/packages/update">
                        @csrf
                        <input type="hidden" name="NlpPackageName_id" value="{{$packageObj->id}}">
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            <input type="text" name="name" autocomplete="off" value="{{$packageObj->name}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="NlpPackageGenre_id">
                                <option disabled value>ジャンルを選ぶ</option>
                                @foreach($nlpPackageGenre as $packageGenre)
                                @if($packageGenre->id==$packageObj->genre_id)
                                <option selected value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @else
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                @endif
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <input type="text" name="description" autocomplete="off"
                                value="{{$packageObj->description}}"
                                onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                        </td>
                        <td>
                            <select name="is_publish">
                                @if($packageObj->is_publish=="公開")
                                <option selected value="公開">公開</option>
                                <option value="非公開">非公開</option>
                                @elseif($packageObj->is_publish=="非公開")
                                <option value="公開">公開</option>
                                <option selected value="非公開">非公開</option>
                                @endif
                            </select>
                        </td>
                        <td>
                            <a class="bg-kn_2 p-2 rounded-2xl"
                                href="{{route('ShowAdminIndividualPackage',['packageId'=>$packageObj->id])}}">編集</a>
                        </td>
                        <td>
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/packages/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="NlpPackageName_id" value="{{$packageObj->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
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
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black bg-kn_2" value="追加">
                        </td>
                        <td>
                            --
                        </td>
                    </form>
                </tr>
                {{-- 登録済みデータ表示 --}}
                @isset($nlpPackageGenre)
                @foreach($nlpPackageGenre as $PackageGenre)
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
                            <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black bg-kn_2" value="変更">
                        </td>
                    </form>
                    <form class="" method="POST" action="/administrator/settings/packages/genre/delete">
                        @csrf
                        <td>
                            <input type="hidden" name="NlpPackageGenre_id" value="{{$PackageGenre->id}}">
                            <input type="submit" class="text-black bg-kn_poor" value="削除">
                        </td>
                    </form>
                </tr>

                @endforeach
                @endisset


            </table>
        </div>
    </div>
</div>

@endsection
