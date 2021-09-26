<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->integer("statistic_progress")->nullable()->comment("生成状況(生成まで時間かかるので)");
            $table->json("month_words")->nullable()->comment("各月の合計文字数");
            $table->json("month_diaries")->nullable()->comment("各月の合計日記数");
            $table->json("year_words")->nullable()->comment("各年の合計文字数");
            $table->json("year_diaries")->nullable()->comment("各年の合計日記数");
            $table->unsignedBigInteger("total_words")->nullable()->comment("トータル文字数");
            $table->unsignedBigInteger("total_diaries")->nullable()->comment("トータル日記数");


            $table->json("total_noun_asc")->nullable()->comment("トータルの名詞トップ50");
            $table->json("total_adjective_asc")->nullable()->comment("トータルの形容詞トップ50");
            $table->json("diary_grass")->nullable()->comment("日記投稿頻度閲覧用");

            $table->json("emotions")->nullable()->comment("感情数値化のグラフと平均用json");
            $table->json("classifications")->nullable()->comment("推定分類(top10)");
            $table->json("special_people")->nullable()->comment("登場人物(top10)");
          
        
            $table->timestamps();

             //他テーブルとの関連付け
             $table->foreign('user_id')
             ->references('id')
             ->on('users')
             ->onDelete('cascade');//cascadeでユーザー消えたら統計データも消せる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}