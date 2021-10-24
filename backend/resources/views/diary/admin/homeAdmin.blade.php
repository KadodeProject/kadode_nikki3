
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
        @isset($CustomNER)
            @foreach($CustomNER as $NER)
            <tr>
                <form class="" method="POST"  action="/statistics/settings/named_entity/custom/update">
                    @csrf
                    <input type="hidden" name="customNER_id" value="{{$NER->id}}">
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$NER->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <select name="label_id">
                            @foreach($NERLabel as $NERLabel_single)
                                @if($NERLabel_single->id==$NER->label_id)
                                    <option selected value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                                @else
                                    <option value="{{$NERLabel_single->label}}">{{$NERLabel_single->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" value="{{$NER->name}}" onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit" id="submitCustomNER_{{$i}}" class="text-black" value="変更">
                    </td>
                </form>
                <form class="" method="POST"  action="/statistics/settings/named_entity/custom/delete">
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
                <form class="" method="POST"  action="/statistics/settings/named_entity/custom/create">
                    @csrf
                    <td>
                        {{$i}}
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" placeholder="単語名"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <select name="label_id">
                            <option disabled  value>ラベルを選ぶ</option>
                            @foreach($NERLabel as $NERLabel_single)
                                <option value="{{$NERLabel_single->id}}">{{$NERLabel_single->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" autocomplete="off" placeholder="単語名"  onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitCustomNER_{{$i}}').click();return false};">
                    </td>
                    <td>
                        <input type="submit"  id="submitCustomNER_{{$i}}" class="text-black" value="追加">
                    </td>
                    <td>
                        --
                    </td>
                </form>
            </tr>
        </table>

    </div>
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'パッケージ管理'])
    </div>
    
    <div class="statistic-content">
        @include('components.statisticHeading',['icon'=>'category','title'=>'固有表現ルールパッケージ中身'])
    </div>
    
        
</div>
      
@endsection
 