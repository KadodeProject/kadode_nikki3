<?php

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
        Commands\JudgeUser_rankCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('user:judgeUser_rank')->dailyAt('02:10');//ユーザーランク審査
        $schedule->command('backup:clean --disable-notifications')->dailyAt('04:10');//バックアップ削除
        $schedule->command('backup:clean --disable-notifications')->dailyAt('04:10');//バックアップ削除
        $schedule->command('backup:run --only-db')->dailyAt('04:10');//バックアップ作成
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}