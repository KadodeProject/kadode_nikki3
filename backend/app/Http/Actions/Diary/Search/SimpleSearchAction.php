<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Search;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\UseCases\Diary\SearchDiaries;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function count;

class SimpleSearchAction extends Controller
{
    public function __construct(
        private SearchDiaries $searchDiaries,
    ) {
    }

    public function __invoke(Request $request): View|Factory
    {
        $rules = [
            "keyword" => "min:2|max:20",
        ];
        // 検索結果のバリデーション
        $this->validate($request, $rules);
        //XSS対策は不要(外部からここにアクセスできないため、自身にしか攻撃できないため)←加えて、XSS対策まわりはフロントエンドで行われるため問題なし

        //DB叩く 最近の日記から直近50個
        DB::enableQueryLog();
        /** @var Collection|null */
        $diaries = $this->searchDiaries->invoke($request->keyword);
        Diary::where("content", "like", "%$request->keyword%")->orderby("date", "desc")->take(200)->get();
        //クエリ時間取得
        $queryLog = DB::getQueryLog();
        $queryTime = $queryLog[0]["time"];

        $numberOfDiaries = count($diaries);
        return view('diary/search/searchResult', ['counter' => $numberOfDiaries, 'keyword' => $request->keyword, 'diaries' => $diaries, 'queryTime' => $queryTime]);
    }
}