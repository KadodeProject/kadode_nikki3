<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('machine_resources', function (Blueprint $table): void {
            $table->id();
            $table->string('machine')->comment('マシン(サーバー)名');
            $table->unsignedFloat('cpu')->comment('CPU使用率');
            $table->unsignedFloat('memory')->comment('メモリ使用率');
            $table->unsignedFloat('disk')->comment('ディスク使用率');
            $table->timestamp('created_at')->comment('生成日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_resources');
    }
};
