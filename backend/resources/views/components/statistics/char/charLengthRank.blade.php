<div>
    @php
    $i=0;
    @endphp
    @foreach($biggerDiaries as $diary)
    @php
    $i+=1;
    @endphp
    <div class="py-4 px-2 flex justify-center items-center">
        <div class="w-1/5 md:w-2/5 ">
            <p class="kiwi-maru text-3xl text-right">{{$i}}位</p>
            <p class="kiwi-maru text-right text-xl">{{$diary->char_length}}<span class="text-sm">字</span></p>

        </div>
        <div class="w-4/5 md:w-3/5 pl-4">

            <p class="kiwi-maru flex items-center"><span class="material-icons pr-2" style="font-size:0.9em;">
                    schedule
                </span><span>{{$diary->date->format("Y年n月j日")}}</span></p>
            <h3 class="kiwi-maru text-3xl"><a href="{{url("edit/".$diary->uuid)}}">「{{$diary->title==""?"タイトルなし":$diary->title }}」</a></h3>
        </div>
    </div>
    @endforeach
</div>
