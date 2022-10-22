<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToImportantWordsStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('statistics', function (Blueprint $table): void {
            $table->json('important_words')->nullable()->comment('重要そうな言葉');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table): void {
            $table->dropColumn('important_words');
        });
    }
}
