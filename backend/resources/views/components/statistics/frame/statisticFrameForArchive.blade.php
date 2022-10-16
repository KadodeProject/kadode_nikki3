@vite(['resources/js/statistics/shortStatistics.js'])


<details class="text-kn_w  kiwi-maru">
    <summary class="text-center m-2 text-xl font-bold">
        このアーカイブの統計情報[更新日:{{$ArchiveData['updated_at']}}]
    </summary>

    <div class="flex itesm-center justify-center flex-wrap">

        <!-- うえ -->

        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <div class="mx-auto">

                    <h3 class="text-2xl float-left text-center">分類</h3>

                    <div
                        class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                        ?</div>
                    <div class="explain_hatena">固有値表現がらそれぞれの日記で抽出した分類をまとめたグラフです</div>
                </div>
                <div class="chartWrapper_small mx-auto block">
                    @component('components.statistics.graph.classificationsGraph',['classifications'=>$ArchiveData['classifications']])
                    @endcomponent
                </div>
            </section>
            <div>

            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">文字数</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">日記の本文の文字数推移です。年別表示では月ごとの1日記あたりの平均文字数にしています。</div>
                {{-- @php
                var_dump($ArchiveData['word_counts']);
                @endphp --}}
                <div class="chartWrapper_small mx-auto block">
                    @component('components.statistics.graph.wordCountsGraph',['word_counts'=>$ArchiveData['word_counts']])
                    @endcomponent
                </div>
            </section>
            <div>

            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">よく使う名詞</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">日記の本文から形態素解析で抽出した名詞の登場数多い順に5つです</div>
            </section>
            <div>
                @component('components.statistics.rank.topRank',['count'=>6,'ranked_array'=>$ArchiveData['noun_rank']])
                @endcomponent
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">よく使う形容詞</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">日記の本文から形態素解析で抽出した形容詞の登場数多い順に5つです</div>
            </section>
            <div>
                @component('components.statistics.rank.topRank',['count'=>6,'ranked_array'=>$ArchiveData['adjective_rank']])
                @endcomponent
            </div>
        </div>
        <!-- した -->
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">お気持ち</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">感情極性辞書を用いた本文の感情推測のこのアーカイブでの平均値です</div>
            </section>
            <div>
                @component('components.statistics.char.emotionsRateChar',['emotions'=>$ArchiveData['emotions']])
                @endcomponent
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">お気持ち推移</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">感情極性辞書を用いた本文の感情推測の推移です</div>
            </section>
            <div class="chartWrapper_small mx-auto block">
                @component('components.statistics.graph.emotionsChangeGraph',['emotions'=>$ArchiveData['emotions']])
                @endcomponent
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">人物</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">固有表現抽出を用いて本文から抽出した、日記でよく登場する人物です。</div>
            </section>
            <div>
                @component('components.statistics.rank.topRank',['count'=>6,'ranked_array'=>$ArchiveData['special_people']])
                @endcomponent
            </div>
        </div>
        <div class="md:w-1/4 w-full p-4">
            <section class=" kiwi-maru">
                <h3 class="text-2xl float-left text-center">重要そうな単語</h3>
                <div
                    class="cursor-pointer hatena_hover text-sm w-6 h-6 border rounded-full border-kn_3 flex items-center justify-center">
                    ?</div>
                <div class="explain_hatena">固有表現抽出を用いて本文から抽出した、固有表現の登場数の多い単語です。</div>
            </section>
            <div>
                @component('components.statistics.rank.topRank',['count'=>6,'ranked_array'=>$ArchiveData['important_words']])
                @endcomponent
            </div>
        </div>
    </div>
</details>
