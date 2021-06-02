<div class="">
    <form class="delete-button flex justify-center items-center " method="POST"action="/delete">
        @csrf
        <input type="hidden" value="{{$delete_uuid}}"name="uuid">
        <button type="submit" class="flex flex-col justify-center items-center"><span class="material-icons">delete</span><span>削除</span></button>
    </form>
</div>