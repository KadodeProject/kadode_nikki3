@php
$date=explode("-", $date);
$year=$date[0];
$month=$date[1];
$day=$date[2];
@endphp

<div class=" md:w-1/2 mx-auto">
    <p class="text-sm kiwi-maru  flex justify-end items-center"><span class="material-icons">folder_open</span><span><a
                class="mx-2" href="{{route('ShowYearDiary',['year'=>$year])}}">{{$year}}</a>><a class="mx-2"
                href="{{route('ShowMonthDiary',['year'=>$year,'month'=>$month])}}">{{$month}}</a></span></p>
</div>
