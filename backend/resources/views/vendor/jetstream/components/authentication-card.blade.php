<style>
    input{
        background-color:#2F3437!important;
        border-color: #4B8996!important;
        color:#f9fff9!important;
    }
    input:focus{
        border-color: #4B8996!important;
    }
    label{
        color:#f9fff9!important;
    }
    a{
        color:#f9fff9!important;
    }
    span{
        color:#f9fff9!important;
    }
    div{
        color:#f9fff9!important;
    }
    button{
        color:#f9fff9!important;
    }
</style>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 " style="background-color:#2F3437">
    <div class="bg-white rounded-full p-4">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden sm:rounded-lg" style="background-color:#5a6369;">
        {{ $slot }}
    </div>
</div>
