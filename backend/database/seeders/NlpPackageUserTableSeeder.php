<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NlpPackageUserTableSeeder extends Seeder
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
            'user_id'=>1,
            'package_id'=>1 ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("nlp_package_users")->insert($param);
    }
}
