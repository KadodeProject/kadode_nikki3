
<div class="diary_dashboard m-2 " >
    
    <section>
        <p class=" text-center text-xl">{{$date}} <span class="text-sm">[{{mb_strlen($content)}}文字]</span><span class="text-sm"> [気持ち:{{$feel}}]</span></p>
        <p class=" text-center text-2xl">
            @php
            echo ((mb_strlen($title)>=1) ? $title:"<span class='text-gray-300'>タイトルなし</span>");
            @endphp
        </p>

    </section>
    <article class="p-2 text-sm overflow-y-scroll" style="height: 300px!important">
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