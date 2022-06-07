<style>
    .vis-item {
        border-color: var(--button-main-color);
        background-color: var(--button-main-color);
        color: var(--text-main-color);
        font-family: "Kiwi Maru", serif;
    }
</style>
<div id="animeTimeline"></div>
<script>
    // DOM element where the Timeline will be attached
        var container = document.getElementById('animeTimeline');

        // Create a DataSet (allows two way data-binding)
        var items = new vis.DataSet([
            @foreach($anime_timeline as $anime)
            {
                id: {{$anime[0]}},
                content: '{{$anime[1]}}',
                start: '{{$anime[2]}}',
            },
            @endforeach

        ]);

        // Configuration for the Timeline
        var options = {
            // height: '200px',
        };

        // Create a Timeline
        var timeline = new vis.Timeline(container, items, options);
</script>
