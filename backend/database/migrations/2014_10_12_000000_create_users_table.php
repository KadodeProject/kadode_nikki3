<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            // 0~255もあれば十分なのでutinyint
            $table->unsignedTinyInteger('auth_type')->comment('enum認証タイプ');
            $table->string('email')->unique();
            $table->rememberToken();

            $table->unsignedBigInteger('user_rank_id')->nullable()->comment('ユーザーランク')->default(1);
            $table->unsignedBigInteger('user_role_id')->nullable()->comment('ユーザーロール(一般、管理者etc)')->default(1);
            $table->unsignedBigInteger('appearance_id')->nullable()->comment('ページの見た目')->default(1);
            $table->date('user_rank_updated_at')->nullable()->comment('ユーザーランクアップデート日');

            // nullable
            $table->string('password')->nullable();
            $table->string('oauth_id')->comment('プロバイダーユーザID')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();

            $table->unique(['id', 'auth_type']); // 複合ユニーク

            // 他テーブルとの関連付け
            $table->foreign('user_rank_id')
                ->references('id')
                ->on('user_ranks');

            // 他テーブルとの関連付け
            $table->foreign('user_role_id')
                ->references('id')
                ->on('user_roles');

            // 他テーブルとの関連付け
            $table->foreign('appearance_id')
                ->references('id')
                ->on('appearances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
