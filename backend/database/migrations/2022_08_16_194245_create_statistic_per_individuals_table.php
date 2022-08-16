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
        Schema::create('statistic_per_individuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("diary_id")->comment("日記のid");

            //nlp演算系
            $table->json("sentence")->nullable()->comment("一文ごとの位置(係り受けで使う)");
            $table->json("chunk")->nullable()->comment("係り受け構造");
            $table->json("token")->nullable()->comment("形態素分析された中身を格納 品詞(POS)、原形(lemma)などが存在");
            $table->json("affiliation")->nullable()->comment("固有表現抽出");
            $table->unsignedBigInteger("char_length")->nullable()->comment("文字数");

            //nlp表示系
            $table->json("meta_info")->nullable()->comment("事実上予備領域");
            $table->json("similar_sentences")->nullable()->comment("似ている日記の日記ID(5)");
            $table->double("emotions")->nullable()->comment("感情数値化");
            $table->double("flavor")->nullable()->comment("ユーザーの日記らしさ");
            $table->string("classification")->nullable()->comment("推定分類");
            $table->json("important_words")->nullable()->comment("重要そうな言葉(top3)");
            $table->json("cause_effect_sentences")->nullable()->comment("原因と結果のjson");
            $table->json("special_people")->nullable()->comment("登場人物");
            $table->dateTime("updated_statistic_at")->nullable()->comment("統計更新日時");

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
        Schema::dropIfExists('statistic_per_individuals');
    }
};