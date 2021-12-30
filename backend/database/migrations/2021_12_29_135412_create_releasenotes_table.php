<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasenotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releasenotes', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment("タイトル");
            $table->unsignedBigInteger("genre_id")->comment("リリースノートのジャンルID");
            $table->string("description")->comment("説明");
            $table->date("date")->comment("日付");
            $table->timestamps();

            //他テーブルとの関連付け
            $table->foreign('genre_id')
            ->references('id')
            ->on('releasenote_genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releasenotes');
    }
}