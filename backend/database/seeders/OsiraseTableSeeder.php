<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OsiraseTableSeeder extends Seeder
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
                'title'=>"ユーザーランクについて" ,
                'genre_id'=>3 ,
                'description'=>'本日より実装されましたユーザーランクは「かどで日記」の停泊地を元に作成しています。判別のつきにくいランク名称のため、設定ページにて地図付きで現在のランクを表示する機能も実装致しました。' ,
                'date' => Carbon::create(2021,12,30),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"イースターエッグについて" ,
                'genre_id'=>3 ,
                'description'=>'かどで日記にもイースターエッグを導入しました。ヒントはI`m a "teapot"です。' ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title'=>"統計設定ページの追加について" ,
                'genre_id'=>1 ,
                'description'=>"統計に関する設定は「統計設定」ページから行えます。現在では固有表現ルールの追加と固有表現パッケージの有効無効が可能です" ,
                'date' => Carbon::create(2021,10,26),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"
                かどで日記wikiの作成について" ,
                'genre_id'=>1 ,
                'description'=>"従来docsディレクトリ下にあった文書周りをGitHub wikiに移動しました。" ,
                'date' => Carbon::create(2021,10,21),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"内部バックアップについて" ,
                'genre_id'=>1 ,
                'description'=>"かどで日記では毎日夜間にデータベースのバックアップと外部ストレージへの転送を行うシステムを始動しました。しかしこれは若干のフェールセーフにすぎません。大切なデータは日記のエクスポートを行うなどして保管することを引き続きおすすめします。" ,
                'date' => Carbon::create(2021,10,21),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"統計の解析時間について" ,
                'genre_id'=>1 ,
                'description'=>"統計機能での日記解析にはかなりの時間を要します。1000日記(約40万字)ですと混雑なしの状態で解析終了までおよそ2時間を要します。二度目以降の解析は更新分のみ自然言語処理を通すので初回より早くなります。解析中でも日記の閲覧などご利用いただけます。" ,
                'date' => Carbon::create(2021,10,2),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"
                Google Analyticsの部分導入" ,
                'genre_id'=>1 ,
                'description'=>"より快適なサイト運用を行うため、ログインを伴わないページに限りGoogle Analyticsを導入いたしました。ログイン後のページはGoogle Analyticsが作用しませんので、安心してご利用ください。" ,
                'date' => Carbon::create(2021,9,16),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"自然言語処理機能追加について" ,
                'genre_id'=>1 ,
                'description'=>"かどで日記では自然言語処理の導入を進めています。本日2021年9月6日に最初の自然言語処理機能の1つである、「名詞」「形容詞」の登場順をグラフ化しました。統計コーナーでご覧いただけます。" ,
                'date' => Carbon::create(2021,9,6),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"セキュリティ対策について" ,
                'genre_id'=>1 ,
                'description'=>"SQLインジェクション対策、XSS攻撃対策が機能していることを改めて確認しました。" ,
                'date' => Carbon::create(2021,9,4),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"プライバシーポリシー改定" ,
                'genre_id'=>1 ,
                'description'=>"プライバシーポリシーを一部改定いたしました。" ,
                'date' => Carbon::create(2021,7,3),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"利用規約改定" ,
                'genre_id'=>1 ,
                'description'=>"利用規約を一部改定いたしました。" ,
                'date' => Carbon::create(2021,6,27),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"かどで日記ポスター作成" ,
                'genre_id'=>2 ,
                'description'=>"かどで日記ポスターを作ってみました。よろしければ御覧ください。" ,
                'date' => Carbon::create(2021,6,19),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
            [
                'title'=>"かどで日記公開" ,
                'genre_id'=>1 ,
                'description'=>"かどで日記を一般公開しました。" ,
                'date' => Carbon::create(2021,6,14),
                'created_at' => Carbon::tomorrow(),
                'updated_at' => Carbon::tomorrow(),
            ],
        ];
        DB::table("osirases")->insert($param);


    }
}
