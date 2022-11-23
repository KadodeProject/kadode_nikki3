<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MachineResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [];
        $carbonInstance = Carbon::now();
        for ($i = 24 * 31; $i > 0; $i--) {
            $time = $carbonInstance->subMinutes(30); // イミュターブルでないことを意図的に利用して減らす
            $param[] = [
                'machine' => 'dev-pc',
                'cpu' => random_int(0, 1000) / 10, // 1000までのランダムを10で割ることで小数の0~100を作り出している
                'memory' => random_int(0, 100) / 10,
                'disk' => random_int(0, 100) / 10,
                'created_at' => $time->format('Y-m-d H:i:s'),
            ];
        }

        DB::table('machine_resources')->insert(array_reverse($param));
    }
}
