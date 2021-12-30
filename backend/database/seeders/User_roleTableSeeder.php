<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_roleTableSeeder extends Seeder
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
            'name'=>"Normal" ,
            'description'=>"基本的にはこのロール" ,
            ],
            [
            'name'=>"Administrator" ,
            'description'=>"管理者ページにアクセスできる" ,
            ],
            [
            'name'=>"KinoTsurayuki" ,
            'description'=>"土佐日記を作成した" ,
            ],
        ];
        DB::table("user_roles")->insert($param);


    }
}
