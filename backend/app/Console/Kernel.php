<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GCSCommand::class,
        Commands\JudgeUserRankCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // 1分ごと
        // (実際には2秒ごと) サーバリソースをredisに書き込む
        $schedule->command('measure:machineResourceFor1minToRedis')->everyMinute();
        // 1時間ごと
        // 1時間ごとに日記コア機能の利用状況をDBに格納
        $schedule->command('measure:operationCoreTransitionToDB')->hourly();
        // 1時間ごとに平均のサーバーリソースをDBに格納

        // 1日ごと
        $schedule->command('user:judgeUserRank')->dailyAt('02:10'); // ユーザーランク審査
        $schedule->command('backup:clean --disable-notifications')->dailyAt('04:10'); // バックアップ削除
        $schedule->command('backup:run --only-db')->dailyAt('04:10'); // バックアップ作成
        $schedule->command('gcs:backup')->dailyAt('04:10'); // バックアップをgcsに
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
