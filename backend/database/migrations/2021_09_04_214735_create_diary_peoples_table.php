<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryPeoplesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diary_peoples', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('name')->comment('名前');

            // 他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade') // cascadeでユーザー消えたら統計データも消せる
;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_peoples');
    }
}
