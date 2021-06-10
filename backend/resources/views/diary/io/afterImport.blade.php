
@extends("layouts.main")
@section("title","インポート結果")

@section('header')
@parent
@endsection
@section('content')
<div class=" my-8" id="">
      
    <div class="setting">
        <h2 class="text-2xl">インポート結果</h2>
        <p>{{$importResult}}</p>
    </div>
    

       
    
        
</div>
      
@endsection
 