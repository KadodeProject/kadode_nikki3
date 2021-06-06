
<div class="diary_dashboard m-2  ">
    
    <section>
        <p class=" text-center text-xl">{{$date}} <span class="text-sm">[{{mb_strlen($content)}}文字]</span></p>
        <p class=" text-center text-2xl">
            @php
            echo ((mb_strlen($title)>=1) ? $title:"<span class='text-gray-300'>タイトルなし</span>");
            @endphp
        </p>
        <div class=" text-xl flex items-center justify-center" style="height: 54px"><p>きもち:{{$feel}}</p></div>
    </section>
    <article class="p-2 text-sm overflow-y-hidden">
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