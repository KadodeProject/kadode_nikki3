<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagsAndRolesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean("is_showed_update_user_rank")->comment("ユーザーランクの更新通知フラグ");
            $table->boolean("is_showed_update_system_info")->comment("アップデート情報更新通知フラグ");
            $table->boolean("is_showed_service_info")->comment("お知らせ通知フラグ");
            $table->integer("user_rank")->comment("ユーザーランク");
            $table->integer("user_role")->comment("ユーザーロール(一般、管理者etc)");
            $table->integer("appearance")->comment("ページの見た目");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_showed_update_user_rank');
            $table->dropColumn('is_showed_update_system_info');
            $table->dropColumn('is_showed_service_info');
            $table->dropColumn('user_rank');
            $table->dropColumn('user_role');
            $table->dropColumn('appearance');
        });
    }
}