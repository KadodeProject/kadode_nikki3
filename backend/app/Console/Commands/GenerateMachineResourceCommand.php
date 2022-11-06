<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class GenerateMachineResourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:machineResource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '実行したタイミングから1分間サーバーリソースの状況をRedisに格納する(Redisのデータは1分でexpire)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @todo この実装でCPUリソースどか食い気絶部にならないか検証を行うこと
     */
    public function handle(): int
    {
        // 今後サーバー複数構成でもできるようにサーバー名を取り出す(実運用で必要になったらconfigから読む)
        $serverName = 'vp1';

        for ($timer = 0; $timer < 60; $timer++) {
            $startUnixTime = time();
            // CPU、メモリ、ディスクの使用率を測定 ローカル環境など値でない場合は0になるように ?? で最後分岐している
            /**
             * @var float
             *            topの-bn1でバッチモード1回だけ実行を利用 正規表現でidの前の値を抽出して、それを100から減じることでCPU使用率を出す
             */
            $cpuPercent = shell_exec('top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk \'{print 100 - $1}\'') ?? 0.0; // CPU使用率の取得

            /**
             * @var float
             *            freeのtotalとfreeの項目から算出
             */
            $memoryPercent = shell_exec("free -m | grep Mem | awk  '{print $4/$2}'") * 100; // メモリ使用率の取得

            /**
             * @var float | ""
             *            dfの/dev/vda1のUse%の値を使う(ここはサーバにより名前違う可能性があり、サーバー移行後にgrepできるか分からない)
             */
            $diskPercentRaw = substr(shell_exec("df -h | grep /dev/vda1 | awk '{print $5}'") ?? '', 0, -1);

            /** @var float */
            $diskPercent = '' === $diskPercentRaw ? 0.0 : $diskPercentRaw;
            // 受け取るときのコストを下げるために-つなぎにする cpu-memory-disk
            $value = $cpuPercent . '-' . $memoryPercent . '-' . $diskPercent;

            /**
             * @todo ここはUNIXタイム依存なので2038年に壊れる可能性がある(64bitならOK) 実装変更も検討
             * UNIXタイムにすることで取り出す時に24時間を超えた時など面倒な分岐を考えなくて良いようにする
             */
            $key = 'kn_machine_resource:' . $serverName . '-' . $startUnixTime;
            Redis::set($key, $value); // 第2引数に[key,value](第3,4引数でexpire(s)を設定できるが、うまく効いていないため別途expireで指示)
            Redis::expire($key, 60 * 30); // 30分でexpire
            // ループ内の先端から1秒待つ sleep(1)だと1秒普通にまつが、これだと経過時間判定のため、間に処理した時間が引けてより厳密になる
            // time_sleep_until($startUnixTime + 1); // これだとunixタイムが1秒ごとで、その次のunixタイムのカウントアップが来る直前にtime()を呼び出した場合は一瞬で条件を満たしていしまいエラーになるため実用的でない
            usleep(900000); // 0.9秒まつ(短めに取ることで次のcronと重複しないようにもしている側面がある)
        }

        return Command::SUCCESS;
    }
}
