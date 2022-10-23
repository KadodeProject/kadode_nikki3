<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NlpPackageGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();
        $param = [
            [
                'name' => '固有表現抽出ルール',
                'description' => '固有表現抽出ルールのパッケージ',
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ],
        ];
        DB::table('nlp_package_genres')->insert($param);
    }
}
