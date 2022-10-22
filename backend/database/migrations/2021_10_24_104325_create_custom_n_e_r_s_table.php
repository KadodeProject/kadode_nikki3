<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomNERSTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_n_e_r_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('登録しているユーザーID');
            $table->unsignedBigInteger('label_id')->comment('ラベルのID');
            $table->string('name')->comment('名前');
            $table->timestamps();

            // 他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade') // cascadeでユーザー消えたら統計データも消せる
;
            // 他テーブルとの関連付け
            $table->foreign('label_id')
                ->references('id')
                ->on('n_e_r_labels')
                ->onDelete('cascade') // cascadeでラベル消えたら統計データも消せる
;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_n_e_r_s');
    }
}
