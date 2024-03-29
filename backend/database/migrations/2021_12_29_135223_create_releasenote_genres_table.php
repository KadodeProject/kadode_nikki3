<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasenoteGenresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('releasenote_genres', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->comment('ジャンル名');
            $table->string('description')->nullable()->comment('説明');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releasenote_genres');
    }
}
