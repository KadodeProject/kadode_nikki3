<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operation_core_transition_per_hours', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_total')->comment('合計ユーザー数');
            $table->unsignedBigInteger('diary_total')->comment('合計日記数');
            $table->unsignedBigInteger('statistic_per_date_total')->comment('合計統計処理済み日記数');
            $table->timestamp('created_at')->comment('生成日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_core_transition_per_hours');
    }
};
