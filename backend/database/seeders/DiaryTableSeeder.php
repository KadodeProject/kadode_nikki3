<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $param=[
            'user_id'=>2,
            'statistic_progress'=>0,
            'uuid'=>Str::uuid(),
            'title'=>"日記1-1",
            'content'=>"今日は日記を書いた。今日は日記を書いた。今日は日記を書いた。今日は日記を書いた。今日は日記を書いた。今日は日記を書いた。今日は日記を書いた。",
            'date'=>$dt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table("diaries")->insert($param);

        for($i=0;$i<=100;$i+=1){
            $param=[
                'user_id'=>1,
                'statistic_progress'=>0,
                'uuid'=>Str::uuid(),
                'title'=>"日記".$i."-1",
                'content'=>"これは".$i."回目のテストデータである。あさ、眼をさますときの気持は、面白い。かくれんぼのとき、押入れの真っ暗い中に、じっと、しゃがんで隠れていて、突然、でこちゃんに、がらっと襖ふすまをあけられ、日の光がどっと来て、でこちゃんに、「見つけた！」と大声で言われて、まぶしさ、それから、へんな間の悪さ、それから、胸がどきどきして、着物のまえを合せたりして、ちょっと、てれくさく、押入れから出て来て、急にむかむか腹立たしく、あの感じ、いや、ちがう、あの感じでもない、なんだか、もっとやりきれない。箱をあけると、その中に、また小さい箱があって、その小さい箱をあけると、またその中に、もっと小さい箱があって、そいつをあけると、また、また、小さい箱があって、その小さい箱をあけると、また箱があって、そうして、七つも、八つも、あけていって、とうとうおしまいに、さいころくらいの小さい箱が出て来て、そいつをそっとあけてみて、何もない、からっぽ、あの感じ、少し近い。パチッと眼がさめるなんて、あれは嘘だ。濁って濁って、そのうちに、だんだん澱粉でんぷんが下に沈み、少しずつ上澄うわずみが出来て、やっと疲れて眼がさめる。朝は、なんだか、しらじらしい。悲しいことが、たくさんたくさん胸に浮かんで、やりきれない。いやだ。いやだ。朝の私は一ばん醜みにくい。両方の脚が、くたくたに疲れて、そうして、もう、何もしたくない。熟睡していないせいかしら。朝は健康だなんて、あれは嘘。朝は灰色。いつもいつも同じ。一ばん虚無だ。朝の寝床の中で、私はいつも厭世的だ。いやになる。いろいろ醜い後悔ばっかり、いちどに、どっとかたまって胸をふさぎ、身悶みもだえしちゃう。",
                'date'=>$dt->subDay(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table("diaries")->insert($param);
        }

    }
}
