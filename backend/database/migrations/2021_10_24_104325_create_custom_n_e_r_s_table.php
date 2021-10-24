<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomNERSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_n_e_r_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("登録しているユーザーID");
            $table->string("label")->comment("ラベル名");
            $table->string("name")->comment("名前");
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
        Schema::dropIfExists('custom_n_e_r_s');
    }
}