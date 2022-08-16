<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\UseCases\Diary\GetApplicableDateTweet;
use App\UseCases\Diary\ShapeContentWithNlp;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class ShowSingleDiaryAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries,
        private ShapeContentWithNlp $shapeContentWithNlp,
        private GetApplicableDateTweet $getApplicableDateTweet,
    ) {
    }

    public function __invoke($uuid): View|Factory|Redirector|RedirectResponse
    {
        $diary = Diary::where("uuid", $uuid)->first();
        if ($diary === null) {
            //日記無かったらリダイレクトさせる
            return redirect(route('ShowHome'));
        }
        $next = Diary::where("date", ">", $diary->date)->orderBy("date", "asc")->first(['date', 'uuid']);
        $previous = Diary::where("date", "<", $diary->date)->orderBy("date", "desc")->first(['date', 'uuid']);

        //その日のツイート取得
        dd($this->getApplicableDateTweet->invoke("usuyuki26", $diary->date));

        //日記の統計情報取得
        $diary->is_latest_statistic = false;
        $diary_update = new Carbon($diary->updated_at);
        $stati_update = new Carbon($diary->updated_statistic_at);

        //undefined防止
        $resembleDiaries = [];
        $contentWithNlp = [];

        //最新の情報のときのみ
        if ($diary->statistic_progress === 100 && $stati_update->gt($diary_update)) {
            /**
             * 名詞と形容詞の登場順
             */
            //jsonを配列に戻し、連想配列を配列にする
            $diary->is_latest_statistic = true;
            $diary->important_words = array_values(json_decode($diary->important_words, true));
            $diary->special_people = array_values(json_decode($diary->special_people, true));

            /** NLP付き表示を生成する */
            $contentWithNlp = $this->shapeContentWithNlp->invoke($diary);

            /**
             * modelでの型定義とwhere("hoge->fuga")でjsonの中身引っ張ってこれる
             * が、diariesのjsonが[{},{}]のようになっているのでvalueが直接取れない。よってrawで$[0]とかして取得
             * $[*]でも取れるが、今回はその日記で一番多く登場した人物とすることで関連度を向上させている
             */

            /**
             * 日記内で一番多く登場した人物がかぶる日記をランダムに3つ取得
             */
            // \Log::debug($diary->special_people[0]['name']);//一番の人の名前抽出
            //where('id', '<>',$diary->id)で自分自身を除く
            if (!empty($diary->special_people)) {
                $resembleDiaries = Diary::where('id', '<>', $diary->id)->where(DB::raw('json_extract(`special_people`, "$[0].name")'), $diary->special_people[0]['name'])->inRandomOrder()->limit(3)->get();
                $resembleDiaries = $this->shapeStatisticFromDiaries->invoke($resembleDiaries);
            }
        }

        return view('diary/edit', ['diary' => $diary, 'contentWithNlp' => $contentWithNlp, 'previous' => $previous, 'next' => $next, 'resembleDiaries' => $resembleDiaries,]);
    }
}