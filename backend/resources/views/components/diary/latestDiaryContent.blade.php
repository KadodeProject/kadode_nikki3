

    <section>
        <p class=" text-center text-xl">{{$date}}</p>
        <p class=" text-center text-2xl">{{$title}}</p>
        <div class=" text-xl flex items-center justify-center" style="height: 54px"><p>きもち:{{$feel}}</p></div>
    </section>
    <article class="">
        <p class="p-2 text-lg">{{$content}}</p>
    </article>
    @component('components.buttons.editDiaryButton')
    @slot("edit_uuid")
    {{$uuid}}
    @endslot
    @endcomponent