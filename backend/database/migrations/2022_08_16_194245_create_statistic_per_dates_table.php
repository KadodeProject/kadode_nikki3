<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_per_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("diary_id")->comment("日記のid");
            $table->integer("statistic_progress")->nullable()->comment("生成状況(生成まで時間かかるので)");

            //nlp表示系
            $table->double("emotions")->nullable()->comment("感情数値化");
            $table->string("classification")->nullable()->comment("推定分類");
            $table->json("important_words")->nullable()->comment("重要そうな言葉(top3)");
            $table->json("special_people")->nullable()->comment("登場人物");

            //nlp演算系
            $table->json("sentence")->nullable()->comment("一文ごとの位置(係り受けで使う)");
            $table->json("chunk")->nullable()->comment("係り受け構造");
            $table->json("token")->nullable()->comment("形態素分析された中身を格納 品詞(POS)、原形(lemma)などが存在");
            $table->json("affiliation")->nullable()->comment("固有表現抽出");
            $table->unsignedBigInteger("char_length")->nullable()->comment("文字数");

            $table->timestamps();

            //他テーブルとの関連付け
            $table->foreign('diary_id')
                ->references('id')
                ->on('diaries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_per_dates');
    }
};