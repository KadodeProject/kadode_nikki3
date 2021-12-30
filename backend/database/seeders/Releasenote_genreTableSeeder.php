<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Releasenote_genreTableSeeder extends Seeder
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
            'name'=>"Fix" ,
            ],
            [
            'name'=>"Feature" ,
            ],
            [
            'name'=>"Other" ,
            ],
        ];
        DB::table("releasenote_genres")->insert($param);


    }
}
