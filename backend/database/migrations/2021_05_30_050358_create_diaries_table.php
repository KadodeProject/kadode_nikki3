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
            $table->string("title")->comment("タイトル");
            $table->text("content")->comment("本文");
            $table->date("date")->comment("日付")->format('Y/m/d') ;
            $table->integer("feel")->comment("気持ち");
            $table->uuid("uuid")->unique()->comment("uuid");
        
            $table->timestamps();
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