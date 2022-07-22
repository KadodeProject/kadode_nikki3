<div class="mx-auto p-4 md:w-2/3">
    <div id="wordCloudImportantWords">
    </div>
    @vite(['resources/js/drawWordCloud.js'])
    <!-- 描画 -->
    <script type="text/javascript">
        const id ="#wordCloudImportantWords";
            const data=@json($wordCloud_array,JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODEで日本語文字化け防止
            drawWordCloud(id,data);
    </script>
</div>
