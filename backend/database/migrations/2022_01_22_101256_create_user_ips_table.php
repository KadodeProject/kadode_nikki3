<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserIpsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_ips', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('ip')->comment('ipアドレス');
            $table->string('ua')->comment('ユーザーエージェント');
            $table->string('geo')->comment('タイトル');
            $table->timestamps();

            // 他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // cascadeでユーザー消えたらipも消せる
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ips');
    }
}
