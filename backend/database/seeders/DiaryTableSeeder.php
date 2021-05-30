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
            'user_id'=>2,
            'title'=>"日記1-1",
            'content'=>"今日は日記を書いた。あああああああああ",
            'date'=>$dt,
            'feel'=>2,
            'uuid'=>Str::uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table("diaries")->insert($param);

        for($i=0;$i<=100;$i+=1){
            $param=[
                'user_id'=>1,
                'title'=>"日記".$i."-1",
                'content'=>"今日は日記を書いた。これは".$i."回目のテストデータである。",
                'date'=>$dt->subDay(),
                'feel'=>7,
                'uuid'=>Str::uuid(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table("diaries")->insert($param);
        }
        
    }
}