<?php

declare(strict_types=1);

namespace App\Http\ApiActions\MachineResource;

use App\Http\Controllers\Controller;
use App\UseCases\MachineResource\GetAllMachineResourceFromRedis;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use function array_slice;

#[OpenApi\PathItem]
final class GetMachineResourceLatest1Minutes extends Controller
{
    public function __construct(
        private GetAllMachineResourceFromRedis $getAllMachineResourceFromRedis
    ) {
    }

    public function __invoke(): JsonResponse
    {
        /** @var array<string,array<int,array<{cpu:float,memory:float,disk:float}>> */
        $machineResources = $this->getAllMachineResourceFromRedis->invoke();
        // redisから来る値がunixタイム順でないので、サーバーごとにソートしておく
        foreach ($machineResources as &$perMachine) {
            ksort($perMachine);
            // 直近30件(後ろ30)だけ取得(2秒間隔で取得されているので、1分)
            $perMachine = array_slice($perMachine, -30, 30, true);
        }
        // 参照解除
        unset($perMachine);

        return response()->json(
            $machineResources,
        );
    }
}
