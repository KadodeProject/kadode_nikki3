<div>


<form class="flex justify-center flex-wrap flex-col " method="POST"action="/{{$db_method}}">
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
    <ul class="text-red-500 kiwi-maru">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    @csrf
  
    <input type="date"class="text-xl mx-auto mb-4  kiwi-maru" name="date" value="{{$original_date}}">

    <input  type="hidden" value="{{$original_uuid}}" name="uuid">
    <input  placeholder="タイトル(50字以内)"style="height:32px" class="mx-auto w-2/3 kiwi-maru " type="text" name="title" autocomplete="off" value="{{$original_title}}">

 
    <textarea  placeholder="本文(20000字以内)"class="sm:p-4 w-full diary-content-edit  kiwi-maru" type="text" name="content"  autocomplete="off"  id="diary-content">{{$original_content}}</textarea>
    
    <input style="height:2em"type="submit" class="kiwi-maru" value="日記を書き込む">
</form>

</div>