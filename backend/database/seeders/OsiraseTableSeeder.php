<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OsiraseTableSeeder extends Seeder
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
                'title'=>"お知らせのテストについて1" ,
                'genre_id'=>1 ,
                'description'=>"お知らせのテストです。ちゃんと表示されてる？" ,
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"お知らせのテストについて2" ,
                'genre_id'=>1 ,
                'description'=>"お知らせのテストです。ちゃんと表示されてる？？？？" ,
                'date' => Carbon::tomorrow(),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
        ];
        DB::table("osirases")->insert($param);


    }
}