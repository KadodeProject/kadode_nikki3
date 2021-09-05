<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticPerMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_per_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->integer("year")->comment("年");
            $table->integer("month")->comment("月");
            $table->double("ave_emotions")->nullable()->comment("感情数値化の平均値？");
            $table->json("word_counts")->nullable()->comment("文字数推移のグラフ用の数値json");
            $table->json("noun_rank")->nullable()->comment("名詞登場順(top3)");
            $table->json("adjective_rank")->nullable()->comment("形容詞登場順(top3)");
            $table->json("important_words")->nullable()->comment("重要な言葉(top3)");
            $table->json("special_people")->nullable()->comment("登場人物(top3)");
            $table->json("classifications")->nullable()->comment("推定分類(top3)");
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
        Schema::dropIfExists('statistic_per_months');
    }
}