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
    public function handle()
    {

        /**
         * ユーザーランクアップ対象の場合の処理
         */
        //ユーザー通知のフラグをオンにする
        $applicableUserId=0;
        User::where('id',$applicableUserId)->update(["is_showed_update_user_rank"=>1,"user_rank_updated_at"=>Carbon::now()]);

        echo('id:'.$applicableUserId.'のランクが上がりました');
        return Command::SUCCESS;
    }
}