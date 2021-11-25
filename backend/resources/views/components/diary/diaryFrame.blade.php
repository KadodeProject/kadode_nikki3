<div class="diary_dashboard m-2 ">
    @if(isset($is_latest_statistic))
    @php
    $content_width="280";
    @endphp
    <section class="flex justify-center items-center " style="height:50px">
        @if($important_words!="false")
        <p class="flex flex-wrap  p-2  kiwi-maru rounded-xl text-sm"><span class="material-icons transform -rotate-45"
                style="font-size:20px">vpn_key</span>{{$important_words}}</p>
        @endif
        @if($special_people!="false")
        <p class="flex items-end  p-2  kiwi-maru rounded-xl text-sm"><span class="material-icons"
                style="font-size:20px">person</span>{{$special_people}}<span class="text-xs">さん</span></p>
        @endif
        @php
        if($emotions=="arrow_upward"){
        $bg_color="bg-status-excellent";
        }else{
        $bg_color="bg-status-poor";
        }
        @endphp
        <p class="flex  items-center m-2 justify-center   {{$bg_color}} kiwi-maru rounded-full w-6 h-6 text-sm"><span
                class="material-icons" style="font-size:0.75em">{{$emotions}}</span></p>
        <p class="text-sm kiwi-maru">[{{mb_strlen($content)}}文字]</p>
    </section>
    @else
    <section class="flex justify-center items-center " style="height:50px">
        <p class='text-gray-300 text-sm kiwi-maru text-center'>統計情報なし</p>
    </section>
    @php
    //$content_width="320";
    $content_width="280";
    @endphp
    @endif
    <section>
        <p class=" text-center text-xl kiwi-maru">{{$date}}
            @if(!isset($is_latest_statistic))
            <span class=" text-sm ">[{{mb_strlen($content)}}文字]</span>
            @endif
        </p>
        <p class=" text-center text-2xl overflow-x-scroll whitespace-nowrap overflow-y-hidden  kiwi-maru"
            style="height:1.8em">
            @php
            echo ((mb_strlen($title)>=1) ? $title:"<span class='text-gray-300'>タイトルなし</span>");
            @endphp
        </p>
    </section>
    <article class="p-2 text-sm overflow-x-scroll" style="height: {{$content_width}}px!important">
        <p class="">
            @component('customFunctions.omitContent')
            @slot("content")
            {{-- nl2br関数で\nを<br>に変換、さらにXSS攻撃防止のためにe()でサニタイズ、さらに!!!!でHTMLタグをエスケープさせない --}}
            {!! nl2br(e($content)) !!}
            @endslot
            @endcomponent
        </p>
    </article>
    @component('components.buttons.editDiaryButton')
    @slot("edit_uuid")
    {{$uuid}}
    @endslot
    @endcomponent
</div>
