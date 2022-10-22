<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_read_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ユーザーID");
            $table->boolean("is_showed_update_user_rank")->nullable()->comment("ユーザーランクの更新通知フラグ")->default(0);
            $table->boolean("is_showed_update_system_info")->nullable()->comment("アップデート情報更新通知フラグ")->default(0);
            $table->boolean("is_showed_service_info")->nullable()->comment("お知らせ通知フラグ")->default(0);
            $table->timestamps();
            //他テーブルとの関連付け
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); //cascadeでユーザー消えたらipも消せる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
};
