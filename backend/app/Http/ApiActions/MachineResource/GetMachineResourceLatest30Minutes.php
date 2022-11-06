<?php

declare(strict_types=1);

namespace App\Http\ApiActions\MachineResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

final class GetMachineResourceLatest30Minutes extends Controller
{
    public function __invoke(): JsonResponse
    {
        // Laravelが付与するprefix 最後の_も含まれる
        $appPrefix = config('database.redis.options.prefix');
        // 事前に定義したprefix(Redis::getではこちらで取得可能だが、結果は$appPrefix付きのものが返る)
        $functionPrefix = 'kn_machine_resource:';
        // キーに含まれるサーバー名とユニックスタイムがほしいのでそれを分離する
        $prefixLength = \strlen($appPrefix.$functionPrefix);

        // 現存するキーの一覧取得(getではワイルドカード使えないため)←取得量はkeyのexpireで調整し、ここではそれを元にすべて取得する
        $keys = Redis::keys($functionPrefix.'*');

        /**
         *  @var array<string,array<int,array<{cpu:float,memory:float,disk:float}>>
         * [サーバー名:[ユニックスタイム:[cpu:CPU使用率,memory:メモリ使用率,disk:ディスク使用率]]]
         */
        $machineResource = [];
        foreach ($keys as $key) {
            [$serverName, $unixTime] = explode('-', substr($key, $prefixLength)); // prefix意向を取得
            // commandにすることでプレフィックス込みのkeysで呼び出せるようにする

            // 速度を維持するために配列整形せずそのまま文字列として渡す cpu-memory-disk
            $machineResource[$serverName][$unixTime] = Redis::get($functionPrefix.$serverName.'-'.$unixTime);

            // 下記は速度より可読性を重視したもの(当初1分想定だったときの実装)
            // [$cpuPercent, $memoryPercent, $diskPercent] = explode('-', Redis::get($functionPrefix . $serverName . '-' . $unixTime));
            // $machineResource[$serverName][$unixTime] = [
            //     'cpu' => (float) $cpuPercent,
            //     'memory' => (float) $memoryPercent,
            //     'disk' => (float) $diskPercent,
            // ];
        }

        // redisから来る値がunixタイム順でないので、サーバーごとにソートしておく
        foreach ($machineResource as $perMachine) {
            $perMachine = ksort($perMachine);
        }

        return response()->json(
            $machineResource,
        );
    }
}
