<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
class JudgeUser_rankCommand extends Command
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

    public function updateUserRank ($user_id,$currentUserRank){
        /**
         * ユーザーランクアップ対象の場合の処理
         */
        //ユーザー通知のフラグをオン、idを上げる、日付更新
        User::where('id',$user_id)->update(["user_rank_id"=>$currentUserRank+1,"is_showed_update_user_rank"=>0,"user_rank_updated_at"=>Carbon::now()]);

    }
    public function handle()
    {
        $users=User::all();
        foreach($users as $user){
            $rank_id=$user->user_rank_id;
            $user_id=$user->id;
            switch($rank_id){
                case 1:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;

                case 2:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 3:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 4:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 5:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;
                case 6:
                    if(0){
                        $this->updateUserRank($user_id,$rank_id);
                    }
                    break;

            }
        }



        echo('id:'.$applicableUserId.'のランクが上がりました');
        return Command::SUCCESS;
    }
}