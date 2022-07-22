<?php

declare(strict_types=1);

namespace Database\Seeders;

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
