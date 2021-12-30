<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReleasenoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $param=[
            [
                'title'=>"お知らせ表示機能実装" ,
                'genre_id'=>1 ,
                'description'=>"トップページにお知らせ表示がされるようになりました。新しいお知らせ、リリースノート及びユーザーランクアップの際に表示されます。バツ印より消せます。" ,
                'date' => Carbon::create(2021,12,30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"ユーザーランク機能実装" ,
                'genre_id'=>1 ,
                'description'=>"使えば使うほどランクが上がるユーザーランク機能が実装されました。設定ページから現在のランクをご確認いただけます。現在ベータ版です。" ,
                'date' => Carbon::create(2021,12,30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"ユーザーロール機能実装" ,
                'genre_id'=>1 ,
                'description'=>"管理者ユーザーを追加しました。" ,
                'date' => Carbon::create(2021,12,30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"モバイル端末での閲覧時不具合修正" ,
                'genre_id'=>1 ,
                'description'=>"モバイル端末での閲覧時に画面が若干拡大されて表示されるミスの修正を行いました。" ,
                'date' => Carbon::create(2021,11,25),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"統計ページで重要そうな単語のWordCloud生成" ,
                'genre_id'=>2 ,
                'description'=>"統計ページにて、重要そうな単語を可視化するwordCloudが表示できるようになりました。" ,
                'date' => Carbon::create(2021,11,14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"自然言語処理結果を総統計でも表示" ,
                'genre_id'=>2 ,
                'description'=>"これまで年別、月別、個別にのみ表示されていた「重要そうな言葉」や「人物」などの自然言語処理情報の総計版が統計ページよりご覧いただけるようになりました。それに伴いリファクタリングを行い、若干の処理速度向上も図りました。" ,
                'date' => Carbon::create(2021,10,27),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"統計更新での全日記進捗リセットに関するバグ" ,
                'genre_id'=>1 ,
                'description'=>"任意のユーザーが統計更新を行った際に、全ユーザーの日記の進捗がリセットされ統計情報が表示されなくなるバグを修正しました。" ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"固有表現ルールをまとめたパッケージを追加" ,
                'genre_id'=>2 ,
                'description'=>"ユーザーが定義した固有表現ルール以外にパッケージを選ぶことで固有表現ルールを追加できる機能をリリースしました。正直私利私欲でしかありませんが趣味のwebアプリであること故ご了承願います。" ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"パッケージ機能リリース" ,
                'genre_id'=>2 ,
                'description'=>"統計生成の解析時に使用できるパッケージ機能を追加しました。「統計設定」より有効無効が設定できます。" ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"ユーザー定義の固有表現ルール追加機能" ,
                'genre_id'=>2 ,
                'description'=>"新しくできた「統計設定」ページより、ご自身で固有表現ルールを追加できるようになりました。" ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"日記の本文でのショートカット" ,
                'genre_id'=>2 ,
                'description'=>"日記の本文入力で「Ctrl+Enter」(Macの方は「Cmd+Enter」)を押した際にクリックせず日記の書き込みを行えるようになりました。" ,
                'date' => Carbon::create(2021,10,24),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"アーカイブページでの編集ボタン消失問題解消" ,
                'genre_id'=>1 ,
                'description'=>"携帯端末などでアーカイブページを閲覧した際に、タイトル文字数が多いとき編集ボタンが消失する問題を解決しました。" ,
                'date' => Carbon::create(2021,10,3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"年別アーカイブでの統計情報表示" ,
                'genre_id'=>2 ,
                'description'=>"年ごとのアーカイブページでも月ごとと同様の統計情報を表示するようにしました。この機会に昔を振り返ってみてはいかがでしょうか。" ,
                'date' => Carbon::create(2021,10,2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"月別アーカイブでの統計情報表示" ,
                'genre_id'=>2,
                'description'=>"月ごとのアーカイブページで統計情報を表示するようにしました。気持ちの推移や分類、よく使われた言葉などをご確認いただけます。" ,
                'date' => Carbon::create(2021,10,1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"アーカイブ、検索、ホームでのミニ統計情報表示機能" ,
                'genre_id'=>2 ,
                'description'=>"日記の編集ページ以外でも簡易的な統計機能を表示できるようになりました。" ,
                'date' => Carbon::create(2021,9,25),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"個別日記ページでのパンくずリストの追加" ,
                'genre_id'=>2 ,
                'description'=>"該当するアーカイブページに素早く移動できるよう、個別日記ページにパンくずリストを追加しました。" ,
                'date' => Carbon::create(2021,9,24),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"【統計】個別の日記での統計表示を追加" ,
                'genre_id'=>2 ,
                'description'=>"個々の日記の編集ページで「感情」「推定分類」「重要そうな言葉」「登場人物」の統計データが見れるようになりました。" ,
                'date' => Carbon::create(2021,9,23),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"【統計】自然言語処理個別日記の進行状況のグラフ化" ,
                'genre_id'=>2 ,
                'description'=>"今後の自然言語処理関連の実装に備えて、どのくらいの日記が解析済みかを示すプログレスバーを表示するようにしました。" ,
                'date' => Carbon::create(2021,9,21),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"統計機能の日記数制限" ,
                'genre_id'=>1 ,
                'description'=>"日記数が少ない場合グラフの崩壊などが生じるため、日記が30件未満の場合には生成できないように制限を設けました。" ,
                'date' => Carbon::create(2021,9,17),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"モバイル端末で本文入力中のフッターメニュー除去" ,
                'genre_id'=>2,
                'description'=>"モバイル端末で日記の本文を入力している際に、フッターメニューがバーチャルキーボードの上に表示され操作性が低下している問題を解決しました。" ,
                'date' => Carbon::create(2021,9,11),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"設定、統計のデザイン刷新" ,
                'genre_id'=>1 ,
                'description'=>"設定ページと統計ページのデザインを刷新しました。" ,
                'date' => Carbon::create(2021,9,11),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"【統計】自然言語処理進行状況のグラフ化" ,
                'genre_id'=>2 ,
                'description'=>"今後の自然言語処理関連の実装に備えて、どれくらい現段階で処理が進んでいるかを表示するグラフを描画するようにしました。" ,
                'date' => Carbon::create(2021,9,7),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"【統計】名詞と形容詞の登場順をグラフ化" ,
                'genre_id'=>2 ,
                'description'=>"形態素解析を用いて、日記全体に含まれる単語をカウントし、名詞と形容詞をグラフ化しました。" ,
                'date' => Carbon::create(2021,9,6),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"「気持ち」機能削除" ,
                'genre_id'=>3 ,
                'description'=>"形態素解析導入に伴い、各日記で手動で設定できた十段階の「気持ち」機能を削除しました。" ,
                'date' => Carbon::create(2021,9,4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"日記編集ページ改善" ,
                'genre_id'=>2 ,
                'description'=>"日記編集ページにおいて、前後の日記のリンクが表示されるようになりました。" ,
                'date' => Carbon::create(2021,8,12),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"日記表示文字数変更" ,
                'genre_id'=>1 ,
                'description'=>"ホームページやアーカイブページなどで日記の表示文字数を最大2000文字に変更しました。" ,
                'date' => Carbon::create(2021,8,12),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"統計機能追加" ,
                'genre_id'=>2 ,
                'description'=>"月ごとの1日記あたりの平均文字数推移、月ごとの日記執筆率のグラフが表示できるようになりました。" ,
                'date' => Carbon::create(2021,6,19),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"レスポンシブ対応" ,
                'genre_id'=>2 ,
                'description'=>"スマホでもかどで日記をご利用いただけるようになりました。" ,
                'date' => Carbon::create(2021,6,19),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"一般向けサービスローンチ" ,
                'genre_id'=>2 ,
                'description'=>"会員登録してご利用いただけます。" ,
                'date' => Carbon::create(2021,6,14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"日記のインポート機能を追加しました" ,
                'genre_id'=>2 ,
                'description'=>"かどで日記形式のCSVファイル、月に書く日記のTXTファイルがご利用いただけます。" ,
                'date' => Carbon::create(2021,6,10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"日記のエクスポート機能を追加しました" ,
                'genre_id'=>2 ,
                'description'=>"かどで日記形式のCSVファイルを出力できます。" ,
                'date' => Carbon::create(2021,6,4),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"かどで日記3開発開始" ,
                'genre_id'=>3 ,
                'description'=>"現行版となる、かどで日記3の初期リポジトリでのinitial commit日。" ,
                'date' => Carbon::create(2021,5,30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"かどで日記開発開始" ,
                'genre_id'=>3 ,
                'description'=>"かどで日記の初期リポジトリでのinitial commit日。" ,
                'date' => Carbon::create(2020,12,31),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("releasenotes")->insert($param);


    }
}