@extends("layouts.noLogIn")
@section("title","お知らせ")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">お知らせ</h1>
<div class="mx-auto px-4" style="max-width: 1200px">

    @foreach($osirases as $osirase)
    @include('components.noLogIn.osiraseCard',
    ['title'=>$osirase->title,
    'date'=>$osirase->date->format('Y年n月j日'),
    'genre'=>$osirase->osiraseGenre->name,
    'explain'=>$osirase->description,
    ])
    @endforeach

</div>

@endsection
