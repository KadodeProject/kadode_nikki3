<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticOverallProgressesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistic_overall_progresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('progress_chr')->nullable()->comment('進行状況');
            $table->double('progress_ration')->nullable()->comment('進行率');
            $table->timestamps();

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
        Schema::dropIfExists('statistic_overall_progresses');
    }
}
