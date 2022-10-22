<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReleasenoteGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            [
                'name' => "Fix",
            ],
            [
                'name' => "Feature",
            ],
            [
                'name' => "Other",
            ],
        ];
        DB::table("releasenote_genres")->insert($param);
    }
}
