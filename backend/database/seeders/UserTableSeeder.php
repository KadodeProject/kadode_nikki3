<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
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
                'name'=>"開発者1",
                'email'=>"test1@example.com",
                'email_verified_at'=>Carbon::now(),
                'password'=>Hash::make("test1234"),
                "two_factor_secret"=>null,
                "two_factor_recovery_codes"=>null,
                "remember_token"=>Str::random(10),
                'current_team_id'=>null,
                "is_showed_update_user_rank" =>0,
                "is_showed_update_system_info" =>0,
                "is_showed_service_info" =>0,
                "user_rank_id" =>2,
                "user_role_id" =>1,
                "appearance_id" =>1,
                "profile_photo_path"=>null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'=>"開発者2",
                'email'=>"test2@example.com",
                'email_verified_at'=>Carbon::now(),
                'password'=>Hash::make("test1234"),
                "two_factor_secret"=>null,
                "two_factor_recovery_codes"=>null,
                "remember_token"=>Str::random(10),
                'current_team_id'=>null,
                "is_showed_update_user_rank" =>0,
                "is_showed_update_system_info" =>0,
                "is_showed_service_info" =>0,
                "user_rank_id" =>1,
                "user_role_id" =>1,
                "appearance_id" =>1,
                "profile_photo_path"=>null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'=>"開発者3",
                'email'=>"test3@example.com",
                'email_verified_at'=>Carbon::now(),
                'password'=>Hash::make("test1234"),
                "two_factor_secret"=>null,
                "two_factor_recovery_codes"=>null,
                "remember_token"=>Str::random(10),
                'current_team_id'=>null,
                "is_showed_update_user_rank" =>0,
                "is_showed_update_system_info" =>0,
                "is_showed_service_info" =>0,
                "user_rank_id" =>1,
                "user_role_id" =>1,
                "appearance_id" =>1,
                "profile_photo_path"=>null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table("users")->insert($param);


    }
}