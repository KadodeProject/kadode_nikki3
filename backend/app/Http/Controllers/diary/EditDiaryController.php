<?php

namespace App\Http\Controllers\diary;

use App\CustomFunction\diaryDisplayPreProcessing;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EditDiaryController extends Controller
{
    /**
     * 日記の編集ページを取得する関数
     *
     * @param [type] $uuid
     */
    public function get($uuid): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {

        $diary = Diary::where("uuid", $uuid)->first();
        if ($diary == null) {
            //日記無かったらリダイレクトさせる
            return redirect("home");
        }
        $next = Diary::where("date", ">", $diary->date)->orderBy("date", "asc")->first(['date', 'uuid']);
        $previous = Diary::where("date", "<", $diary->date)->orderBy("date", "desc")->first(['date', 'uuid']);

        //日記の統計情報取得
        $diary->is_latest_statistic = false;
        $diary_update = new Carbon($diary->updated_at);
        $stati_update = new Carbon($diary->updated_statistic_at);

        //undefined防止
        $resembleDiaries = [];

        //最新の情報のときのみ
        if ($diary->statistic_progress == 100 && $stati_update->gt($diary_update)) {
            /**
             * 名詞と形容詞の登場順
             */
            //jsonを配列に戻し、連想配列を配列にする
            $diary->is_latest_statistic = true;
            $diary->important_words = array_values(json_decode($diary->important_words, true));
            $diary->special_people = array_values(json_decode($diary->special_people, true));


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
                $resembleDiaries = diaryDisplayPreProcessing::shapeStatisticFromDiaries($resembleDiaries);
            }
        }

        return view('diary/edit', ['diary' => $diary, 'previous' => $previous, 'next' => $next, 'resembleDiaries' => $resembleDiaries,]);
    }

    /**
     * 新規作成ページを表示するメソッド
     *
     */
    public function newPage(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('diary/newDiary');
    }
    /**
     * 新しく日記を作成するメソッド
     */
    public function create(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $request->date = $request->date ?? Carbon::today()->format("y-m-d");

        // バリデーション
        $this->validate($request, Diary::$rules);

        $form = [
            "user_id" => Auth::id(),
            "title" => $request->title,
            "content" => $request->content,
            "date" => $request->date,
            "uuid" => Str::uuid(),
        ];

        Diary::create($form);
        return redirect('home');
    }

    /**
     * 日記を更新するメソッド
     */
    public function update(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {


        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, Diary::$rules);

        $updateContent = [
            "title" => $request->title,
            "content" => $request->content,
            "date" => $request->date,
        ];
        Diary::where('uuid', $request->uuid)->update($updateContent);
        return redirect('home');
    }

    /**
     * 日記を削除するメソッド
     *
     */
    public function delete(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Diary::where('uuid', $request->uuid)->delete();
        return redirect('home');
    }
}