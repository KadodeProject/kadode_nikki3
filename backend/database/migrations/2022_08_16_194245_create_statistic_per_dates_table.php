<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
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

            $table->double("emotions")->nullable()->comment("感情数値化");
            $table->string("classification")->nullable()->comment("推定分類");
            $table->json("important_words")->nullable()->comment("重要そうな言葉(top3)");
            $table->json("special_people")->nullable()->comment("登場人物");

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
