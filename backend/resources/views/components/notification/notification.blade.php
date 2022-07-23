<div style="background-color:rgba({{$bg_color}},.5)"
    class="border-kn_2 border-2 rounded-xl px-4 py-4 my-4 flex items-center">
    {{-- status-excellent
    status-good
    status-poor --}}
    {{-- <p class="text-center">{{$date->format('Y年n月j日')}}</p> --}}

    {{-- $remove_typeの時点でroute()の値が入っているため問題なし --}}
    <form class="w-12" method="POST" action="{{$actionUrl}}">
        @csrf
        <input type="submit" class="text-black material-icons " style="background-color:inherit" value="highlight_off">
    </form>
    <div>
        <p class="text-sm ml-4 kiwi-maru">{{$date}}</p>
        <p class="text-xl kiwi-maru px-4"><a href="{{$url}}">{{$title}}</a></p>
    </div>
</div>
