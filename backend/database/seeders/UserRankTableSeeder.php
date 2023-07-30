<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            [
                'name'        => '国府',
                'description' => 'かどで日記、はじめの一歩',
            ],
            [
                'name'        => '大津',
                'description' => 'はじめての日記を書いた',
            ],
            [
                'name'        => '浦戸',
                'description' => '15枚の日記を書いた',
            ],
            [
                'name'        => '大湊',
                'description' => 'かどで日記への登録1ヶ月が経った',
            ],
            [
                'name'        => '奈半',
                'description' => '統計を利用した',
            ],
            [
                'name'        => '室津',
                'description' => '',
            ],
            [
                'name'        => '津呂',
                'description' => '',
            ],
            [
                'name'        => '野根',
                'description' => '',
            ],
            [
                'name'        => '日和佐',
                'description' => '',
            ],
            [
                'name'        => '答島',
                'description' => '',
            ],
            [
                'name'        => '土佐泊',
                'description' => '',
            ],
            [
                'name'        => '灘',
                'description' => '',
            ],
            [
                'name'        => '佐野・貝塚',
                'description' => '',
            ],
            [
                'name'        => '澪標',
                'description' => '',
            ],
            [
                'name'        => '河尻',
                'description' => '',
            ],
            [
                'name'        => '江口',
                'description' => '',
            ],
            [
                'name'        => '鳥飼',
                'description' => '',
            ],
            [
                'name'        => '鵜殿',
                'description' => '',
            ],
            [
                'name'        => '山崎',
                'description' => '',
            ],
            [
                'name'        => '京',
                'description' => '',
            ],
        ];
        DB::table('user_ranks')->insert($param);
    }
}
