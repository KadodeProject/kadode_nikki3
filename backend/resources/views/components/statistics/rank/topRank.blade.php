<div>
    @php
    $i=1;
    @endphp
    <div class="flex justify-center">
        <div>
            @foreach($ranked_array as $rank)
            <p class="text-xl kiwi-maru">{{$i}}.{{$rank[0]}}({{$rank[1]}}回)</p>
            @php
            $i+=1;
            @endphp
            @if($i==$count)
            @break
            @endif
            @endforeach
        </div>
    </div>

</div>
