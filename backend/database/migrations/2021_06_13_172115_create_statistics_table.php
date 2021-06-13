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
            $table->unsignedBigInteger("total_words")->nullable()->comment("総文字数");
            $table->unsignedBigInteger("total_diaries")->nullable()->comment("総日記数");
            $table->json("month_words")->comment("月ごとの文字数");
            $table->json("month_diaries")->comment("月ごとの日記数");
            $table->json("year_words")->comment("年ごとの文字数");
            $table->json("year_diaries")->comment("年ごとの日記数");
            $table->json("year_noun_asc")->comment("年ごとの名詞昇順");
            $table->json("month_noun_asc")->comment("月ごとの名詞昇順");
            $table->json("year_adjective_asc")->comment("年ごとの形容詞昇順");
            $table->json("month_adjective_asc")->comment("月ごとの形容詞昇順");
          
        
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