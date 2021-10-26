<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->unique()->comment("uuid");
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->integer("statistic_progress")->nullable()->comment("生成状況(生成まで時間かかるので)");
            $table->string("title")->nullable()->comment("タイトル");
            $table->text("content")->comment("本文");
            $table->date("date")->comment("日記の日付");
            // $table->integer("feel")->comment("気持ち"); 2021-9-4削除
        
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

            //インデックスを作る
            $table->index('id');
            $table->index('user_id');
            // $table->index('content');
            $table->index('date');

            //他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');//cascadeでユーザー消えたら日記も消せる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}