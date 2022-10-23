<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NlpPackageNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();
        $param = [
            [
                'genre_id' => 1,
                'user_id' => 1,
                'name' => '好きなお菓子',
                'is_publish' => '公開',
                'description' => '好きなお菓子です',
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ],
        ];
        DB::table('nlp_package_names')->insert($param);
    }
}
