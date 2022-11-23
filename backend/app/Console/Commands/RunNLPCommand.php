<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Statistic;
use App\UseCases\Statistic\ThrowPythonNLP;
use Illuminate\Console\Command;

class RunNLPCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nlp:runLegacyNLPOperation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'レガシーなユーザーごと全体の統計処理を実行する';

    /**
     * Create a new command instance.
     */
    public function __construct(
        public ThrowPythonNLP $throwPythonNLP
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        // すでに実施済みの統計処理ユーザーのみに対して発動する
        $createdUserIds = Statistic::withoutGlobalScopes()->get('user_id');
        foreach ($createdUserIds as $createdUserId) {
            echo $createdUserId->user_id."の統計情報を更新します\n";
            Statistic::where('user_id', $createdUserId->user_id)->update([
                'statistic_progress' => 1,
            ]);
            $this->throwPythonNLP->invoke($createdUserId->user_id);
        }

        return Command::SUCCESS;
    }
}
