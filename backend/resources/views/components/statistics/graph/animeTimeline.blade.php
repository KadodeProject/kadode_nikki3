<style>
    .vis-item {
        border-color: var(--kn_2);
        background-color: var(--kn_2);
        color: var(--text-kn_w);
        font-family: "Kiwi Maru", serif;
    }
</style>
<div id="animeTimeline"></div>
@vite(['resources/js/drawTimeline.js'])

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
