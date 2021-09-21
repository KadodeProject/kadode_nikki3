<div class="flex justify-center items-center">
    <form class="delete-button  " method="POST"action="/delete">
        @csrf
        <input type="hidden" value="{{$delete_uuid}}"name="uuid">
        <button type="submit" class="bg-status-poor rounded-sm ">
            <p class="p-2 align-middle"> <span class="text-main-color material-icons ">delete</span>削除</p>
        </button>
    </form>
</div>