<?php

declare(strict_types=1);

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
            $table->unsignedBigInteger("user_rank_id")->nullable()->comment("ユーザーランク")->default(1);
            $table->unsignedBigInteger("user_role_id")->nullable()->comment("ユーザーロール(一般、管理者etc)")->default(1);
            $table->unsignedBigInteger("appearance_id")->nullable()->comment("ページの見た目")->default(1);
            $table->date("user_rank_updated_at")->nullable()->comment("ユーザーランクアップデート日");



            //他テーブルとの関連付け
            $table->foreign('user_rank_id')
                ->references('id')
                ->on('user_ranks');

            //他テーブルとの関連付け
            $table->foreign('user_role_id')
                ->references('id')
                ->on('user_roles');

            //他テーブルとの関連付け
            $table->foreign('appearance_id')
                ->references('id')
                ->on('appearances');
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
            $table->dropColumn('user_rank_id');
            $table->dropColumn('user_role_id');
            $table->dropColumn('appearance_id');
            $table->dropColumn('user_rank_updated_at');
        });
    }
}
