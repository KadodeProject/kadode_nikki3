<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PackageNERTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            [
                'package_id' => 1,
                'label_id' => 1,
                'name' => 'キャラメルポップコーン',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'package_id' => 1,
                'label_id' => 1,
                'name' => 'コンペイトウ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('package_n_e_r_s')->insert($param);
    }
}
