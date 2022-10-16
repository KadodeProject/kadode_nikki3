<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Enums\StatisticStatus;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\UseCases\Diary\GetDiariesDateNextToDiaryById;
use App\UseCases\Diary\GetDiaryByUuid;
use App\UseCases\Diary\ShapeContentWithNlp;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

final class ShowSingleDiaryAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries,
        private ShapeContentWithNlp $shapeContentWithNlp,
        private GetDiaryByUuid $getDiaryByUuid,
        private GetDiariesDateNextToDiaryById $getDiariesDateNextToDiaryById,
    ) {
    }

    public function __invoke($uuid): View|RedirectResponse
    {
        $diary = $this->getDiaryByUuid->invoke($uuid);
        if ($diary === null) {
            //日記無かったらリダイレクトさせる
            return redirect(route('ShowHome'));
        }
        $dateAndUuidBA = $this->getDiariesDateNextToDiaryById->invoke($diary->date);


        /**
         * @todo 一時的に追加している日記加工処理
         */
        $resembleDiaries = "";
        $contentWithNlp = "";
        if ($diary['statisticStatus'] === StatisticStatus::existCorrectly) {
            /**
             * 日記内で一番多く登場した人物がかぶる日記をランダムに3つ取得
             * \Log::debug($diary->special_people[0]['name']);//一番の人の名前抽出
             * where('id', '<>',$diary->id)で自分自身を除く
             * modelでの型定義とwhere("hoge->fuga")でjsonの中身引っ張ってこれる
             * が、diariesのjsonが[{},{}]のようになっているのでvalueが直接取れない。よってrawで$[0]とかして取得
             * $[*]でも取れるが、今回はその日記で一番多く登場した人物とすることで関連度を向上させている
             */
            if (!empty($diary['special_people'])) {
                $resembleDiariesRaw = Diary::where('id', '<>', $diary['id'])->where(DB::raw('json_extract(`special_people`, "$[0].name")'), $diary['special_people'][0]['name'])->inRandomOrder()->limit(3)->get();
                $resembleDiaries = $this->shapeStatisticFromDiaries->invoke($resembleDiariesRaw);
            }
        }

        /**
         * @todo toArrayする処理はすべてUseCaseで行いたい(Actionsでは加工しないので)←今は一部処理がactionsに残っているのでこうしている
         */
        $diaryToArray = $diary->toArray();

        return view('diary/edit', ['diary' => $diaryToArray, 'contentWithNlp' => $contentWithNlp, 'dateAndUuidBA' => $dateAndUuidBA,  'resembleDiaries' => $resembleDiaries]);
    }
}