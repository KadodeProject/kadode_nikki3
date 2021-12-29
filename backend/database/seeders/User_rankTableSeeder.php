<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_rankTableSeeder extends Seeder
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
            'name'=>"国府" ,
            'description'=>"" ,
            ],
            [
            'name'=>"大津" ,
            'description'=>"" ,
            ],
            [
            'name'=>"浦戸" ,
            'description'=>"" ,
            ],
            [
            'name'=>"大湊" ,
            'description'=>"" ,
            ],
            [
            'name'=>"奈半" ,
            'description'=>"" ,
            ],
            [
            'name'=>"室津" ,
            'description'=>"" ,
            ],
            [
            'name'=>"津呂" ,
            'description'=>"" ,
            ],
            [
            'name'=>"野根" ,
            'description'=>"" ,
            ],
            [
            'name'=>"日和佐" ,
            'description'=>"" ,
            ],
            [
            'name'=>"答島" ,
            'description'=>"" ,
            ],
            [
            'name'=>"土佐泊" ,
            'description'=>"" ,
            ],
            [
            'name'=>"灘" ,
            'description'=>"" ,
            ],
            [
            'name'=>"佐野・貝塚" ,
            'description'=>"" ,
            ],
            [
            'name'=>"澪標" ,
            'description'=>"" ,
            ],
            [
            'name'=>"河尻" ,
            'description'=>"" ,
            ],
            [
            'name'=>"江口" ,
            'description'=>"" ,
            ],
            [
            'name'=>"鳥飼" ,
            'description'=>"" ,
            ],
            [
            'name'=>"鵜殿" ,
            'description'=>"" ,
            ],
            [
            'name'=>"山崎" ,
            'description'=>"" ,
            ],
            [
            'name'=>"京" ,
            'description'=>"" ,
            ],

        ];
        DB::table("user_ranks")->insert($param);


    }
}