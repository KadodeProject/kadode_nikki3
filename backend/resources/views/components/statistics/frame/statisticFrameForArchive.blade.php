
<!-- ここに置かないとコンポーネントでchar.js使えないので -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<!--色自動付与プラグイン
→Chart.jsのver2系でないと動かないため廃止
-->
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script> --}}
{{-- 補助線引くためのプラグイン↓ --}}
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2/dist/chartjs-plugin-annotation.min.js" integrity="sha512-FuXN8O36qmtA+vRJyRoAxPcThh/1KJJp7WSRnjCpqA+13HYGrSWiyzrCHalCWi42L5qH1jt88lX5wy5JyFxhfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<details class="text-main-color  kiwi-maru">
    <summary class="text-center m-2 text-xl font-bold">
        このアーカイブの統計情報[更新日:{{$statisticPerMonth->updated_at}}]
    </summary>

    <div class="flex itesm-center justify-center flex-wrap">

        <!-- うえ -->

        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <div class="mx-auto">

                    <h3 class="text-2xl float-left text-center">分類</h3>
    
                    <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                </div>
                <div class="explain_hatena">固有値表現がらそれぞれの日記で抽出した分類をまとめたグラフです</div>

                @component('components.statistics.graph.classificationsGraph',['classifications'=>$statisticPerMonth->classifications])
                @endcomponent
            </section>
            <div>
                
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">文字数</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">日記の本文の文字数推移です。</div>
                {{-- @php
                var_dump($statisticPerMonth->word_counts);
                @endphp --}}
                @component('components.statistics.graph.wordCountsGraph',['word_counts'=>$statisticPerMonth->word_counts])
                @endcomponent
            </section>
            <div>
                
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">よく使う名詞</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">日記の本文から形態素解析で抽出した名詞の登場数多い順に3つです</div>
            </section>
            @component('components.statistics.rank.top3Rank',['ranked_array'=>$statisticPerMonth->noun_rank])
            @endcomponent
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">よく使う形容詞</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">日記の本文から形態素解析で抽出した形容詞の登場数多い順に3つです</div>
            </section>
            @component('components.statistics.rank.top3Rank',['ranked_array'=>$statisticPerMonth->adjective_rank])
            @endcomponent

        </div>
        <!-- した -->
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">お気持ち</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">感情極性辞書を用いた本文の感情推測のこのアーカイブでの平均値です</div>
            </section>
            @component('components.statistics.char.emotionsRateChar',['emotions'=>$statisticPerMonth->emotions])
            @endcomponent
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">お気持ち推移</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">感情極性辞書を用いた本文の感情推測の推移です</div>
            </section>
            @component('components.statistics.graph.emotionsChangeGraph',['emotions'=>$statisticPerMonth->emotions])
            @endcomponent
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">人物</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">アノテーションを用いて本文から抽出した、日記でよく登場する人物です。</div>
            </section>
            @component('components.statistics.rank.top3Rank',['ranked_array'=>$statisticPerMonth->special_people])
            @endcomponent
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">重要そうな単語</h3>
                <div class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-border-main-color flex items-center justify-center">?</div>
                <div class="explain_hatena">アノテーションを用いて本文から抽出した、固有表現の登場数の多い単語です。</div>
            </section>
            @component('components.statistics.rank.top3Rank',['ranked_array'=>$statisticPerMonth->important_words])
            @endcomponent
        </div>
      

    </div>
</details>
