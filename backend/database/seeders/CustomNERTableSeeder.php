<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomNERTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();
        $param = [
            [
                'user_id'    => 1,
                'label_id'   => 5,
                'name'       => 'うすゆき',
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ],
            [
                'user_id'    => 1,
                'label_id'   => 4,
                'name'       => 'かどで日記',
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ],
        ];
        DB::table('custom_n_e_r_s')->insert($param);
    }
}
