<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsirasesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osirases', function (Blueprint $table): void {
            $table->id();
            $table->string('title')->comment('タイトル');
            $table->unsignedBigInteger('genre_id')->comment('お知らせのジャンルID');
            $table->string('description')->comment('説明');
            $table->date('date')->comment('日付');
            $table->timestamps();

            // 他テーブルとの関連付け
            $table->foreign('genre_id')
                ->references('id')
                ->on('osirase_genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osirases');
    }
}
