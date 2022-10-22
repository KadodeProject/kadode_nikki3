<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NlpPackageNameTableSeeder extends Seeder
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
                'genre_id' => 1,
                'user_id' => 1,
                'name' => "好きなお菓子",
                'is_publish' => "公開",
                'description' => "好きなお菓子です",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("nlp_package_names")->insert($param);
    }
}
