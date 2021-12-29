<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomNERTableSeeder extends Seeder
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
                'user_id'=>1 ,
                'label_id'=>1,
                'name'=>"うすゆき",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id'=>1 ,
                'label_id'=>1,
                'name'=>"かどで日記",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("custom_n_e_r_s")->insert($param);
    }
}