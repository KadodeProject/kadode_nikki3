<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Diary;
use App\Models\OperationCoreTransitionPerHour;
use App\Models\StatisticPerDate;
use App\Models\User;
use Illuminate\Console\Command;

class MeasureOperationCoreTransitionToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'measure:operationCoreTransitionToDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '実行したタイミングでの日記コア機能の利用状況を取得してDBに格納するコマンド';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        OperationCoreTransitionPerHour::insert(
            [
                'user_total'               => User::withoutGlobalScopes()->count(),
                'diary_total'              => Diary::withoutGlobalScopes()->count(),
                'statistic_per_date_total' => StatisticPerDate::withoutGlobalScopes()->count(),
                'created_at'               => now(), // Actionsでのインサートだと不要だが、コントローラー継承クラス外だと自動挿入されない模様
            ]
        );

        return Command::SUCCESS;
    }
}
