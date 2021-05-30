
<div class="diary_dashboard m-4">
    
        <p class="p-4 text-xl">{{$date}}</p>
        <p class="p-4 text-2xl">{{$title}}</p>
        <p class="p-4 text-xl">{{$feel}}</p>
        <div class="p-12">
            
            
            <p class="p-4 text-lg">{{$content}}</p>
        </div>
    <a href="{{url('/diary/')}}/{{$uuid}}"><span class="material-icons-outlined">edit</span>編集</a>
</div>