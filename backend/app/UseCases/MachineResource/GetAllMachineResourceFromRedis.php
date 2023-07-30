<?php

declare(strict_types=1);

namespace App\UseCases\MachineResource;

use Illuminate\Support\Facades\Redis;

use function strlen;

/**
 * Redisからサーバーリソースをすべて取得して配列で返す.
 */
final class GetAllMachineResourceFromRedis
{
    /**
     * @return array<string,array<int,array<{cpu:float,memory:float,disk:float}>>
     */
    public function invoke(): array
    {
        // Laravelが付与するprefix 最後の_も含まれる
        $appPrefix = config('database.redis.options.prefix');
        // 事前に定義したprefix(Redis::getではこちらで取得可能だが、結果は$appPrefix付きのものが返る)
        $functionPrefix = 'kn_machine_resource:';
        // キーに含まれるサーバー名とユニックスタイムがほしいのでそれを分離する
        $prefixLength = strlen($appPrefix.$functionPrefix);

        // 現存するキーの一覧取得(getではワイルドカード使えないため)←取得量はkeyのexpireで調整し、ここではそれを元にすべて取得する
        $keys = Redis::keys($functionPrefix.'*');

        /**
         *  @var array<string,array<int,array<{cpu:float,memory:float,disk:float}>>
         * [サーバー名:[ユニックスタイム:[cpu:CPU使用率,memory:メモリ使用率,disk:ディスク使用率]]]
         */
        $machineResource = [];
        foreach ($keys as $key) {
            [$serverName, $unixTime] = explode('-', substr($key, $prefixLength)); // prefix以降を取得

            $redisRawData = Redis::get($functionPrefix.$serverName.'-'.$unixTime);

            if ($redisRawData === null) {
                // Redisのキーを取得してからここに来るまででexpireになるとRedis::get()がnullになるので、無い場合は次のループへ
                continue;
            }
            [$cpuPercent, $memoryPercent, $diskPercent] = explode('-', $redisRawData);
            $machineResource[$serverName][$unixTime] = [
                'cpu'    => (float)$cpuPercent,
                'memory' => (float)$memoryPercent,
                'disk'   => (float)$diskPercent,
            ];
            // 速度を維持するために配列整形せずそのまま文字列として渡す実装(処理重たい場合はこちらを使うようにする)↓ cpu-memory-disk
            // $machineResource[$serverName][$unixTime] = Redis::get($functionPrefix.$serverName.'-'.$unixTime);
        }

        return $machineResource;
    }
}
