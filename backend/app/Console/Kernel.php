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
        // 分ごとに実行する
        // (実際には2秒ごと) サーバリソースをredisに書き込む
        $schedule->command('measure:machineResourceFor1minToRedis')->everyMinute();
        // 30分ごとに平均のサーバーリソースをDBに格納
        $schedule->command('measure:machineResourceToDB')->everyThirtyMinutesV();

        // 1時間ごとに実行する処理
        // 1時間ごとに日記コア機能の利用状況をDBに格納
        $schedule->command('measure:operationCoreTransitionToDB')->hourly();

        // 1日ごとに実行する処理
        $schedule->command('user:judgeUserRank')->dailyAt('03:10'); // ユーザーランク審査
        $schedule->command('nlp:runLegacyNLPOperation')->dailyAt('03:20'); // 統計処理
        $schedule->command('backup:clean --disable-notifications')->dailyAt('05:10'); // バックアップ削除
        $schedule->command('backup:run --only-db')->dailyAt('05:12'); // バックアップ作成
        $schedule->command('gcs:backup')->dailyAt('05:15'); // バックアップをgcsに
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
