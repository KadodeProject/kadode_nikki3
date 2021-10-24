<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNERLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_e_r_labels', function (Blueprint $table) {
            $table->id();
            $table->string("label")->comment("ラベル(正式英名)");
            $table->string("name")->comment("ラベル(日本語名)");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('n_e_r_labels');
    }
}