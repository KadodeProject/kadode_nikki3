<div class="flex pb-8">
    <div class="sm:block hidden w-12">
        <div class="w-8 h-8 mx-auto bg-kn_3 rounded-full"></div>
        <div class=" mx-auto h-full bg-kn_3" style="width:6px;"></div>
    </div>
    <div class="w-full pr-4">
        <h2 class="ml-2 text-3xl kiwi-maru">{{$title}}</h2>
        <div class="flex justify-start items-center">
            <div class="ml-2 border-2 rounded-sm my-2 inline-block border-kn_3 border-solid">
                <p class="p-2 inline-block text-sm border-kn_3">{{$genre}}</p>
            </div>
            <h3 class="ml-4 text-xl">{{$date}}</h3>
        </div>
        <div class="py-4">
            <p>{{$explain}}</p>
        </div>
    </div>
</div>