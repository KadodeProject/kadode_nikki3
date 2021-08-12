
@extends("layouts.main")
@section("title","編集")

@section('header')
@parent
@endsection
@section('content')
<div class="board-main">
      
    

            <div class="diary-main">
               <nav class="md:order-1 ">
                   @isset($next)
                   <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><a style="vertical-align: middle;" href="{{url('/edit')}}/{{$next->uuid}}"><span class="material-icons">arrow_back</span> {{$next->date}}</a></p>
                   @else
                   <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><span class="material-icons ">arrow_back</span><span class="material-icons">remove_circle_outline</span> 日記なし</p>
                   @endisset
                
               </nav>
               <nav class="order-2 md:order-3">
                    @isset($next)
                    <p class="md:ml-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" ><a style="vertical-align: middle;" href="{{url('/edit')}}/{{$previous->uuid}}"> {{$previous->date}} <span class="material-icons">arrow_forward</span></a></p>
                    @else
                    <p class="md:mr-12 md:mt-12 p-2 text-xl borer-2 border-border-main-color" >日記なし <span class="material-icons">remove_circle_outline</span><span class="material-icons">arrow_forward</span></p> 
                    @endisset
               </nav>
                <div class="order-3 md:order-2 ">
                    @component('components.diary.submitForm')
                    @slot("db_method")
                    update
                    @endslot
                    @slot("original_uuid")
                    {{$diary->uuid}}
                    @endslot
                    @slot("original_date")
                    {{$diary->date}}
                    @endslot
                    @slot("original_title")
                    {{$diary->title}}
                    @endslot
                    @slot("original_content")
                    {{$diary->content}}
                    @endslot
                    @slot("original_feel")
                    {{$diary->feel}}
                    @endslot
                    @endcomponent

                    @component('components.buttons.editorDiaryButton')
                    @slot("delete_uuid")
                    {{$diary->uuid}}
                    @endslot
                    @endcomponent
                </div>
              
     
            </div>
            {{-- <div class="flex w-auto m-4 overflow-y-auto" style="height: 500px;">
                @empty($diaries)
                    <h3 class="text-center text-3xl my-20">直近の日記はありません！</h3>
                @else
                    @foreach($diaries as $diary )
                        @component('components.diary.diaryFrame')
                            @slot("uuid")
                            {{$diary->uuid}}
                            @endslot
                            @slot("title")
                            {{$diary->title}}
                            @endslot
                            @slot("content")
                            {{$diary->content}}
                            @endslot
                            @slot("date")
                            {{$diary->date}}
                            @endslot
                            @slot("feel")
                            {{$diary->feel}}
                            @endslot
                        @endcomponent
                    @endforeach
                @endempty
            </div> --}}
    
        
    </div>
      
@endsection
 