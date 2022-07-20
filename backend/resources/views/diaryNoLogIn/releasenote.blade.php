@extends("layouts.noLogIn")
@section("title","リリースノート")

@section('header')
@parent
@endsection
@section('content')
<h1 class="text-center my-8 text-3xl kiwi-maru">リリースノート</h1>
<div class="mx-auto px-4 mb-12" style="max-width: 1200px">

    @foreach($releasenotes as $releasenote)
    @include('components.noLogIn.releasenote',
    ['title'=>$releasenote->title,
    'date'=>$releasenote->date->format('Y年n月j日'),
    'genre'=>$releasenote->releasenote_genre->name,
    'explain'=>$releasenote->description,
    ])
    @endforeach


</div>

@endsection
