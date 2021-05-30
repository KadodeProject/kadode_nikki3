<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $param=[
            'user_id'=>1-1,
            'title'=>"日記1",
            'content'=>"今日は日記を書いた。あああああああああ",
            'date'=>$dt->format('Y/m/d'),
            'feel'=>-2,
            'uuid'=>Str::uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table("diaries")->insert($param);
        $param=[
            'user_id'=>1,
            'title'=>"日記1-2",
            'content'=>"今日は日記を書いた。あああああああああ",
            'date'=>$dt->yesterday()->format('Y/m/d'),
            'feel'=>-2,
            'uuid'=>Str::uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table("diaries")->insert($param);
        $param=[
            'user_id'=>2,
            'title'=>"日記2-1",
            'content'=>"今日は日記を書いた。あああああああああ",
            'date'=>$dt->format('Y/m/d'),
            'feel'=>-2,
            'uuid'=>Str::uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table("diaries")->insert($param);
    }
}