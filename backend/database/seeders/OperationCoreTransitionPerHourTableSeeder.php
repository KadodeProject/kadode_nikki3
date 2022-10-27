<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OperationCoreTransitionPerHourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [];
        $carbonInstance = Carbon::now();
        for ($i = 24 * 31; $i > 0; $i--) {
            $time = $carbonInstance->subHours(1); // イミュターブルでないことを意図的に利用して減らす
            $param[] = [
                'user_total' => $i * 2,
                'diary_total' => $i * 4,
                'statistic_per_date_total' => $i * 3,
                'created_at' => $time->format('Y-m-d H:i:s'),
            ];
        }

        /*
         * 上の配列では日記の数を日付に合わせて増加したいので日付の大きい順に配列に入れている
         * しかし、実際データベース上ではidが大きいほど後の日付が入る。
         * この違いがAPIの出し順の違いも生み出しているのが現状なので、インサート時にひっくり返して帳尻合わせする
         */
        DB::table('operation_core_transition_per_hours')->insert(array_reverse($param));
    }
}
