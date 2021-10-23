<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class showStatisticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function __invoke()
    {
        $statistic=Statistic::where("user_id",Auth::id())->first();
        //日記数少なすぎるときは警告出したいので
        $number_of_nikki=Diary::where("user_id",Auth::id())->count();
        $ended_diaries_count="";//undefinedエラー防止用
        if(!empty($statistic)){
            /**
             * 自然言語処理の部はstatistic_progressが100になってから表示する
             */
            if($statistic->statistic_progress==100){
            /**
             * 名詞と形容詞の登場順
             */
            //jsonを配列に戻し、連想配列を配列にする

            $statistic->total_noun_asc=array_values(json_decode($statistic->total_noun_asc,true));
            $statistic->total_adjective_asc=array_values(json_decode($statistic->total_adjective_asc,true));
            }

            /**
             * 個別日記処理の進捗を取得する処理
             */
            $ended_diaries_count=Diary::sum('statistic_progress') /100; #終わっている日記数の推定値(本当は50で全部通してから次行くので、実際の値とは違う)
                
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
                $month=substr($date,4);
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
            
            //         month_words
            // month_diaries
            // year_words
            // year_diaries
            // year_noun_asc
            // month_noun_asc
            // year_adjective_asc
            // month_adjective_asc


            // 基本情報の追加
            //最古の日記
            $oldest_diary=Diary::where("user_id",Auth::id())->orderBy("date","asc")->first();
            $oldest_diary_date=$oldest_diary->date;




        }else{
            // 統計データないとき
            $oldest_diary_date="なし";
        }   

        return view("diary/statistics/home/statistics/homeTop",["statistics"=>$statistic,'oldest_diary_date'=>$oldest_diary_date,'number_of_nikki'=>$number_of_nikki,'ended_diaries_count'=>$ended_diaries_count]);
    }
}