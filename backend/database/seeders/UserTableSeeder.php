<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nowTime = now();
        $param = [
            [
                'name' => '開発者1',
                'email' => 'test1@example.com',
                'email_verified_at' => $nowTime,
                'password' => Hash::make('test1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'user_rank_id' => 1,
                'user_role_id' => 2,
                'appearance_id' => 1,
                'profile_photo_path' => null,
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
                'user_rank_updated_at' => $nowTime,
            ],

            [
                'name' => '開発者2',
                'email' => 'test2@example.com',
                'email_verified_at' => $nowTime,
                'password' => Hash::make('test1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'user_rank_id' => 1,
                'user_role_id' => 2,
                'appearance_id' => 1,
                'profile_photo_path' => null,
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
                'user_rank_updated_at' => $nowTime,
            ],
            [
                'name' => '開発者3',
                'email' => 'test3@example.com',
                'email_verified_at' => $nowTime,
                'password' => Hash::make('test1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'user_rank_id' => 1,
                'user_role_id' => 1,
                'appearance_id' => 1,
                'profile_photo_path' => null,
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
                'user_rank_updated_at' => $nowTime,
            ],
        ];
        DB::table('users')->insert($param);

        \App\Models\User::factory(10)->create();
    }
}
