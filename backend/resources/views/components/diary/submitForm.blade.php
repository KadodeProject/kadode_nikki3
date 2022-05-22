<div>


    <form class="flex justify-center flex-wrap flex-col " method="POST" action="/{{$db_method}}">
        @if(count($errors)>0)
        {{-- バリデーションエラーのとき --}}
        {{-- エラー前に書いていたフォームの保持 --}}
        @php
        $original_date=old("date");
        $original_uuid=old("uuid");
        $original_title=old("title");
        $original_content=old("content");
        @endphp
        {{-- エラーの表示 --}}
        <ul class="text-red-500 kiwi-maru text-center">
            @if($errors->has('date'))
            <li class="text-red-500 kiwi-maru">
                {{$errors->first('date')}}
            </li>
            @endif
            @if($errors->has('title'))
            <li class="text-red-500 kiwi-maru">
                {{$errors->first('title')}}
            </li>
            @endif
            @if($errors->has('content'))
            <li class="text-red-500 kiwi-maru">
                {{$errors->first('content')}}
            </li>
            @endif
        </ul>
        @endif
        @csrf

        <input type="date" class="text-xl mx-auto mb-4  kiwi-maru" name="date" value="{{$original_date}}">

        <input type="hidden" value="{{$original_uuid}}" name="uuid">
        <input placeholder="タイトル(50字以内)" style="height:32px" class="mx-auto w-2/3 " type="text" name="title"
            autocomplete="off" value="{{$original_title}}">


        <textarea placeholder="本文(20000字以内)" class="sm:p-4 w-full diary-content-edit  " type="text" name="content"
            autocomplete="off" id="diary-content" oninput="diaryContentChange()"
            onkeydown="if((event.ctrlKey || event.metaKey)&&event.keyCode==13){document.getElementById('submitDiary').click();return false};">{{$original_content}}</textarea>
        <button type="submit" style="height:2em" class="kiwi-maru submitDiaryButton" id="submitDiary">
            日記を書き込む
        </button>
    </form>

</div>