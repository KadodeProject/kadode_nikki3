<?php

namespace App\Http\Controllers\diary;

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
     * Undocumented function
     *
     * @param [type] $uuid
     * @return void
     */
    public function get($uuid){

        $diary=Diary::where("uuid",$uuid)->first();
        if($diary==null){
            //日記無かったらリダイレクトさせる
            return redirect("home");
        }
        $next=Diary::where("date",">",$diary->date)->orderBy("date","asc")->first(['date','uuid']);
        $previous=Diary::where("date","<",$diary->date)->orderBy("date","desc")->first(['date','uuid']);

        //日記の統計情報取得
        $diary->is_latest_statistic=false;
        $diary_update= new Carbon($diary->updated_at);
        $stati_update=new Carbon($diary->updated_statistic_at);

        //undefined防止
        $resembleDiaries=[];

        //最新の情報のときのみ
        if($diary->statistic_progress==100 && $stati_update->gt($diary_update)){
            /**
             * 名詞と形容詞の登場順
             */
            //jsonを配列に戻し、連想配列を配列にする
            $diary->is_latest_statistic=true;
            $diary->important_words=array_values(json_decode($diary->important_words,true));
            $diary->special_people=array_values(json_decode($diary->special_people,true));


            /**
             * modelでの型定義とwhere("hoge->fuga")でjsonの中身引っ張ってこれる
             * が、diariesのjsonが[{},{}]のようになっているのでvalueが直接取れない。よってrawで$[0]とかして取得
             * $[*]でも取れるが、今回はその日記で一番多く登場した人物とすることで関連度を向上させている
             */

            /**
             * 日記内で一番多く登場した人物がかぶる日記をランダムに3つ取得
             */
            // \Log::debug($diary->special_people[0]['name']);//一番の人の名前抽出
            if(!empty($diary->special_people)){
                $resembleDiaries=Diary::where(DB::raw('json_extract(`special_people`, "$[0].name")'), $diary->special_people[0]['name'])->inRandomOrder()->limit(3)->get();
                /**
                 * 該当日記の統計データの表示処理
                 */
                $i=0;
                foreach ($resembleDiaries as $diary) {
                    $resembleDiaries[$i]->is_latest_statistic=false;
                    //統計データがあり、その統計データが日記の内容と合致しているかの判断
                    if(isset($resembleDiaries[$i]->updated_statistic_at)){
                        $diary_update= new Carbon($resembleDiaries[$i]->updated_at);
                        $stati_update=new Carbon($resembleDiaries[$i]->updated_statistic_at);
                        //gtでgreater than 日付比較
                        if($resembleDiaries[$i]->statistic_progress==100 && $stati_update->gt($diary_update)){
                            $resembleDiaries[$i]->is_latest_statistic=true;
                            $resembleDiaries[$i]->important_words=array_values(json_decode($diary->important_words,true));
                            $resembleDiaries[$i]->special_people=array_values(json_decode($diary->special_people,true));
                        }
                    }
                    $i+=1;
                }
                //統計データの表示処理ここまで
            }


        }

        return view('diary/edit',['diary' => $diary,'previous'=>$previous, 'next'=>$next,'resembleDiaries'=>$resembleDiaries,]);
    }

    public function newPage(){
        return view('diary/newDiary');
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
        $request->date=$request->date ?? Carbon::today()->format("y-m-d");

        // バリデーション
        $this->validate($request,Diary::$rules);

        $form=[
            "user_id"=>Auth::id(),
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "uuid"=>Str::uuid(),
        ];

        Diary::create($form);
        return redirect('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){


        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request,Diary::$rules);

        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
        ];
        Diary::where('uuid',$request->uuid)->update($updateContent);
        return redirect('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request){
        Diary::where('uuid',$request->uuid)->delete();
        return redirect('home');
    }


}