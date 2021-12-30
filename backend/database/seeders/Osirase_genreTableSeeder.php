<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Osirase_genreTableSeeder extends Seeder
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
            'name'=>"お知らせ" ,
            ],
            [
            'name'=>"プレスリリース" ,
            ],
            [
            'name'=>"イベント" ,
            ],
        ];
        DB::table("osirase_genres")->insert($param);


    }
}
