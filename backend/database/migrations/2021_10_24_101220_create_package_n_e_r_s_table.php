<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageNERSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_n_e_r_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("package_id")->comment("登録しているパッケージの名前");
            $table->string("label")->comment("ラベル名");
            $table->string("name")->comment("名前");
            $table->timestamps();


            //他テーブルとの関連付け
            $table->foreign('package_id')
            ->references('id')
            ->on('custom_n_e_r_s')
            ->onDelete('cascade');//cascadeでパッケージ消えたらNEデータも消せる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_n_e_r_s');
    }
}