@isset($ended_diaries_count)
    <p class="text-center kiwi-maru">個別日記解析状況</p>
    <div class="chartWrapper_small">
        <div class="relative pt-1">
            <div class="flex mb-2 items-center justify-between">
              <div>

              </div>
              <div class="text-right">
                <span class="text-xs font-semibold inline-block text-pink-600">
               {{$number_of_nikki}}日記中{{$ended_diaries_count}}日記完了
                </span>
              </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-pink-200">
              <div style="width:{{$percecntage}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500"></div>
            </div>
          </div>
   
    </div>
<!--進行中のときの動作-->
   

@endisset