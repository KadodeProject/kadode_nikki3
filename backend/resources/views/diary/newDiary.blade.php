
@extends("layouts.main")
@section("title","ホーム")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    

            <div class="diary-main">
                <div>  
                    @component('components.diary.submitForm')
                    @slot("db_method")
                    create
                    @slot("original_uuid")
                    @endslot
                    @endslot
                    @slot("original_date")
                    @endslot
                    @slot("original_title")
                    @endslot
                
                    @slot("original_content")
                    @endslot
                    @endcomponent
                </div>
            </div>
 
    </div>
      
@endsection
 