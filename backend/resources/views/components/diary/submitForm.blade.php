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
        <p class="text-xl mr-4">きもち:{{$original_feel}}</p>
    <select style="width:8em;"class="text-sm my-2" name="feel"size="1" >
        @for($i=1;$i<=10;$i++)
        @php
            $fraze="";
            $option="";
            $selector=5;
            if($original_feel=="7"){
                $selector=7;
            };
        @endphp
        @if($i==1)
        @php
        $fraze="(悪い)";
        @endphp
        @elseif($i==5)
        @php
        $fraze="(普通)";
        @endphp
        @elseif($i==10)
        @php
        $fraze="(良い)";
        @endphp
        @endif
        @if($i==$original_feel)
        @php
        $selector="selected";
        @endphp
        @endif
        <option value="{{$i}}" {{$option}}>{{$i}}{{$fraze}}</option>
    
        @endfor
    </select>
    </div>
    <textarea  placeholder="本文"class="p-4 w-full diary-content-edit" type="text" name="content" >{{$original_content}}</textarea>
    
    <input type="submit" value="日記を書き込む">
</form>
@error('title')
<div class="text-red-700">{{ $message }}</div>
@enderror
</div>