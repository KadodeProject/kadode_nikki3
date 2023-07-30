<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userReadNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();

        /**
         * idとuser_idが一致しているとバグに気付け無いことがあるので意図的にidとuser_idが合わないようにしている.
         */
        $param = [
            [
                'user_id'                      => 2,
                'is_showed_update_user_rank'   => 0,
                'is_showed_update_system_info' => 0,
                'is_showed_service_info'       => 0,
                'created_at'                   => $nowTime,
                'updated_at'                   => $nowTime,
            ],
            [
                'user_id'                      => 1,
                'is_showed_update_user_rank'   => 0,
                'is_showed_update_system_info' => 0,
                'is_showed_service_info'       => 0,
                'created_at'                   => $nowTime,
                'updated_at'                   => $nowTime,
            ],
        ];
        DB::table('user_read_notifications')->insert($param);
    }
}
