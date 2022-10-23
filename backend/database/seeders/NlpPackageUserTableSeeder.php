<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NlpPackageUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();
        $param = [
            [
                'user_id' => 1,
                'package_id' => 1,
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ],
        ];
        DB::table('nlp_package_users')->insert($param);
    }
}
