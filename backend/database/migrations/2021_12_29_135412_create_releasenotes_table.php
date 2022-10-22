<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasenotesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('releasenotes', function (Blueprint $table): void {
            $table->id();
            $table->string('title')->comment('タイトル');
            $table->unsignedBigInteger('genre_id')->comment('リリースノートのジャンルID');
            $table->string('description')->comment('説明');
            $table->date('date')->comment('日付');
            $table->timestamps();

            // 他テーブルとの関連付け
            $table->foreign('genre_id')
                ->references('id')
                ->on('releasenote_genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releasenotes');
    }
}
