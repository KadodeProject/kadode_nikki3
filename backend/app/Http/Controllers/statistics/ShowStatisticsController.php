<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class ShowStatisticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */


    public function __invoke()
    {
        $user_id=Auth::id();
        $statistic=Statistic::where("user_id",$user_id)->first();
        /**
         * 日記数少なすぎるときは警告出したいので
         * これは統計表示前にも使うので1統計テーブルからのデータは使えない
         */
        $number_of_nikki=Diary::where("user_id",$user_id)->count();
        $wordCloud_json="";

        $ended_diaries_count="";//undefinedエラー防止用
        if(!empty($statistic)){
            if($statistic->statistic_progress==100){

                /**
                 * 名詞と形容詞の登場順
                 */
                //jsonを配列に戻し、連想配列を配列にする

                $statistic->total_noun_asc=array_values(json_decode($statistic->total_noun_asc,true));
                $statistic->total_adjective_asc=array_values(json_decode($statistic->total_adjective_asc,true));
                $statistic->emotions=array_values(json_decode($statistic->emotions,true));
                $statistic->special_people=array_values(json_decode($statistic->special_people,true));
                $statistic->classifications=array_values(json_decode($statistic->classifications,true));
                $statistic->important_words=array_values(json_decode($statistic->important_words,true));
                /**
                 * 月ごとの1日記あたりの平均文字数算出
                 */
                //配列のキーから月を取得
                $statistic->months=array_keys(json_decode($statistic->month_words,true));
                //jsonを配列に戻し、連想配列を配列にする
                $statistic->month_words=array_values(json_decode($statistic->month_words,true));
                $statistic->month_diaries=array_values(json_decode($statistic->month_diaries,true));
                //一度変数に代入しないと怒られるのでこうしている。
                $statistic_month_diaries=$statistic->month_diaries;//平均文字数で利用
                /**
                 * 月当たりの平均文字数にする(月の合計文字数わる日記数)
                 */
                $tmp=[];
                $i=0;
                foreach ($statistic->month_words as $month_word){
                    array_push($tmp,$month_word/($statistic_month_diaries[$i]));
                    $i+=1;
                }
                $statistic->month_words_per_diary=$tmp;
                /**
                 * 月ごとの執筆率
                 */
                $monthWritingRate=[];
                $i=0;
                foreach($statistic->months as $date){
                    //閏年などの対応のため、毎度月の長さをcarbonで作る
                    //mbの必要ないので。ただのsubstr 202101みたいな形式なっているので。
                    $year=substr($date,0,3);
                    $month=substr($date,5);
                    $start=Carbon::create($year,$month);
                    $end=Carbon::create($year,$month)->endOfMonth();

                    //月の長さ↓
                    $lengthThisMonth=$start->diffInDays($end)+1;

                    //執筆率の計算
                    $writingRate=($statistic_month_diaries[$i]/$lengthThisMonth)*100;

                    array_push($monthWritingRate,$writingRate);
                    $i++;
                }
                $statistic->monthWritingRate=$monthWritingRate;


                //wordCloud描画用
                /**必要なデータ形式
                 * [
                    {"word":"あああ","count":9},
                    {"word":"いいい","count":3},
                    {"word":"ううう","count":4},
                    {"word":"えええ","count":3},]
                 */
                $wordCloud_array=array();
                foreach ($statistic->important_words as $value){
                    $wordCloud_array[]=array("word"=>$value[0],"count"=>$value[1]);
                }
                $wordCloud_json=json_encode($wordCloud_array,JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODEで日本語文字化け防止

            /**
             * ヒストグラム用のやつ
             */
            $char_length_obj=Diary::where("user_id",$user_id)->get(['char_length']);


            //array_valuesだと何故か事故るので
            //文字数の配列取得
            $char_length_list=[];
            foreach($char_length_obj as $value){
                $char_length_list[]=$value->char_length;
            }
            //からの要素削除(nullがあるとmin()で盛大に壊れる))
            $char_length_list=array_filter($char_length_list);


            /**
             * 度数分布表の作成
             */
            $char_length_frequency_distribution=[];//配列の1つ目に度数、2つ目に度数の値
            $frequencies=[];//度数の最小値を入れる
            $max=max($char_length_list);
            $min=min($char_length_list);
            $width=ceil(($max-$min)/20);//20分割、切り上げ,20個生成するので、どう転んでも入り切るように切り上げ
            $i=$min;
            for($n=1;$n<=20;$n++){
                $char_length_frequency_distribution[$i."-".($i+$width)]=0;//707-708みたいな感じ xx以上-xx未満
                $frequencies[]=$i;
                $i+=$width;
            }
            /**
             * 度数分布表への代入
             */
            foreach($char_length_list as $value){
                foreach($frequencies as $frequency){
                    if($value<=$frequency ){
                        $char_length_frequency_distribution[($frequency)."-".($frequency+$width)]+=1;
                        // \Log::debug($value."は".($frequency)."-".($frequency+$width)."に入る");
                        break;
                    }
                }
            }

            $biggerDiaries=Diary::where("user_id",$user_id)->orderBy("char_length","desc")->limit(10)->get(['date','title','uuid','char_length']);

            }
            // 統計100じゃないとだめ系ここまで

            /**
             * 個別日記処理の進捗を取得する処理
             */
            $ended_diaries_count=Diary::sum('statistic_progress') /100; #終わっている日記数の推定値(本当は50で全部通してから次行くので、実際の値とは違う)

            // 基本情報の追加
            //最古の日記
            $oldest_diary=Diary::where("user_id",$user_id)->orderBy("date","asc")->first(['date']);
            $oldest_diary_date=$oldest_diary->date;
        }else{
            // 統計データないとき
            $oldest_diary_date="なし";
        }

        return view("diary/statistics/topStatistics",["statistics"=>$statistic,"char_length_frequency_distribution"=>$char_length_frequency_distribution,"biggerDiaries"=>$biggerDiaries,'oldest_diary_date'=>$oldest_diary_date,'number_of_nikki'=>$number_of_nikki,'ended_diaries_count'=>$ended_diaries_count,"wordCloud_json"=>$wordCloud_json]);
    }
}