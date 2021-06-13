<div class="">
    <form class="delete-button flex justify-center items-center p-8" method="POST"action="/delete">
        @csrf
        <input type="hidden" value="{{$delete_uuid}}"name="uuid">
        <button type="submit" class=" flex flex-col  items-center ">
            <span class="text-main-color material-icons">delete</span>
            <p style="width:2em!important">削除</p>
        </button>
    </form>
</div>