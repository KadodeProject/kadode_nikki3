
@extends("layouts.main")
@section("title","管理者ページ")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
  
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージ管理'])
        {{-- 表示 --}}
        <table class="nlp-normal-table mx-auto"border="1" >
            <tr>
                <th>番号</th><th>パッケージ名</th><th>ジャンル</th><th>説明</th><th>追加変更</th><th>削除</th>
            </tr>

            {{-- エラー --}}
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <tr class="text-red-500 kiwi-maru">
                @foreach($errors->all() as $error)
                <td>エラー</td><td>エラー</td><td>{{$error}}</td><td>--</td><td>--</td>
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
                <form class="" method="POST"  action="/administrator/settings/packages/update">
                    @csrf
                    <input type="hidden" name="NlpPackageName_id" value="{{$PackageObj->id}}">
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$PackageObj->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                            <select name="NlpPackageGenre_id">
                                <option disabled  value>ジャンルを選ぶ</option>
                                @foreach($NlpPackageGenre as $packageGenre)
                                    @if($packageGenre->id==$PackageObj->label_id)
                                    <option selected value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                                    @else
                                    <option value="{{$packageGenre->label}}">{{$packageGenre->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                    
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$PackageObj->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="変更">
                    </td>
                </form>
                <form class="" method="POST"  action="/administrator/settings/packages/delete">
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
                <form class="" method="POST"  action="/administrator/settings/packages/create">
                    @csrf
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" placeholder="パッケージ名"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <select name="NlpPackageGenre_id">
                            <option disabled  value>ジャンルを選ぶ</option>
                            @foreach($NlpPackageGenre as $packageGenre)
                                <option value="{{$packageGenre->id}}">{{$packageGenre->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="description" autocomplete="off" placeholder="説明"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit"  id="submitNlpPackageName_{{$i}}" class="text-black" value="追加">
                    </td>
                    <td>
                        --
                    </td>
                </form>
            </tr>
        </table>

    </div>










    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージジャンル管理'])
        {{-- 表示 --}}
        <table class="nlp-normal-table mx-auto"border="1" >
            <tr>
                <th>番号</th><th>ジャンル名</th><th>説明</th><th>追加変更</th><th>削除</th>
            </tr>

            {{-- エラー --}}
            @if(count($errors)>0)
            {{-- エラーの表示 --}}
            <tr class="text-red-500 kiwi-maru">
                @foreach($errors->all() as $error)
                <td>エラー</td><td>エラー</td><td>{{$error}}</td><td>--</td><td>--</td>
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
                <form class="" method="POST"  action="/administrator/settings/packages/genre/update">
                    @csrf
                    <input type="hidden" name="NlpPackageGenre_id" value="{{$PackageGenre->id}}">
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$PackageGenre->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>

                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$PackageGenre->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit" id="submitNlpPackageName_{{$i}}" class="text-black" value="変更">
                    </td>
                </form>
                <form class="" method="POST"  action="/administrator/settings/packages/genre/delete">
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
                <form class="" method="POST"  action="/administrator/settings/packages/genre/create">
                    @csrf
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" placeholder="パッケージ名"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>

                    <td>
                        <input type="text" name="description" autocomplete="off" placeholder="説明"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitNlpPackageName_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit"  id="submitNlpPackageName_{{$i}}" class="text-black" value="追加">
                    </td>
                    <td>
                        --
                    </td>
                </form>
            </tr>
        </table>
    </div>
    








    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'固有表現ルールパッケージ中身'])
    </div>
    
        
</div>
      
@endsection
 