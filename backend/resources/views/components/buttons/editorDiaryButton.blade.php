<div class="flex justify-center items-center mb-10">
    <form class="delete-button  " method="POST" action="{{route('DeleteDiary')}}">
        @csrf
        <input type="hidden" value="{{$delete_id}}" name="id">
        <button type="submit" class="bg-kn_poor rounded-sm ">
            <p class="p-2 align-middle kiwi-maru"> <span class="text-kn_w material-icons ">delete</span>日記削除</p>
        </button>
    </form>
</div>
