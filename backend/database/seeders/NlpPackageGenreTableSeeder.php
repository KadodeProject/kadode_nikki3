<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NlpPackageGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            [
            'name'=>"固有表現抽出ルール" ,
            'description'=>"固有表現抽出ルールのパッケージ" ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("nlp_package_genres")->insert($param);
    }
}
