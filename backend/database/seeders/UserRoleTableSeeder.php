<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            [
                'name'        => 'Normal',
                'description' => '基本的にはこのロール',
            ],
            [
                'name'        => 'Administrator',
                'description' => '管理者ページにアクセスできる',
            ],
            [
                'name'        => 'KinoTsurayuki',
                'description' => '土佐日記を作成した',
            ],
        ];
        DB::table('user_roles')->insert($param);
    }
}
