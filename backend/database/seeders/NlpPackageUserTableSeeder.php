<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
