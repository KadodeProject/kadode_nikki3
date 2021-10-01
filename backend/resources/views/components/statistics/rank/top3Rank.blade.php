

<div>
    @php
    $i=1; 
    @endphp
    @foreach($ranked_array as $rank)
    <p class="text-xl">{{$i}}.{{$rank[0]}}({{$rank[1]}}回)</p>
        @php
        $i+=1; 
        @endphp
        @if($i==6)
            @break
        @endif
    @endforeach

</div>