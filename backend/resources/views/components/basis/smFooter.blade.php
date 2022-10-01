<div class="sm:hidden" style="height: 60px">
    <!-- smフッターメニューのための余白 -->
</div>

<div id="smFooter"
    class="bg-kn_b w-full border-kn_3 border-t-2  fixed bottom-0 right-0 sm:hidden flex  justify-around items-center z-10"
    style="height: 60px">
    <p><a class="flex justify-center flex-col" href="{{route('ShowHome')}}"><span
                class="material-icons mx-auto">home</span><span class="text-xs">ホーム</span></a></p>
    <p><a class="flex justify-center flex-col" href="{{route('ShowCreateDiary')}}"><span
                class="material-icons mx-auto">edit</span><span class="text-xs">日記作成</span></a></p>
    <p><a class="flex justify-center flex-col"
            href="{{route('ShowMonthDiary',['year'=>date('Y'),'month'=>date('n')])}}"><span
                class="material-icons mx-auto">collections_bookmark</span><span class="text-xs">アーカイブ</span></a></p>
    <p><a class="flex justify-center flex-col" href="{{route('ShowStatistic')}}"><span
                class="material-icons mx-auto">poll</span><span class="text-xs">統計</span></a></p>
</div>
