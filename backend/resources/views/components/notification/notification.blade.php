<div style="background-color:rgba({{$bg_color}},.5)"
    class="border-button-main-color border-2 rounded-xl px-4 py-4 my-4">
    {{-- status-excellent
    status-good
    status-poor --}}
    {{-- <p class="text-center">{{$date->format('Y年n月j日')}}</p> --}}
    <p class="text-sm text-center kiwi-maru">{{$date}}</p>
    <p class="text-xl kiwi-maru px-4">{{$title}}</p>

    <form class="relative top-1 right-2" method="POST" action="/notification/{{$type}}/delete">
        @csrf
        <input type="submit" class="text-black material-icons " style="background-color:inherit" value="highlight_off">

    </form>
</div>
