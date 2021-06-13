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
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->string("title")->nullable()->comment("タイトル");
            $table->text("content")->comment("本文");
            $table->date("date")->comment("日付");
            $table->integer("feel")->comment("気持ち");
            $table->uuid("uuid")->unique()->comment("uuid");
        
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