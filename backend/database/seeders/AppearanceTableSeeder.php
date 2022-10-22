<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppearanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $param = [
            [
                'name' => "標準",
                'description' => "標準の見た目",
            ],
            [
                'name' => "クラシック",
                'description' => "かつての見た目",
            ],
        ];
        DB::table("appearances")->insert($param);
    }
}
