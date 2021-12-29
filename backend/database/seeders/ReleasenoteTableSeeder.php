<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReleasenoteTableSeeder extends Seeder
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
                'title'=>"リリースノートのテストについて1" ,
                'genre_id'=>1 ,
                'description'=>"リリースノートのテストです。ちゃんと表示されてる？" ,
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"リリースノートのテストについて2" ,
                'genre_id'=>1 ,
                'description'=>"リリースノートのテストです。ちゃんと表示されてる？？？？" ,
                'date' => Carbon::tomorrow(),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
        ];
        DB::table("releasenotes")->insert($param);


    }
}