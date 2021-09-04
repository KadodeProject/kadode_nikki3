

    <section>
        <p class=" text-center text-2xl">{{$date}} <span class="text-sm">[{{mb_strlen($content)}}文字]</span></p>
        <p class=" text-center text-2xl mt-4">
            @php
            echo ((mb_strlen($title)>=1) ? $title:"<span class='text-gray-300'>タイトルなし</span>");
            @endphp   
        </p>
    </section>
    <article class="mt-2">
        <p class="p-2 pt-0 text-lg">
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