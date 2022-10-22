<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('search_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->string("rank")->nullable()->comment("検索順位の選び方");
            $table->string("kinds")->nullable()->comment("検索種別(AND,OR)");
            $table->boolean("is_morphological")->nullable()->comment("形態素解析するか？");
            $table->boolean("is_synonym")->nullable()->comment("同義語展開するか？");
            $table->boolean("is_kana")->nullable()->comment("かなカナ展開するか？");

            $table->timestamps();

            //他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); //cascadeでユーザー消えたら統計データも消せる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('search_settings');
    }
}
