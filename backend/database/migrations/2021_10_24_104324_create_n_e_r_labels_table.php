<?php

declare(strict_types=1);

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
    public function up(): void
    {
        Schema::create('n_e_r_labels', function (Blueprint $table) {
            $table->id();
            $table->string("label")->comment("ラベル(正式英名)");
            $table->string("name")->comment("ラベル(日本語名)");
            $table->string("parent")->nullable()->comment("大分類名"); //本当は正規化しなきゃいけないところだけど、許してください……
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('n_e_r_labels');
    }
}
