<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\MachineResource;
use App\UseCases\MachineResource\GetAllMachineResourceFromRedis;
use Illuminate\Console\Command;

class MeasureMachineResourceToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'measure:machineResourceToDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '実行したタイミングでRedisに保持されているサーバーリソースの状況を平均してDBに格納するコマンド';

    /**
     * Create a new command instance.
     */
    public function __construct(
        private GetAllMachineResourceFromRedis $getAllMachineResourceFromRedis
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        /** @var array<string,array<int,array<{cpu:float,memory:float,disk:float}>> */
        $machineResources = $this->getAllMachineResourceFromRedis->invoke();

        // マシンごとに合計のCPU、メモリ、ディスク容量の平均を算出
        /** @var array<{machine:string,cpu:float,memory:float,disk:float}> */
        $machineResourceAverage = [];
        foreach ($machineResources as $machineName => $perMachine) {
            $cpu = 0;
            $memory = 0;
            $disk = 0;
            $count = 0;
            foreach ($perMachine as $machineResource) {
                $cpu += $machineResource['cpu'];
                $memory += $machineResource['memory'];
                $disk += $machineResource['disk'];
                $count++;
            }
            $machineResourceAverage[] = [
                'machine'    => $machineName,
                'cpu'        => $cpu / $count,
                'memory'     => $memory / $count,
                'disk'       => $disk / $count,
                'created_at' => now(),
            ];
        }
        // DBに格納
        MachineResource::insert($machineResourceAverage);

        return Command::SUCCESS;
    }
}
