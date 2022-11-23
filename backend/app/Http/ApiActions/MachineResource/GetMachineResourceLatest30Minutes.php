<?php

declare(strict_types=1);

namespace App\Http\ApiActions\MachineResource;

use App\Http\Controllers\Controller;
use App\UseCases\MachineResource\GetAllMachineResourceFromRedis;
use Illuminate\Http\JsonResponse;

final class GetMachineResourceLatest30Minutes extends Controller
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
        foreach ($machineResources as $perMachine) {
            $perMachine = ksort($perMachine);
        }

        return response()->json(
            $machineResources,
        );
    }
}
