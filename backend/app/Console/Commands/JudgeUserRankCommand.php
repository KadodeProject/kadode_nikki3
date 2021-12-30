<?php

namespace App\Console\Commands;

use App\Models\Diary;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
class JudgeUserRankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:judgeUser_rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ユーザーランクの更新審査を行うコマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function updateUserRank($user_id,$currentUserRank){
        /**
         * ユーザーランクアップ対象の場合の処理
         */
        //ユーザー通知のフラグをオン、idを上げる、日付更新
        User::where('id',$user_id)->update(["user_rank_id"=>$currentUserRank+1,"is_showed_update_user_rank"=>0,"user_rank_updated_at"=>Carbon::now()]);
        echo('id:'.$user_id.'/ランクアップ'.$currentUserRank."→".$currentUserRank+1);
    }




    public function handle()
    {
        $users=User::all();
        $diaries=Diary::all();
        /**
         * User以外の情報がeloquentで引っ張れない
         */



        foreach($users as $user){
            $rank_id=$user->user_rank_id;
            $user_id=$user->id;

            echo("aaa"."\n");
            echo($user_id."\n");
            echo($rank_id."\n");
            switch($rank_id){
                case 1:

                    if(Diary::where('user_id',$user_id)->count()>=1){


                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;

                case 2:
                    if(Diary::where('user_id',$user_id)->count()>=15){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 3:
                    if($user->created_at < Carbon::now()->subDays(30)){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 4:
                    if(Statistic::where('user_id',$user_id)->count()>=1){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 5:
                    if(Diary::where('user_id',$user_id)->count()>=30){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 6:
                    $diaries=Diary::where('user_id',$user_id)->get(['content']);
                    $counter=0;
                    foreach($diaries as $diary){
                        $counter=mb_strlen($diary->content);
                    }
                    if($counter>=15000){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;

            }
        }

        return Command::SUCCESS;
    }
}
