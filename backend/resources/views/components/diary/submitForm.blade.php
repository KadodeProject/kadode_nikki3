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
        $original_feel=old("feel")-1;
    @endphp
    {{-- エラーの表示 --}}
    <ul class="text-red-500">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    @csrf
  
    <input type="date"class="text-xl text-center" name="date" value="{{$original_date}}">

    <input  type="hidden" value="{{$original_uuid}}" name="uuid">
    <input  placeholder="タイトル(50字以内)"style="height:32px" class="mx-auto w-2/3" type="text" name="title"  value="{{$original_title}}">
    <div class="flex justify-center items-center"  >
        <p class="text-xl mr-4">きもち:</p>
    <select id="feel_selector"style="width:8em;"class="text-sm my-2" name="feel"size="1" >
        <option value="1" >1(悪い)</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5(普通)</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10" >10(良い)</option>
    </select>
    <script>
        document.getElementById('feel_selector').options[{{$original_feel}}].selected = true;
        </script>
    </div>
    <textarea  placeholder="本文(20000字以内)"class="p-4 w-full diary-content-edit" type="text" name="content" >{{$original_content}}</textarea>
    
    <input type="submit" value="日記を書き込む">
</form>

</div>