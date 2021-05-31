<div>


<form class="flex justify-center flex-wrap flex-col " method="POST"action="/{{$db_method}}">
    @csrf
    @empty($original_date)
    <p id="diaryDate" class="text-xl text-center">
        {{$original_date}}
    </p>
    @else
    <input type="date"class="text-xl text-center" name="date" value="{{$original_date}}">
    @endempty
    <input  type="hidden" value="{{$original_uuid}}" name="uuid">
    <input  placeholder="タイトル"style="height:32px" class="mx-auto w-2/3" type="text" name="title"  value="{{$original_title}}">
    <div class="flex justify-center items-center"  >
        <p class="text-xl mr-4">きもち:</p>
    <select style="width:8em;"class="text-sm my-2" name="feel"size="1" >
        <option value="1"  "{{$original_feel==1 ? 'selected':''}}">1(悪い)</option>
        <option value="2" "{{$original_feel==2 ? 'selected':''}}">2</option>
        <option value="3" "{{$original_feel==3 ? 'selected':''}}">3</option>
        <option value="4" "{{$original_feel==4 ? 'selected':''}}">4</option>
        <option value="5" "{{$original_feel==5 ? 'selected':''}}"></option>
        <option value="6" "{{$original_feel==6 ? 'selected':''}}">6</option>
        <option value="7" "{{$original_feel==7 ? 'selected':''}}">7</option>
        <option value="8" "{{$original_feel==8 ? 'selected':''}}">8</option>
        <option value="9" "{{$original_feel==9 ? 'selected':''}}">9</option>
        <option value="10" "{{$original_feel==10 ? 'selected':''}}">10(良い)</option>
    </select>
    </div>
    <textarea  placeholder="本文"class="p-4 w-full diary-content-edit" type="text" name="content" >{{$original_content}}</textarea>
    
    <input type="submit" value="日記を書き込む">
</form>
@error('title')
<div class="text-red-700">{{ $message }}</div>
@enderror
</div>