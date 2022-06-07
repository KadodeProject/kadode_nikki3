<style>
    .vis-item {
        border-color: var(--button-main-color);
        background-color: var(--button-main-color);
        color: var(--text-main-color);
        font-family: "Kiwi Maru", serif;
    }
</style>
<div id="animeTimeline"></div>
<script src="{{ mix('js/drawTimeline.js') }}"></script>

<script>
    let timeline_data=[
            @foreach($anime_timeline as $anime)
            {
                id: {{$anime[0]}},
                content: '{{$anime[1]}}',
                start: '{{$anime[2]}}',
            },
            @endforeach

        ];
        drawTimeline('animeTimeline',timeline_data);
</script>
