<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PackageNERTableSeeder extends Seeder
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
                'package_id'=>1 ,
                'label_id'=>1,
                'name'=>"キャラメルポップコーン",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'package_id'=>1 ,
                'label_id'=>1,
                'name'=>"コンペイトウ",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("package_n_e_r_s")->insert($param);
    }
}
