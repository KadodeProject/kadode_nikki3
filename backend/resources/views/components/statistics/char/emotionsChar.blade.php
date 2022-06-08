<div class="p-4 flex items-center justify-center flex-wrap">
    <p class="kiwi-maru  w-full md:w-1/2 md:text-right text-center  mb-2 md:mb-0 md:pr-4">感情</p>
    @php
    if($emotions_chr=="ポジティブ"){
    $bg_color="bg-kn_excellent";
    }else{
    $bg_color="bg-kn_poor";
    }

    @endphp
    <p class="kiwi-maru p-2 {{$bg_color}} rounded-xl w-full md:w-1/2 md:text-left text-center">{{$emotions_chr}}<span
            class="text-xs">({{$emotions_num}})</span></p>
</div>