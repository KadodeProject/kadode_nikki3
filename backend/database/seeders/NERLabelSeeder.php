<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NERLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $param=[
            'label'=>'Animation',
            'name'=>'アニメ名',

        ];
        DB::table("n_e_r_labels")->insert($param);


    }
}